<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos_status_requisicoes extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|max_length[255]|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('type_request_status_model'));
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
                        ->set_title('Admin - Tipos de Status de Requisições')
                        ->set_css('admin/css/layout-datatables.css')
                        ->set_js('admin/js/data_table.js')
                        ->set_js('admin/js/update_delete.js')
                        ->set_js('admin/js/type_request_status.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Tipos de Status de Requisições', 'admin/tipos_status_requisicoes/', 1)
                        ->set_view('pages/admin/contents/type_request_status', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->type_request_status_model->get_itens('ctp_type_request_status.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('pages/admin/tables/type_request_status', $data);
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
                        $id = $this->type_request_status_model->insert($data);
                        $this->save_log('Tipos de status de requisições inserido ID : '.$id);
                        redirect('admin/tipos_status_requisicoes/editar/'.$id.'/1');
                }
                else
                {
                        $classe = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['classe'] = $classe;
                        $data['function'] = $function;
                        $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                        $this->layout
                                    ->set_title('Admin - Tipos de Status de Requisições - Adicionar')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Tipos de Status de Requisições', 'admin/tipos_status_requisicoes/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/tipos_status_requisicoes/', 1)
                                    ->set_view('pages/admin/forms/type_request_status', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                $this->_is_autorized('admin/painel/');
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->type_request_status_model->get_item('ctp_type_request_status.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate); 
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['active'] = (isset($data['active']) ? 1 : 0 );
                                $this->type_request_status_model->update($data, 'ctp_type_request_status.id = '.$codigo);
                                $this->save_log('Tipos de status de requisições editado ID : '.$codigo);
                                redirect('admin/tipos_status_requisicoes/editar/'.$codigo.'/1');
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
                                                ->set_title('Admin - Usuários - Editar')
                                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                                ->set_breadcrumbs('Tipos de Status de Requisições', 'admin/tipos_status_requisicoes/', 0)
                                                ->set_breadcrumbs('Editar', 'admin/tipos_status_requisicoes/editar', 1)
                                                ->set_view('pages/admin/forms/type_request_status',$data , 'template/admin/');
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
                        $exists = $this->type_request_status_model->get_total_itens('ctp_type_request_status.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->type_request_status_model->update(array('active' => 0),'ctp_type_request_status.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Tipos de status de requisições excluido ID : '.$item);
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