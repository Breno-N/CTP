<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bairros extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'state', 'label' => 'Estado', 'rules' => 'required|trim'),
                                    array('field'=> 'id_city', 'label' => 'Cidade', 'rules' => 'required|trim'),
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|max_length[255]|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('neighborhood_model', 'states_model', 'citys_model'));
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
                        ->set_title('CTP - Admin - Bairros')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                        ->set_includes('js/dataTables/jquery.dataTables.min.js')
                        ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/data_table.js')
                        ->set_includes('js/neighborhood.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Bairros', 'admin/bairros/', 1)
                        ->set_view('admin/neighborhood/add_list', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->neighborhood_model->get_itens('ctp_neighborhood.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/neighborhood/table', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de {param} caracteres');
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $data['active'] = (isset($data['active']) ? 1 : 0 );
                        $data = $this->_unset_fields($data);
                        $id = $this->neighborhood_model->insert($data);
                        redirect('admin/bairros/editar/'.$id.'/1');
                }
                else
                {
                        $classe = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['classe'] = $classe;
                        $data['function'] = $function;
                        $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                        $data['states'] = $this->get_states();
                        $this->layout
                                    ->set_title('Admin - Bairros - Adicionar')
                                    ->set_description('')
                                    ->set_keywords('')
                                    ->set_includes('js/neighborhood.js')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Bairros', 'admin/bairros/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/bairros/', 1)
                                    ->set_view('admin/neighborhood/add_neighborhood', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                $this->_is_autorized('admin/painel/');
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->neighborhood_model->get_item('ctp_neighborhood.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate); 
                        $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                        $this->form_validation->set_message('max_length','O campo "{field}" não pode exceder o tamanho de {param} caracteres');
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['active'] = (isset($data['active']) ? 1 : 0 );
                                $data = $this->_unset_fields($data);
                                $this->neighborhood_model->update($data, 'ctp_neighborhood.id = '.$codigo);
                                redirect('admin/bairros/editar/'.$codigo.'/1');
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
                                $data['states'] = $this->get_states();
                                $this->layout
                                        ->set_title('Admin - Bairros - Editar')
                                        ->set_description('')
                                        ->set_keywords('')
                                        ->set_includes('js/neighborhood.js')
                                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                        ->set_breadcrumbs('Bairros', 'admin/bairros/', 0)
                                        ->set_breadcrumbs('Editar', 'admin/bairros/editar', 1)
                                        ->set_view('admin/neighborhood/add_neighborhood',$data , 'template/admin/');
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
                        $exists = $this->neighborhood_model->get_total_itens('ctp_neighborhood.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->neighborhood_model->update(array('active' => 0),'ctp_neighborhood.id = '.$item);
                                if($deleted) $qtde++;
                        }
                }
                echo json_encode($qtde);
        }
        
        public function get_states()
        {
                return $this->states_model->get_select('', 'ctp_state.description', 'ASC');
        }
        
        public function get_citys()
        {
                $retorno = array();
                $data = $this->_get();
                if(isset($data['id']) && !empty($data['id']))
                {
                        $retorno = $this->citys_model->get_select('ctp_citys.id_state = '.$data['id'], 'ctp_citys.description', 'ASC');
                }
                echo json_encode($retorno);
        }
        
        private function _unset_fields($data = array())
        {
                unset($data['state'], $data['id_city_selected']);
                return $data;
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