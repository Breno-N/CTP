<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('requests_model'));
        }

        public function index()
        {
                $dados = array();
                $this->layout
                        ->set_title('Faz, Que Falta')
                        ->set_keywords('Faz, Que Falta')
                        ->set_description('Faz, Que Falta, o sistema que ajuda na melhoria de seu bairro.')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/home.js')
                        ->set_view('site/home', $dados);
        }
        
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }
}
