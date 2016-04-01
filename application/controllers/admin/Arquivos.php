<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arquivos extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('attachment_model'));
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
                        ->set_title('Admin - Arquivos')
                        ->set_css('admin/css/layout-datatables.css')
                        ->set_js('admin/js/data_table.js')
                        ->set_js('admin/js/update_delete.js')
                        ->set_js('admin/js/files.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Arquivos', 'admin/arquivos/', 1)
                        ->set_view('pages/admin/contents/files', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->attachment_model->get_itens();
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('pages/admin/tables/files', $data);
                return $this->layout->get_html();
        }
        
        public function remover()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->attachment_model->get_total_itens('ctp_attachment.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->attachment_model->update(array('done' => 0),'ctp_attachment.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Arquivos excluido ID : '.$item);
                                //unlink($caminho_do_arquivo);
                        }
                }
                echo json_encode($qtde);
        }
        
        public function feito()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->attachment_model->get_total_itens('ctp_attachment.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->attachment_model->update(array('done' => 1),'ctp_attachment.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Arquivos marcados como feito ID : '.$item);
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