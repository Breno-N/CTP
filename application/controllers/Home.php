<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'business', 'label' => 'Negócio', 'rules' => 'required|trim'),
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|trim'),
                                ); 
    
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('requests_model', 'users_model'));
        }

        public function get_itens_table()
        {
                $table['all_requests'] = $this->requests_model->get_total_itens();
                $table['businessman'] = $this->users_model->get_total_itens('ctp_users.id_type_user = 2');
                $table['citizens'] = $this->users_model->get_total_itens('ctp_users.id_type_user <> 3 AND ctp_users.id_type_user <> 2');
                $table['open_requests'] = $this->requests_model->get_total_itens('ctp_requests.id_type_request_status = 1');
                return $table;
        }
        
        public function index()
        {
                $this->form_validation->set_rules($this->validate); 
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $pedido_session = array(
                            'pedido_session' => array(
                                'business' => $post['business'],
                                'description' => $post['description'],
                                'have_business_neighborhood' => (isset($post['have_business_neighborhood']) ? 1 : 0),
                                'request_public_agency' => (isset($post['request_public_agency']) ? 1 : 0),
                                'quantity' => 1,
                            )
                        );
                        $this->session->set_tempdata($pedido_session, NULL, 600);
                        if(!isset($this->session->userdata['authentication']) || !$this->session->userdata['authentication'])
                        {
                                redirect('acesso');
                        }
                        else
                        {
                                redirect('admin/pedidos/adicionar');
                        }
                }
                else
                {
                        $data = $this->get_itens_table();
                        $data['action'] = base_url().'home';
                        $this->layout
                                ->set_title('Faz, Que Falta')
                                ->set_keywords('Faz, Que Falta')
                                ->set_description('')
                                ->set_js('site/js/business_autocomplete.js')
                                ->set_view('pages/site/home', $data);
                }
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}