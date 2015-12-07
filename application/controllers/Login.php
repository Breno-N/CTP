<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'email', 'label' => 'Login', 'rules' => 'required|trim|max_length[25]'),
                                    array('field'=> 'password', 'label' => 'Senha', 'rules' => 'required|trim|max_length[80]'),
                                ); 

        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model'));
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
        
        /**
         * Função que verifica os dados do usuario e direciona em caso de sucesso 
         * ou mostra mensagem de erro na tela em caso de falha.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function do_login()
        {
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de "{param}" caracteres');
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
                                    'authentication' => TRUE,
                                    'admin' => ($user->id_type_user == 3) ? TRUE : FALSE,
                                );
                                $this->session->set_userdata($session);
                                redirect('admin/painel/index');
                        }
                        else
                        {
                                $class = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['action'] = base_url().$class.'/'.$function;
                                $data['action_acess'] = base_url().'cadastro';
                                $data['action_recover_pass'] = base_url().'login/recover_pass';
                                $data['error'] = 'Usuário ou Senha Incorretos';
                                $this->layout
                                        ->set_title('Faz, Que Falta - Login')
                                        ->set_view('site/login/add_login', $data);
                        }
                }
                else
                {
                        $class = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['action'] = base_url().$class.'/'.$function;
                        $data['action_acess'] = base_url().'cadastro';
                        $data['action_recover_pass'] = base_url().'login/recover_pass';
                        $this->layout
                                ->set_title('Faz, Que Falta - Login')
                                ->set_view('site/login/add_login', $data);
                }
        }
        
        /**
         * Função que valida o login do usuario e retorna verdadeiro ou falso.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param array $data que tem login e senha informados no formulario
         * @return boolean
         */
        private function validate_login($data = array())
        {
                $user = $this->users_model->get_item('ctp_users.email = "'.$data['email'].'"');
                $return = (isset($user) && Bcrypt::check($data['password'], $user->password)) ? $user : FALSE;
                return $return;
        }
        
        /**
         * Função que verifica o email do usuario no banco, e se existir
         * criptografa uma nova senha, edita no banco e manda por email a nova senha do usuario.
         * Retorna TRUE se ocorrer tudo certo, False caso o email não seja aceito para entrega, ou
         * NULL caso ocorra erro de validação
         * 
         * @param array $data
         * @return NULL|boolean
         */
        public function recover_pass()
        {
                $this->form_validation->set_rules($this->validate_recover_pass); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('valid_email','O campo "{field}" deve ser um E-mail válido');
                $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de "{param}" caracteres');
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
                $data['action'] = base_url().$class.'/'.$function;
                $data['action_back'] = base_url().$class;
                $this->layout
                        ->set_title('Faz, Que Falta - Recuperar Senha')
                        ->set_view('site/login/add_password_recover', $data);
        }
        
        /**
         * Função que desloga usuario do sistema destruindo sua sessão,
         * e redireciona para tela de login.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function logoff()
        {
                $this->session->sess_destroy();
                redirect('login');
        }

        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
