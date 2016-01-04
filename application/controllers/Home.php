<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('requests_model', 'users_model'));
        }

        public function index()
        {
                $data = $this->get_itens_table();
                $this->layout
                        ->set_title('Faz, Que Falta')
                        ->set_keywords('Faz, Que Falta')
                        ->set_description('Faz, Que Falta, o sistema que ajuda na melhoria de seu bairro.')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/home.js')
                        ->set_view('site/home', $data);
        }
        
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }
        
        public function get_itens_table()
        {
                $table['all_requests'] = $this->requests_model->get_total_itens();
                $table['businessman'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 2');
                $table['citizens'] = $this->users_model->get_total_itens('ctp_users.id_type_user <> 3 AND ctp_users.id_type_user <> 2');
                $table['open_requests'] = $this->requests_model->get_total_itens('ctp_requests.id_type_request_status = 1');
                return $table;
        }
}
