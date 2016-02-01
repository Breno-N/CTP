<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|max_length[255]|trim'),
                                    array('field'=> 'email', 'label' => 'E-mail', 'rules' => 'valid_email|max_length[255]|is_unique[ctp_users.email]|trim'),
                                    array('field'=> 'password', 'label' => 'Senha', 'rules' => 'max_length[255]|trim'),
                                    array('field'=> 'id_type_user', 'label' => 'Tipo', 'rules' => 'required|trim'),
                                    array('field'=> 'age', 'label' => 'Idade', 'rules' => 'integer|trim'),
                                    array('field'=> 'genre', 'label' => 'Sexo', 'rules' => 'max_length[1]|trim'),
                                    array('field'=> 'phone', 'label' => 'Telefone', 'rules' => 'min_length[13]|max_length[14]|trim'),
                                    array('field'=> 'cpf_cnpj', 'label' => 'CPF/CNPJ', 'rules' => 'required|min_length[14]|max_length[18]|trim'),
                                    array('field'=> 'id_address', 'label' => 'CEP', 'rules' => 'required|max_length[9]|trim'),
                                ); 
        
        private $validate_edit = array(
                                    array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|max_length[255]|trim'),
                                    array('field'=> 'email', 'label' => 'E-mail', 'rules' => 'valid_email|max_length[255]|is_unique[ctp_users.email]|trim'),
                                    array('field'=> 'password', 'label' => 'Senha', 'rules' => 'max_length[255]|trim'),
                                    array('field'=> 'id_type_user', 'label' => 'Tipo', 'rules' => 'required|trim'),
                                    array('field'=> 'age', 'label' => 'Idade', 'rules' => 'integer|trim'),
                                    array('field'=> 'genre', 'label' => 'Sexo', 'rules' => 'max_length[1]|trim'),
                                    array('field'=> 'phone', 'label' => 'Telefone', 'rules' => 'min_length[13]|max_length[14]|trim'),
                                    array('field'=> 'cpf_cnpj', 'label' => 'CPF/CNPJ', 'rules' => 'required|min_length[14]|max_length[18]|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model', 'type_users_model', 'address_model', 'neighborhood_model', 'citys_model', 'states_model'));
        }
        
        public function index()
        {
                $this->listar();
        }
        
        public function listar()
        {
                $data['data_table'] = $this->_init_data_table();
                $data['action_adicionar'] = base_url().'admin/'.strtolower(__CLASS__).'/adicionar';
                $this->layout
                        ->set_title('Admin - Usuários')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                        ->set_includes('js/dataTables/jquery.dataTables.min.js')
                        ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/data_table.js')
                        ->set_includes('js/users.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Usuários', 'admin/usuarios/', 1)
                        ->set_view('admin/users/add_list', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->users_model->get_itens('ctp_users.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/users/table', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('valid_email','O campo "{field}" deve ser um E-mail válido');
                $this->form_validation->set_message('is_unique','"{field}" inválido');
                $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de "{param}" caracteres');
                $this->form_validation->set_message('min_length','O campo "{field}" dever ter no minimo "{param}" caracteres');
                $this->form_validation->set_message('integer','O campo "{field}" dever ser numérico');
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $address_exists = $this->address_model->get_total_itens('ctp_address.zip_code = '.$data['id_address'], 'ctp_address.zip_code', 'DESC', 1);
                        if($address_exists)
                        {
                                $data['password'] = (isset($data['password']) && !empty($data['password'])) ? Bcrypt::hash($data['password']) : Bcrypt::hash('123') ;
                                $data['date_create'] = date('Y-m-d');
                                $id = $this->users_model->insert($data);
                                redirect('admin/usuarios/editar/'.$id.'/1');
                        }
                        else
                        {
                                $classe = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['classe'] = $classe;
                                $data['function'] = $function;
                                $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                                $data['types_user'] = $this->get_type_user();
                                $data['error'] = 'Endereço Inexistente';
                                $this->layout
                                            ->set_title('CTP - Admin - Usuários - Adicionar')
                                            ->set_description('')
                                            ->set_keywords('')
                                            ->set_includes('js/mask/jquery.mask.js')
                                            ->set_includes('js/users.js')
                                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                            ->set_breadcrumbs('Usuarios', 'admin/usuarios/', 0)
                                            ->set_breadcrumbs('Adicionar', 'admin/usuarios/', 1)
                                            ->set_view('admin/users/add_users', $data, 'template/admin/');
                        }
                }
                else
                {
                        $classe = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['classe'] = $classe;
                        $data['function'] = $function;
                        $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                        $data['types_user'] = $this->get_type_user();
                        $this->layout
                                    ->set_title('CTP - Admin - Usuários - Adicionar')
                                    ->set_description('')
                                    ->set_keywords('')
                                    ->set_includes('js/mask/jquery.mask.js')
                                    ->set_includes('js/users.js')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Usuarios', 'admin/usuarios/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/usuarios/', 1)
                                    ->set_view('admin/users/add_users', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->users_model->get_item('ctp_users.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate_edit); 
                        $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                        $this->form_validation->set_message('valid_email','O campo "{field}" deve ser um E-mail válido');
                        $this->form_validation->set_message('is_unique','O campo "{field}" deve ser unico');
                        $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de "{param}" caracteres');
                        $this->form_validation->set_message('min_length','O campo "{field}" dever ter no minimo "{param}" caracteres');
                        $this->form_validation->set_message('integer','O campo "{field}" dever ser numérico');
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                unset($data['id_address']);
                                if(isset($data['password']) && !empty($data['password'])) 
                                {
                                        $data['password'] = Bcrypt::hash($data['password']);
                                }
                                else
                                {
                                        unset($data['password']);
                                }
                                $id = $this->users_model->update($data, 'ctp_users.id = '.$codigo);
                                if($this->session->userdata['id'] == $codigo)
                                {
                                        $session = array(
                                            'nome' => $data['name'],
                                            'type' => $data['id_type_user'],
                                            'neighborhood' => $dados->id_neighborhood,
                                        );
                                }
                                $this->session->set_userdata($session);
                                redirect('admin/usuarios/editar/'.$codigo.'/1');
                        }
                        else
                        {
                                if(!isset($dados) || empty($dados))
                                {
                                        $this->error();
                                }
                                else
                                {
                                        $classe = strtolower(__CLASS__);
                                        $function = strtolower(__FUNCTION__);
                                        $data['classe'] = $classe;
                                        $data['function'] = $function;
                                        $data['action'] = base_url().'admin/'.$classe.'/'.$function.'/'.$codigo;
                                        $data['types_user'] = $this->get_type_user();
                                        $data['item'] = $dados;
                                        $data['ok'] = (isset($ok) && $ok) ? TRUE : FALSE;
                                        $this->layout
                                                ->set_title('Admin - Usuários - Editar')
                                                ->set_description('')
                                                ->set_keywords('')
                                                ->set_includes('js/mask/jquery.mask.js')
                                                ->set_includes('js/users.js')
                                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                                ->set_breadcrumbs('Usuarios', 'admin/usuarios/', 0)
                                                ->set_breadcrumbs('Editar', 'admin/usuarios/editar', 1)
                                                ->set_view('admin/users/add_users',$data , 'template/admin/');
                                }
                        }
                }
                else
                {
                        redirect('painel');
                }
        }
        
        public function remover()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->users_model->get_total_itens('ctp_users.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->users_model->update(array('active' => 0),'ctp_users.id = '.$item);
                                if($deleted) $qtde++;
                        }
                }
                echo json_encode($qtde);
        }
        
        public function get_address()
        {
                $retorno = array();
                $data = $this->_get();
                if(isset($data['zip_code']) && !empty($data['zip_code']))
                {
                        $retorno = $this->address_model->get_item('ctp_address.zip_code = '.$data['zip_code']);
                        if(isset($retorno) && !empty($retorno))
                        {
                                echo json_encode($retorno);
                        }
                }
        }
        
        public function get_type_user()
        {
                return $this->type_users_model->get_select();
        }

        private function _get()
        {
                return sanitize($this->input->get(NULL, TRUE));
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}