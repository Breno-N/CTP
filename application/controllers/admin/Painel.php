<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('requests_model', 'users_model'));
        }

        public function index()
        {
                if(isset($this->session->userdata['pedido_session']) && !empty($this->session->userdata['pedido_session']))
                {
                        redirect('admin/pedidos/adicionar');
                }
                $data = $this->get_itens_informative();
                $this->layout
                        ->set_title('Admin - Painel')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_view('pages/admin/contents/panel', $data, 'template/admin/');
        }
        
        public function get_itens_informative()
        {
                $informative['all_requests'] = $this->requests_model->get_total_itens();
                $informative['businessman'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 2');
                $informative['citizens'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 1');
                return $informative;
        }
        
        public function get_charts()
        {
                if($this->input->is_ajax_request())
                {
                        $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                        $charts['states'] = $this->requests_model->get_itens_by_state();
                        $charts['citys'] = $this->requests_model->get_itens_by_city();
                        //$charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                        echo (empty($charts['type_business']) || empty($charts['states']) || empty($charts['citys'])) ? 0 : json_encode($charts);
                }
        }

        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}