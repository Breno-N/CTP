<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentarios extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('requests_comments_model'));
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
                        ->set_title('Admin - Comentários')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                        ->set_includes('js/dataTables/jquery.dataTables.min.js')
                        ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                        ->set_includes('js/data_table.js')
                        ->set_includes('js/comments.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Comentários', 'admin/comentarios/', 1)
                        ->set_view('admin/comments/add_list', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->requests_comments_model->get_itens_by_request('ctp_requests_comments.active = 0');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/comments/table', $data);
                return $this->layout->get_html();
        }
        
        public function aprovar()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->requests_comments_model->get_total_itens('ctp_requests_comments.id = '.$item);
                        if($exists)
                        {
                                $approved = $this->requests_comments_model->update(array('active' => 1), 'ctp_requests_comments.id = '.$item);
                                if($approved) $qtde++;
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