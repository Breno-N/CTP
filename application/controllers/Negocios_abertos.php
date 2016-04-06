<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocios_abertos extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('business_model'));
        }

        public function index()
        {
                $this->form_validation->set_rules('business', 'Negócio', array('required', array('is_valid_business', array($this->business_model, 'is_valid_business')), 'trim'));
                $this->form_validation->set_rules('description', 'Descrição', array('required', 'trim'));
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $pedido_session = array(
                            'pedido_session' => array(
                                'business' => $post['business'],
                                'description' => $post['description'],
                                'have_business_neighborhood' => (isset($post['have_business_neighborhood']) && $post['have_business_neighborhood'] ? 1 : 0),
                                'quantity' => 1,
                            )
                        );
                        $this->session->set_tempdata($pedido_session, NULL, 600);
                        if(isset($_FILES['files']['name']) && !empty($_FILES['files']['name']))
                        {
                                $pedido_upload['pedido_upload']['tmp_id'] = mt_rand();
                                $pedido_upload['pedido_upload']['tmp_path'] = 'uploads/files/'.date('Y/m/');
                                $pedido_upload['pedido_upload']['tmp_ext'] = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
                                $this->do_upload($pedido_upload['pedido_upload']['tmp_id'], $pedido_upload['pedido_upload']['tmp_path'], 'Arquivo');
                                $this->session->set_userdata($pedido_upload);
                        }
                        if(!isset($this->session->userdata['authentication']) || !$this->session->userdata['authentication'])
                        {
                                redirect('acesso');
                        }
                        else
                        {
                                redirect('admin/pedidos/adicionar');
                        }
                }
                $data['action'] = base_url().'negocios_abertos';
                $this->layout
                        ->set_title('Faz, Que Falta - Negócios Abertos')
                        ->set_keywords('Empreendedor, Empreendedorismo, Pequenos, Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                        ->set_description('Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                        ->set_js('site/js/business_autocomplete.js')
                        ->set_js('site/js/requests.js')
                        ->set_js('site/js/footer.js')
                        ->set_view('pages/site/open_business', $data);
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}