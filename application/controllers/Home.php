<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('requests_model', 'users_model', 'business_model'));
        }

        public function get_itens_table()
        {
                $table['all_requests'] = $this->requests_model->get_total_itens();
                $table['businessman'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 2');
                $table['citizens'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 1');
                $table['open_requests'] = $this->requests_model->get_total_itens('ctp_requests.id_type_request_status = 1');
                return $table;
        }
        
        public function index()
        {
                $this->form_validation->set_rules('business', 'Negócio', array('required', array('is_valid_business', array($this->business_model, 'is_valid_business')), 'trim'));
                $this->form_validation->set_rules('description', 'Descrição', array('required', 'trim'));
                $this->form_validation->set_rules('quantity', 'Quantidade', array('integer', array('is_quantity_greater_than_1', array($this->requests_model, 'is_quantity_greater_than_1')), 'trim'));
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $this->_set_temp_pedido($post);
                        $this->_unlink_temp_pedido_upload();
                        $this->_set_temp_pedido_upload($_FILES);
                        if(!isset($this->session->userdata['authentication']) || !$this->session->userdata['authentication'])
                        {
                                redirect('acesso');
                        }
                        else
                        {
                                redirect('admin/pedidos/adicionar');
                        }
                }
                $data = $this->get_itens_table();
                $data['action'] = base_url();
                $this->layout
                        ->set_title('Faz Que Falta')
                        ->set_keywords('empreendedores, empreendedorismo, impacto social, contexto social, trabalho em conjunto, negócio, social, Faz Que Falta, demanda, pedido, bairro')
                        ->set_description('Faz Que Falta, o sistema que conecta os empreendedores às demandas da sociedade. Faça o seu pedido!')
                        ->set_view('pages/site/home', $data);
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}