<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|trim'),
                                    array('field'=> 'cc', 'label' => 'E-mail', 'rules' => 'valid_email|required|trim'),
                                    array('field'=> 'subject', 'label' => 'Assunto', 'rules' => 'required|trim'),
                                    array('field'=> 'message', 'label' => 'Mensagem', 'rules' => 'required|trim'),
                                ); 
    
        public function __construct() 
        {
                parent::__construct(FALSE);
                $this->load->model(array('requests_model'));
        }

        public function index()
        {
                $classe = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['classe'] = $classe;
                $data['function'] = $function;
                $data['action'] = base_url().$classe.'/'.$function;
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                $this->form_validation->set_message('valid_email','O campo {"field}" deve ser um E-mail válido');
                if($this->form_validation->run())
                {
                        $post = $this->_post();
                        $post['from'] = 'contato@fazquefalta.com.br';
                        $post['to'] = 'contato@fazquefalta.com.br';
                        $send = $this->send_email($post);
                        $data['info']['error'] = ($send) ? 0 : 1;
                        $data['info']['message'] = ($send) ? 'E-mail enviado com sucesso.' : 'Ocorreu um erro ao enviar e-mail. Por favor tente novamente mais tarde.';
                        $this->layout
                                    ->set_title('Faz, Que Falta - Contato')
                                    ->set_keywords('Faz, Que Falta - Contato')
                                    ->set_description('')
                                    ->set_view('site/contact/index', $data);
                }
                else
                {
                        $this->layout
                            ->set_title('Faz, Que Falta - Contato')
                            ->set_keywords('Faz, Que Falta - Contato')
                            ->set_description('')
                            ->set_view('site/contact/index', $data);
                }
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}
