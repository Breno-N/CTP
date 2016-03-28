<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|max_length[255]|trim'),
                                    array('field'=> 'email', 'label' => 'E-mail', 'rules' => 'required|valid_email|max_length[255]|is_unique[ctp_users.email]|trim'),
                                    array('field'=> 'password', 'label' => 'Senha', 'rules' => 'required|trim'),
                                    array('field'=> 'id_type_user', 'label' => 'Tipo', 'rules' => 'required|trim'),
                                    array('field'=> 'birthday', 'label' => 'Idade', 'rules' => 'trim'),
                                    array('field'=> 'genre', 'label' => 'Sexo', 'rules' => 'max_length[1]|trim'),
                                    array('field'=> 'phone', 'label' => 'Telefone', 'rules' => 'trim'),
                                    array('field'=> 'cpf', 'label' => 'CPF', 'rules' => 'required|callback_is_valid_cpf|is_unique[ctp_users.cpf]|trim'),
                                    array('field'=> 'id_address', 'label' => 'CEP', 'rules' => 'required|callback_is_valid_address|trim'),
                                ); 
        
        private $validate_edit = array(
                                    array('field'=> 'birthday', 'label' => 'Data de Nascimento', 'rules' => 'trim'),
                                    array('field'=> 'genre', 'label' => 'Sexo', 'rules' => 'trim'),
                                    array('field'=> 'phone', 'label' => 'Telefone', 'rules' => 'trim'),
                                    array('field'=> 'cpf', 'label' => 'CPF', 'rules' => 'trim|callback_is_valid_cpf|is_unique[ctp_users.cpf]'),
                                    array('field'=> 'cep', 'label' => 'CEP', 'rules' => 'trim|callback_is_valid_address'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->library(array('bcrypt'));
                $this->load->model(array('users_model', 'type_users_model', 'address_model', 
                    'neighborhood_model', 'citys_model', 'states_model', 'attachment_model'));
        }
        
        public function index()
        {
                $this->listar();
        }
        
        public function listar()
        {
                $this->_is_autorized('admin/painel/');
                $data['data_table'] = $this->_init_data_table();
                $data['action_adicionar'] = base_url().'admin/'.strtolower(__CLASS__).'/adicionar';
                $this->layout
                        ->set_title('Admin - Usuários')
                        ->set_css('admin/css/layout-datatables.css')
                        ->set_js('admin/js/data_table.js')
                        ->set_js('admin/js/update_delete.js')
                        ->set_js('admin/js/users.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Usuários', 'admin/usuarios/', 1)
                        ->set_view('pages/admin/contents/users', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->users_model->get_itens('ctp_users.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('pages/admin/tables/users', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $address_exists = $this->address_model->get_total_itens('ctp_address.zip_code = '.$data['id_address'], 'ctp_address.zip_code', 'DESC', 1);
                        if($address_exists)
                        {
                                $data['password'] = (isset($data['password']) && !empty($data['password'])) ? Bcrypt::hash($data['password']) : Bcrypt::hash('123') ;
                                $data['date_create'] = date('Y-m-d');
                                $id = $this->users_model->insert($data);
                                $this->save_log('Usuarios inserido ID : '.$id);
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
                                            ->set_js('admin/js/address.js')
                                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                            ->set_breadcrumbs('Usuarios', 'admin/usuarios/', 0)
                                            ->set_breadcrumbs('Adicionar', 'admin/usuarios/', 1)
                                            ->set_view('pages/admin/forms/users', $data, 'template/admin/');
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
                                    ->set_js('admin/js/address.js')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Usuarios', 'admin/usuarios/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/usuarios/', 1)
                                    ->set_view('pages/admin/forms/users', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                if(isset($this->session->userdata['admin']) && $this->session->userdata['admin'])
                {
                        $codigo = (isset($codigo) && !empty($codigo)) ? $codigo : $this->session->userdata['id'] ;
                }
                else
                {
                        $codigo = $this->session->userdata['id'];
                }
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->users_model->get_item('ctp_users.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate_edit); 
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                if(isset($data['password']) && !empty($data['password'])) 
                                {
                                        $data['password'] = Bcrypt::hash($data['password']);
                                }
                                else
                                {
                                        unset($data['password']);
                                }
                                if(isset($this->session->userdata['neighborhood']) && !empty($this->session->userdata['neighborhood']))
                                {
                                        unset($data['id_address']);
                                        $session['neighborhood'] = $dados->id_neighborhood;
                                }
                                else
                                {
                                        $session['neighborhood'] = $this->_get_neighborhood_by_address($data['id_address']);
                                }
                                if(isset($data['birthday']) && !empty($data['birthday']))
                                {
                                        $birthday = explode('/', $data['birthday']);
                                        $data['birthday'] = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
                                }
                                $id = $this->users_model->update($data, 'ctp_users.id = '.$codigo);
                                if($this->session->userdata['id'] == $codigo)
                                {
                                        $session['nome'] = $data['name'];
                                }
                                $this->session->set_userdata($session);
                                if(!empty($_FILES['files']['name']))
                                {
                                        $this->do_upload($codigo, '/uploads/users/', 'jpg|jpeg|png', 'Foto');
                                }
                                $this->save_log('Usuarios editado ID : '.$codigo);
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
                                        $data['user_photo'] = $this->attachment_model->get_item('ctp_attachment.id_user_request = '.$codigo.' AND ctp_attachment.type = "Foto" ');
                                        $data['ok'] = (isset($ok) && $ok) ? TRUE : FALSE;
                                        $is_admin = (isset($this->session->userdata['admin']) && $this->session->userdata['admin']) ? 0 : 1;
                                        $this->layout
                                                ->set_title('Admin - Usuários - Editar')
                                                ->set_js('admin/js/address.js')
                                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                                ->set_breadcrumbs('Usuarios', 'admin/usuarios/', $is_admin)
                                                ->set_breadcrumbs('Editar', 'admin/usuarios/', 1)
                                                ->set_view('pages/admin/forms/users',$data , 'template/admin/');
                                }
                        }
                }
                else
                {
                        redirect('admin/painel');
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
                                $this->save_log('Usuarios excluido ID : '.$item);
                        }
                }
                echo json_encode($qtde);
        }
        
        public function is_valid_address($cep = '')
        {
                if(isset($cep) && !empty($cep))
                {
                        $address = $this->address_model->get_item('ctp_address.zip_code = '.$cep);
                        
                        if(!$address) return FALSE;
                        
                        return TRUE;
                }
                else
                {
                        return TRUE;
                }
        }
        
        public function is_valid_cpf($cpf = '')
        {
                if(isset($cpf) && !empty($cpf))
                {
                        $cpf = preg_replace('/[^0-9]/', '', $cpf);
                        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
                        if (strlen($cpf) != 11)
                        {
                                return FALSE;
                        }
                        else if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') 
                        {
                                return FALSE;
                        }
                        else
                        {   
                                for ($t = 9; $t < 11; $t++)
                                {
                                        for ($d = 0, $c = 0; $c < $t; $c++) { $d += $cpf{$c} * (($t + 1) - $c); }

                                        $d = ((10 * $d) % 11) % 10;

                                        if ($cpf{$c} != $d) return FALSE;
                                }
                                return TRUE;
                        }
                }
                else
                {
                        return TRUE;
                }
        }
        
        public function get_type_user()
        {
                return $this->type_users_model->get_select('ctp_type_users.active = 1', 'ctp_type_users.description', 'ASC');
        }

        private function _get_neighborhood_by_address($address)
        {
                return $this->address_model->get_neighborhood_by_address('ctp_address.zip_code = '.$address);
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