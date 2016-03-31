<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos_usuarios extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|max_length[255]|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('type_users_model'));
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
                        ->set_title('Admin - Tipos de Usuários')
                        ->set_css('admin/css/layout-datatables.css')
                        ->set_js('admin/js/data_table.js')
                        ->set_js('admin/js/update_delete.js')
                        ->set_js('admin/js/type_users.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Tipos de Usuários', 'admin/tipos_usuarios/', 1)
                        ->set_view('pages/admin/contents/type_users', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->type_users_model->get_itens('ctp_type_users.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('pages/admin/tables/type_users', $data);
                return $this->layout->get_html();
        }
       
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $data['active'] = (isset($data['active']) ? 1 : 0 );
                        $id = $this->type_users_model->insert($data);
                        $this->save_log('Tipos de usuarios inserido ID : '.$id);
                        redirect('admin/tipos_usuarios/editar/'.$id.'/1');
                }
                $classe = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['classe'] = $classe;
                $data['function'] = $function;
                $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                $this->layout
                            ->set_title('Admin - Tipos de Usuários - Adicionar')
                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                            ->set_breadcrumbs('Tipos de Usuários', 'admin/tipos_usuarios/', 0)
                            ->set_breadcrumbs('Adicionar', 'admin/tipos_usuarios/', 1)
                            ->set_view('pages/admin/forms/type_users', $data, 'template/admin/');
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                $this->_is_autorized('admin/painel/');
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->type_users_model->get_item('ctp_type_users.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate); 
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['active'] = (isset($data['active']) ? 1 : 0 );
                                $this->type_users_model->update($data, 'ctp_type_users.id = '.$codigo);
                                $this->save_log('Tipos de usuarios editado ID : '.$codigo);
                                redirect('admin/tipos_usuarios/editar/'.$codigo.'/1');
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
                                        $data['item'] = $dados;
                                        $data['ok'] = (isset($ok) && $ok) ? TRUE : FALSE;
                                        $this->layout
                                                ->set_title('Admin - Tipos de Usuários - Editar')
                                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                                ->set_breadcrumbs('Tipos de Usuários', 'admin/tipos_usuarios/', 0)
                                                ->set_breadcrumbs('Editar', 'admin/tipos_usuarios/editar', 1)
                                                ->set_view('pages/admin/forms/type_users',$data , 'template/admin/');
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
                        $exists = $this->type_users_model->get_total_itens('ctp_type_users.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->type_users_model->update(array('active' => 0),'ctp_type_users.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Tipos de usuarios excluido ID : '.$item);
                        }
                }
                echo json_encode($qtde);
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