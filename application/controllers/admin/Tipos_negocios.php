<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos_negocios extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|max_length[255]|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('type_business_model'));
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
                        ->set_title('Admin - Tipos de Negócios')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                        ->set_includes('js/dataTables/jquery.dataTables.min.js')
                        ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                        ->set_includes('js/data_table.js')
                        ->set_includes('js/type_business.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Tipos de Negócios', 'admin/tipos_negocios/', 1)
                        ->set_view('admin/type_business/add_list', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->type_business_model->get_itens();
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/type_business/table', $data);
                return $this->layout->get_html();
        }
       
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo {field} é obrigatório');
                $this->form_validation->set_message('max_length','O campo {field} não pode exceder o tamanho de {param} caracteres');
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $data['active'] = (isset($data['active']) ? 1 : 0 );
                        $id = $this->type_business_model->insert($data);
                        redirect('admin/tipos_negocios/editar/'.$id.'/1');
                }
                else
                {
                        $classe = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['classe'] = $classe;
                        $data['function'] = $function;
                        $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                        $this->layout
                                    ->set_title('Admin - Negócios - Adicionar')
                                    ->set_description('')
                                    ->set_keywords('')
                                    ->set_includes('js/type_business.js')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Tipos de Negócios', 'admin/tipos_negocios/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/tipos_negocios/', 1)
                                    ->set_view('admin/type_business/add_type_business', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                $this->_is_autorized('admin/painel/');
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->type_business_model->get_item('ctp_type_business.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate); 
                        $this->form_validation->set_message('required','O campo {field} é obrigatório');
                        $this->form_validation->set_message('max_length','O campo {field} não pode exceder o tamanho de {param} caracteres');
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['active'] = (isset($data['active']) ? 1 : 0 );
                                $this->type_business_model->update($data, 'ctp_type_business.id = '.$codigo);
                                redirect('admin/tipos_negocios/editar/'.$codigo.'/1');
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
                                                ->set_title('Admin - Negócios - Editar')
                                                ->set_description('')
                                                ->set_keywords('')
                                                ->set_includes('js/type_business.js')
                                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                                ->set_breadcrumbs('Tipos de Negócios', 'admin/tipos_negocios/', 0)
                                                ->set_breadcrumbs('Editar', 'admin/tipos_negocios/editar', 1)
                                                ->set_view('admin/type_business/add_type_business',$data , 'template/admin/');
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
                        $exists = $this->type_business_model->get_total_itens('ctp_type_business.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->type_business_model->update(array('active' => 0),'ctp_type_business.id = '.$item);
                                if($deleted) $qtde++;
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