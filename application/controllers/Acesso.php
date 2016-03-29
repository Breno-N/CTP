<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acesso extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model', 'address_model'));
        }
        
        public function index()
        {
                if(!$this->session->userdata('authentication'))
                {
                        $this->do_login();
                }
                else
                {
                        redirect('admin/painel');
                }
        }
        
        public function do_login()
        {
                $this->form_validation->set_rules('email', 'Login', array('required', 'valid_email', 'trim'));
                $this->form_validation->set_rules('password', 'Senha', array('required', 'trim'));
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $user = $this->validate_login($data);
                        if($user && $user->active)
                        {
                                $session = array(
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'type' => $user->id_type_user,
                                    'neighborhood' => $user->id_neighborhood,
                                    'can_post' => $user->can_post,
                                    'authentication' => TRUE,
                                    'admin' => ($user->id_type_user == 5487) ? TRUE : FALSE,
                                );
                                $this->session->set_userdata($session);
                                $this->save_log('Usuário logou no sistema');
                                redirect('admin/painel/index');
                        }
                        else
                        {
                                $class = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['action_login'] = base_url().$class.'/'.$function;
                                $data['action_register'] = base_url().$class.'/do_register';
                                $data['action_recover_pass'] = base_url().$class.'/recover_pass';
                                $data['error'] = 'Usuário ou Senha Incorretos';
                                $this->layout
                                        ->set_title('Faz, Que Falta - Login')
                                        ->set_js('site/js/address.js')
                                        ->set_view('pages/site/access', $data);
                        }
                }
                else
                {
                        $class = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['action_login'] = base_url().$class.'/'.$function;
                        $data['action_register'] = base_url().$class.'/do_register';
                        $data['action_recover_pass'] = base_url().$class.'/recover_pass';
                        $this->layout
                                ->set_title('Faz, Que Falta - Acesso')
                                ->set_js('site/js/address.js')
                                ->set_view('pages/site/access', $data);
                }
        }
        
        private function validate_login($data = array())
        {
                $user = $this->users_model->get_item('ctp_users.email = "'.$data['email'].'"');
                $return = (isset($user) && Bcrypt::check($data['password'], $user->password)) ? $user : FALSE;
                return $return;
        }
        
        public function do_register()
        {
                $this->form_validation->set_rules('name', 'Nome', array('trim'));
                $this->form_validation->set_rules('email', 'Login', array('required', 'trim', 'valid_email', 'is_unique[ctp_users.email]'));
                $this->form_validation->set_rules('password', 'Senha', array('required', 'trim'));
                $this->form_validation->set_rules('cpf', 'CPF', array('trim', array('is_valid_cpf', array($this->users_model, 'is_valid_cpf')), 'is_unique[ctp_users.cpf]'));
                $this->form_validation->set_rules('id_address', 'CEP', array('trim', array('is_valid_address', array($this->address_model, 'is_valid_address'))));
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $post['password'] = Bcrypt::hash($post['password']);
                        $post['date_create'] = date('Y-m-d');
                        $id = $this->users_model->insert($post);
                        if($id)
                        {
                                $session = array(
                                    'id' => $id,
                                    'name' => $post['name'],
                                    'email' => $post['email'],
                                    'type' => 1,
                                    'authentication' => TRUE,
                                );
                                $session['neighborhood'] = (isset($post['id_address']) ? $this->address_model->get_neighborhood_by_address('ctp_address.zip_code = '.$post['id_address']) : '');
                                $this->session->set_userdata($session);
                                $this->save_log('Usuário se registrou e logou no sistema');
                                redirect('admin/painel/');
                        }
                        else
                        {
                                $class = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['action_login'] = base_url().$class.'/do_login';
                                $data['action_register'] = base_url().$class.'/'.$function;
                                $data['action_recover_pass'] = base_url().$class.'/recover_pass';
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Ocorreu um erro ao salvar os dados. Por favor tente novamente mais tarde.';
                                $this->layout
                                        ->set_title('Faz, Que Falta - Acesso')
                                        ->set_js('site/js/address.js')
                                        ->set_view('pages/site/access', $data);
                        }
                }
                else
                {
                        $class = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['action_login'] = base_url().$class.'/do_login';
                        $data['action_register'] = base_url().$class.'/'.$function;
                        $data['action_recover_pass'] = base_url().$class.'/recover_pass';
                        $this->layout
                                    ->set_title('Faz, Que Falta - Acesso')
                                    ->set_js('site/js/address.js')
                                    ->set_view('pages/site/access', $data);
                }
        }
        
        public function recover_pass()
        {
                $this->form_validation->set_rules('email', 'E-mail', array('required', 'valid_email', 'trim'));
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $qtde = $this->users_model->get_password_by_email('ctp_users.email = "'.$data['email'].'"');
                        if($qtde > 0)
                        {
                                $password['password'] = Bcrypt::hash($data['email']);
                                $update = $this->users_model->update('ctp_users.email = "'.$data['email'].'"', $password);
                                if($update)
                                {
                                        $this->save_log('Usuário solicitou nova senha', $data['email']);
                                        $email['from']   = 'email@sistema.com.br';
                                        $email['to'] = $data['email'];
                                        $email['subject'] = 'Recuperação de senha';
                                        $email['message']  = 'Você solicitou a recuperação de senha.<br>';
                                        $email['message'] .= 'Segue a nova senha de acesso ao Painel de Controle:<br>';
                                        $email['message'] .= $password;
                                        $data['info'] = ($this->send_email($email) ? 'Nova senha encaminhada ao e-mail informado.' : 'Erro ao tentar recuperar senha. Tente novamente mais tarde.');
                                }
                        }
                }
                $class = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['action_login'] = base_url().$class.'/do_login';
                $data['action_register'] = base_url().$class.'/do_register';
                $data['action_recover_pass'] = base_url().$class.'/'.$function;
                $this->layout
                        ->set_title('Faz, Que Falta - Acesso')
                        ->set_js('site/js/address.js')
                        ->set_view('pages/site/access', $data);
        }
        
        public function logoff()
        {
                $this->save_log('Usuário deslogou do sistema');
                $this->session->sess_destroy();
                redirect('home');
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
