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
                $data['last_news'] = $this->get_last_news();
                $this->layout
                        ->set_title('Admin - Painel')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/panel.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_view('admin/panel/add_panel', $data, 'template/admin/');
        }
        
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }
        
        public function get_last_news()
        {
                return $this->news_model->get_itens('ctp_news.active = 1', 'id', 'DESC', 5);
        }

        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
