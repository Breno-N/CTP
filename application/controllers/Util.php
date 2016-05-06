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
                if($this->input->is_ajax_request())
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
        }
        
        public function get_all_business()
        {
                if($this->input->is_ajax_request())
                {
                        $return = $this->business_model->get_select('ctp_business.active = 1', 'description', 'ASC');
                        echo json_encode($return);
                }
        }
       
        public function have_business_neighborhood_request()
        {
                if($this->input->is_ajax_request())
                {
                        $data = $this->_get();
                        $return = $this->requests_model->get_select_business('ctp_business.description = "'.$data['business'].'" AND ctp_requests.id_neighborhood = '.$this->session->userdata['neighborhood'].' AND ctp_requests.active = 1');
                        echo json_encode($return);
                }
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