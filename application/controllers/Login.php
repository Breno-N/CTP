<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model', 'address_model'));
        }
        
        public function index($msg = NULL)
        {
                if(!$this->session->userdata('authentication'))
                {
                        $this->fazer_login($msg);
                }
                else
                {
                        redirect('admin/painel');
                }
        }
        
        public function fazer_login($msg = NULL)
        {
                $this->form_validation->set_rules('email', 'Login', array('required', 'valid_email', 'trim'));
                $this->form_validation->set_rules('password', 'Senha', array('required', 'trim'));
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $user = $this->_validate_login($data);
                        if($user && $user->active)
                        {
                                $session = array(
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'type' => $user->id_type_user,
                                    'neighborhood' => $user->id_neighborhood,
                                    'city' => $user->city,
                                    'state' => $user->state,
                                    'can_post' => $user->can_post,
                                    'photo' => $user->photo,
                                    'authentication' => TRUE,
                                    'admin' => ($user->id_type_user == 5487) ? TRUE : FALSE,
                                );
                                $this->session->set_userdata($session);
                                $this->save_log('Usuário logou no sistema');
                                redirect('admin/painel/');
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Usuário ou Senha Incorretos';
                        }
                }
                $class = strtolower(__CLASS__);
                $data['action_login'] = base_url().$class.'/'.'fazer-login';
                $data['action_register'] = base_url().$class.'/fazer-registro';
                $data['action_recover_pass'] = base_url().$class.'/recuperar-senha';
                if(isset($msg, $this->session->userdata['pedido_session']) && !empty($this->session->userdata['pedido_session']) && $msg == 'fazer-pedido')
                {
                        $data['info']['error'] = 0;
                        $data['info']['message'] = 'Para realizar o pedido, faça seu login ou cadastra-se. Por questões de segurança se a confirmação ocorrer depois de 1 hora você terá que realizar o pedido novamente.';
                }
                $this->layout
                        ->set_title('Faz, Que Falta - Login')
                        ->set_keywords('Empreendedor, Empreendedorismo, Pequenos Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                        ->set_description('Login - Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                        ->set_view('pages/site/access', $data);
        }
        
        private function _validate_login($data = array())
        {
                $user = $this->users_model->get_item('ctp_users.email = "'.$data['email'].'"');
                if(isset($user))
                {
                        if(Bcrypt::check($data['password'], $user->password)) 
                        {
                                return $user;
                        }
                        else if(isset($user->temp_password) && !empty($user->temp_password))
                        {
                                if(Bcrypt::check($data['password'], $user->temp_password))
                                {
                                        return ($user->temp_password_date == date('Y-m-d') ? $user : FALSE);
                                }
                                else
                                {
                                        return FALSE;
                                }
                        }
                        else
                        {
                                return FALSE;
                        }
                }
                else
                {
                        return FALSE;
                }
        }
        
        public function fazer_registro()
        {
                $this->form_validation->set_rules('name', 'Nome', array('trim'));
                $this->form_validation->set_rules('email', 'E-mail', array('required', 'trim', 'valid_email', 'is_unique[ctp_users.email]'));
                $this->form_validation->set_rules('password', 'Senha', array('required', 'trim'));
                $this->form_validation->set_rules('cpf', 'CPF', array('trim', array('is_valid_cpf', array($this->users_model, 'is_valid_cpf')), 'is_unique[ctp_users.cpf]'));
                $this->form_validation->set_rules('id_address', 'CEP', array('trim', array('is_valid_address', array($this->address_model, 'is_valid_address'))));
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $post['password'] = Bcrypt::hash($post['password']);
                        $post['date_create'] = date('Y-m-d');
                        $post['active'] = 0;
                        $post['active_token'] = uniqid();
                        $id = $this->users_model->insert($post);
                        if($id)
                        {
                                $email['from'] = 'contato@fazquefalta.com.br';
                                $email['to'] = $post['email'];
                                $email['subject'] = 'Confirmação de cadastro';
                                $email['message']  = 'Para realizar a ativação de cadastro clique no link abaixo<br><br>';
                                $email['message'] .= base_url().'login/validar-registro/'.$post['active_token'].'  <br><br><br>';
                                if($this->send_email($email))
                                {
                                        $data['info']['error'] = 0;
                                        $data['info']['message'] = 'Encaminhado e-mail para confirmação de cadastro.';
                                }
                                else
                                {
                                        $data['info']['error'] = 1;
                                        $data['info']['message'] = 'Erro ao se cadastrar. Tente novamente mais tarde.';
                                }
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Ocorreu um erro ao salvar os dados. Por favor tente novamente mais tarde.';
                        }
                }
                $class = strtolower(__CLASS__);
                $data['action_login'] = base_url().$class.'/'.'fazer-login';
                $data['action_register'] = base_url().$class.'/fazer-registro';
                $data['action_recover_pass'] = base_url().$class.'/recuperar-senha';
                $this->layout
                            ->set_title('Faz, Que Falta - Login')
                            ->set_keywords('Empreendedor, Empreendedorismo, Pequenos Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                            ->set_description('Login - Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                            ->set_view('pages/site/access', $data);
        }
        
        public function validar_registro($token = '')
        {
                if(isset($token) && !empty($token))
                {
                        $token = sanitize($token);
                        $user = $this->users_model->get_item('ctp_users.active_token = "'.$token.'"');
                        if(isset($user) && !empty($user))
                        {
                                $update = $this->users_model->update(array('active' => '1', 'active_token' => ''), 'ctp_users.active_token = "'.$token.'"');
                                if($update)
                                {
                                        $data['info']['error'] = 0;
                                        $data['info']['message'] = 'Cadastro ativado com sucesso.';
                                }
                                else
                                {
                                        $data['info']['error'] = 1;
                                        $data['info']['message'] = 'Erro ao ativar cadastro de usuário.';
                                }
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Erro ao ativar cadastro de usuário.';
                        }
                }
                else
                {
                        $data['info']['error'] = 1;
                        $data['info']['message'] = 'Erro ao ativar cadastro de usuário.';
                }
                $this->layout
                            ->set_title('Faz, Que Falta - Validação de Cadastro')
                            ->set_view('pages/site/validate_register', $data);
        }
        
        public function recuperar_senha()
        {
                $this->form_validation->set_rules('email', 'E-mail', array('required', 'valid_email', 'trim'));
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        //$qtde = $this->users_model->get_password_by_email('ctp_users.email = "'.$data['email'].'"');
                        $qtde = $this->users_model->get_total_itens('ctp_users.email = "'.$data['email'].'"');
                        if($qtde > 0)
                        {
                                $temp_password = uniqid(mt_rand(), TRUE);
                                
                                $temp['temp_password'] = Bcrypt::hash($temp_password);
                                $temp['temp_password_date'] = date('Y-m-d');
                                
                                $update = $this->users_model->update($temp, 'ctp_users.email = "'.$data['email'].'"');
                                if($update)
                                {
                                        $this->save_log('Usuário solicitou nova senha', $data['email']);
                                        $email['from'] = 'contato@fazquefalta.com.br';
                                        $email['to'] = $data['email'];
                                        $email['subject'] = 'Recuperação de senha';
                                        $email['message']  = 'Recebemos a solicitação de recuperação de senha.<br>';
                                        $email['message'] .= 'Abaixo segue senha temporaria que é valida para a data da solicitação.<br>';
                                        $email['message'] .= 'Utilize-a para acessar o Painel de controle e depois realize a troca de sua senha<br><br>';
                                        $email['message'] .= $temp_password.'  <br><br><br>';
                                        $email['message'] .= 'Se você não solicitou a recuperação de senha por favor desconsidere este e-mail.<br><br>';
                                        if($this->send_email($email))
                                        {
                                                $data['info']['error'] = 0;
                                                $data['info']['message'] = 'Nova senha encaminhada ao e-mail informado.';
                                        }
                                        else
                                        {
                                                $data['info']['error'] = 1;
                                                $data['info']['message'] = 'Erro ao tentar recuperar senha. Tente novamente mais tarde.';
                                        }
                                }
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Erro ao tentar recuperar senha para e-mail informado.';
                        }
                }
                $class = strtolower(__CLASS__);
                $data['action_login'] = base_url().$class.'/'.'fazer-login';
                $data['action_register'] = base_url().$class.'/fazer-registro';
                $data['action_recover_pass'] = base_url().$class.'/recuperar-senha';
                $this->layout
                        ->set_title('Faz, Que Falta - Login')
                        ->set_keywords('Empreendedor, Empreendedorismo, Pequenos Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                        ->set_description('Login - Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                        ->set_view('pages/site/access', $data);
        }
        
        public function social()
        {
                $this->load->library('Opauth/Opauth', $this->config->item('opauth_config'), false);
                $this->opauth->run();    
        }
        
        public function auth_social()
        {
                $response = unserialize(base64_decode( $_POST['opauth'] ));
                if(!isset($response['error']) && empty($response['error']))
                {
                        if(isset($response['auth']) && !empty($response['auth']))
                        {
                                $email = $response['auth']['info']['email'];
                                $name = $response['auth']['info']['name'];
                                $image = (isset($response['auth']['info']['image']) ? $response['auth']['info']['image'] : NULL);
                                $user = $this->users_model->get_item('ctp_users.email = "'.$email.'"');
                                if(isset($user) && !empty($user))
                                {
                                        $session = array(
                                            'id' => $user->id,
                                            'name' => $user->name,
                                            'email' => $user->email,
                                            'type' => $user->id_type_user,
                                            'neighborhood' => $user->id_neighborhood,
                                            'city' => $user->city,
                                            'state' => $user->state,
                                            'can_post' => $user->can_post,
                                            'photo' => $user->photo,
                                            'authentication' => TRUE,
                                            'admin' => ($user->id_type_user == 5487) ? TRUE : FALSE,
                                        );
                                        $this->session->set_userdata($session);
                                        $this->save_log('Usuário usou login social para logar no sistema.');
                                        redirect('admin/painel/');
                                }
                                else
                                {
                                        $new_user['name'] = $name;
                                        $new_user['email'] = $email;
                                        $new_user['password'] = Bcrypt::hash(mt_rand());
                                        $id = $this->users_model->insert($new_user);
                                        if($id)
                                        {
                                                if(isset($image) && !empty($image))
                                                {
                                                        $this->load->model('attachment_model');
                                                        $attachment['id_user_request'] = $id;
                                                        $attachment['description'] = $id;
                                                        $attachment['path'] = $image;
                                                        $attachment['type'] = 'Foto';
                                                        $this->attachment_model->insert($attachment);
                                                }
                                                $session = array(
                                                    'id' => $id,
                                                    'name' => $name,
                                                    'email' => $email,
                                                    'type' => 1,
                                                    'neighborhood' => '',
                                                    'city' => '',
                                                    'state' => '',
                                                    'can_post' => 1,
                                                    'photo' => (isset($image) && !empty($image) ? $image : '') ,
                                                    'authentication' => TRUE,
                                                    'admin' => FALSE,
                                                );
                                                $this->session->set_userdata($session);
                                                $this->save_log('Usuário usou login social para logar no sistema.');
                                                redirect('admin/painel/');
                                        }
                                        else
                                        {
                                                $data['info']['error'] = 1;
                                                $data['info']['message'] = 'Não é possivel fazer o login social no momento. Tente novamente mais tarde.';
                                        }
                                        
                                }
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Não é possivel fazer o login social no momento. Tente novamente mais tarde.';
                        }
                }
                else
                {
                        $data['info']['error'] = 1;
                        $data['info']['message'] = 'Erro ao fazer login social, permissões necessárias não liberadas.';
                }
                $class = strtolower(__CLASS__);
                $data['action_login'] = base_url().$class.'/'.'fazer-login';
                $data['action_register'] = base_url().$class.'/fazer-registro';
                $data['action_recover_pass'] = base_url().$class.'/recuperar-senha';
                $this->layout
                        ->set_title('Faz, Que Falta - Login')
                        ->set_keywords('Empreendedor, Empreendedorismo, Pequenos Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                        ->set_description('Login - Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                        ->set_view('pages/site/access', $data);
                
        }
        
        public function logoff()
        {
                if(isset($this->session->userdata['pedido_upload']) && !empty($this->session->userdata['pedido_upload']))
                {
                        $tmp_file = $this->session->userdata['pedido_upload']['tmp_path'].$this->session->userdata['pedido_upload']['tmp_id'].'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                        unlink($tmp_file);
                }
                $this->save_log('Usuário deslogou do sistema');
                $this->session->sess_destroy();
                redirect('/');
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
