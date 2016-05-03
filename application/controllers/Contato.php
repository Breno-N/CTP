<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'name', 'label' => 'Nome', 'rules' => 'required|trim'),
                                    array('field'=> 'from', 'label' => 'E-mail', 'rules' => 'valid_email|required|trim'),
                                    array('field'=> 'subject', 'label' => 'Assunto', 'rules' => 'required|trim'),
                                    array('field'=> 'message', 'label' => 'Mensagem', 'rules' => 'required|trim'),
                                ); 
    
        public function __construct() 
        {
                parent::__construct(FALSE);
        }

        public function send()
        {
                if($this->input->is_ajax_request())
                {
                        $this->form_validation->set_error_delimiters('', '');
                        $this->form_validation->set_rules($this->validate); 
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                if(isset($data['send_message']) && $data['send_message'])
                                {
                                        $data['to'] = 'contato@fazquefalta.com.br';
                                        $data['cc'] = array('guilhermec341@gmail.com', 'marcello.do.nascimento@gmail.com');
                                        unset($data['send_message'], $data['is_ajax']);
                                        $send = $this->send_email($data);
                                        $return = ($send) ? 'E-mail enviado com sucesso.' : 'Ocorreu um erro ao enviar e-mail. Por favor tente novamente mais tarde.';
                                }
                                else
                                {
                                        $return = 'Não é possivel enviar e-mail.';
                                }
                        }
                        else
                        {
                                $return = validation_errors();
                        }
                        echo json_encode($return);
                }
                else
                {
                        redirect('home');
                }
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}