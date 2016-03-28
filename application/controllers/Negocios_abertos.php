<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocios_abertos extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'business', 'label' => 'Negócio', 'rules' => 'required|trim'),
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|trim'),
                                );
    
        public function __construct() 
        {
                parent::__construct(FALSE);
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
                                'have_business_neighborhood' => (isset($post['have_business_neighborhood']) && $post['have_business_neighborhood'] ? 1 : 0),
                                'request_public_agency' => (isset($post['request_public_agency']) && $post['request_public_agency'] ? 1 : 0),
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
                        $data['action'] = base_url().'negocios_abertos';
                        $this->layout
                                ->set_title('Faz, Que Falta - Negócios Abertos')
                                ->set_keywords('Faz, Que Falta - Negócios Abertos')
                                ->set_description('')
                                ->set_js('site/js/business_autocomplete.js')
                                ->set_js('site/js/requests.js')
                                ->set_view('pages/site/open_business', $data);
                }
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}