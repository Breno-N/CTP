<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro extends MY_Controller
{
        private $validate = array(
                                array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|trim|max_length[255]'),
                                array('field'=> 'genre', 'label' => 'Sexo', 'rules' => 'required|trim'),
                                array('field'=> 'age', 'label' => 'Idade', 'rules' => 'required|trim|integer'),
                                array('field'=> 'email', 'label' => 'E-mail', 'rules' => 'required|trim|valid_email|max_length[255]|is_unique[ctp_users.email]'),
                                array('field'=> 'password', 'label' => 'Senha', 'rules' => 'required|trim|max_length[255]'),
                            ); 

        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model', 'address_model'));
        }

        public function index()
        {
                $classe = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['classe'] = $classe;
                $data['function'] = $function;
                $data['action'] = base_url().$classe.'/'.$function;
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('valid_email','O campo {"field}" deve ser um E-mail válido');
                $this->form_validation->set_message('is_unique','"{field}" inválido');
                $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de "{param}" caracteres');
                $this->form_validation->set_message('integer','O campo "{field}" deve ser um número');
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
                                    'admin' => FALSE,
                                );
                                $this->session->set_userdata($session);
                                redirect('admin/painel/');
                        }
                        else
                        {
                                $data['info']['error'] = 1;
                                $data['info']['message'] = 'Ocorreu um erro ao salvar os dados. Por favor tente novamente mais tarde.';
                                $this->layout
                                            ->set_title('Faz, Que Falta - Cadastro')
                                            ->set_keywords('Faz, Que Falta - Cadastro')
                                            ->set_description('Faça o seu cadastro na plataforma do Faz, Que Falta e veja a diferença no seu bairro.')
                                            ->set_view('site/register/index', $data);
                        }
                }
                else
                {
                        $this->layout
                                    ->set_title('Faz, Que Falta - Cadastro')
                                    ->set_keywords('Faz, Que Falta - Cadastro')
                                    ->set_description('Faça o seu cadastro na plataforma do Faz, Que Falta e veja a diferença no seu bairro.')
                                    ->set_includes('js/mask/jquery.mask.js')
                                    ->set_includes('js/register.js')
                                    ->set_view('site/register/index', $data);
                }
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
