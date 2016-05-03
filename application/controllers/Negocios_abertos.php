<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocios_abertos extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('business_model', 'requests_model'));
        }

        public function index()
        {
                $this->form_validation->set_rules('business', 'Negócio', array('required', array('is_valid_business', array($this->business_model, 'is_valid_business')), 'trim'));
                $this->form_validation->set_rules('description', 'Descrição', array('required', 'trim'));
                $this->form_validation->set_rules('quantity', 'Quantidade', array('integer', array('is_quantity_greater_than_1', array($this->requests_model, 'is_quantity_greater_than_1')), 'trim'));
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $this->_set_temp_request($post);
                        $this->_unlink_temp_request_upload();
                        $this->_set_temp_request_upload($_FILES);
                        if(!isset($this->session->userdata['authentication']) || !$this->session->userdata['authentication'])
                        {
                                redirect('login/fazer-login/fazer-pedido');
                        }
                        else
                        {
                                redirect('admin/pedidos/adicionar');
                        }
                }
                $data['action'] = base_url().'negocios-abertos';
                $this->layout
                        ->set_title('Faz, Que Falta - Negócios Abertos')
                        ->set_keywords('Faz Que Falta, negócio, negocios, negócio aberto, negócios abertos, ideia, pedido, bairro')
                        ->set_description('Negócios Abertos - Faz Que Falta, visualize os negócios abertos e faça o seu pedido!')
                        ->set_view('pages/site/open_business', $data);
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}