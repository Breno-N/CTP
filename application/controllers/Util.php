<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('address_model', 'business_model', 'requests_model'));
        }
        
        public function get_address()
        {
                $retorno = array();
                $data = $this->_get();
                if(isset($data['zip_code']) && !empty($data['zip_code']))
                {
                        $retorno = $this->address_model->get_item('ctp_address.zip_code = '.$data['zip_code']);
                        if(isset($retorno) && !empty($retorno))
                        {
                                echo json_encode($retorno);
                        }
                }
        }
        
        public function get_business()
        {
                $return = $this->business_model->get_select('ctp_business.active = 1', 'description', 'ASC');
                echo json_encode($return);
        }
       
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }
        
        public function have_business_neighborhood_request()
        {
                $data = $this->_get();
                $return = $this->requests_model->get_select_business('ctp_business.description = "'.$data['business'].'" AND ctp_requests.id_neighborhood = '.$this->session->userdata['neighborhood'].' AND ctp_requests.active = 1');
                echo json_encode($return);
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