<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('requests_model', 'news_model'));
        }

        public function index()
        {
                if(isset($this->session->userdata['pedido_session']) && !empty($this->session->userdata['pedido_session']))
                {
                        redirect('admin/pedidos/adicionar');
                }
                $data = array();
                $this->layout
                        ->set_title('Admin - Painel')
                        ->set_js('admin/js/panel.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_view('pages/admin/contents/panel', $data, 'template/admin/');
        }
        
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }

        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}