<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
        /**
         * Função construtora da classe que herda da classe pai.
         */
        public function __construct($login = TRUE, $maintenance = FALSE)
        {
                parent::__construct();
                
                if($maintenance || is_ie8()) redirect('manutencao');

                $this->load->library(array('layout'));

                if(isset($login) && $login) $this->_is_authenticated();
        }

        /**
         * Função responsavel por verificar se o usuario esta logado utilizando dados da sessão,
         * caso contrário redireciona para tela de login.
         */
        private function _is_authenticated()
        {
                if(!$this->session->userdata('authentication')) redirect('acesso');
        }

        /**
         * Função responsavel por verificar a permissão do usuário logado.
         * @author Breno Henrique Moreno Nunes
         * @params string $redirect funcao para redirecionar caso não esteja autorizado
         */
        protected function _is_autorized($redirect = '')
        {
                if(!$this->session->userdata['admin']) redirect($redirect);
        }

        protected function save_log($message = '', $user = '')
        {
                $data['description'] = $message;
                $data['user'] = (isset($this->session->userdata['email']) && !empty($this->session->userdata['email']) ? $this->session->userdata['email'] : $user);
                $data['date'] = date('Y-m-d H:i:s');
                $this->load->model('logs_model');
                $this->logs_model->insert($data);
        }

        /*
         * Função para montar diretorios recursivamente.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params string $dir caminho do diretorio a ser criado
         */
        public function build_dir($dir = '')
        {
                if (!is_dir($dir) )
                {
                        $temp = str_replace('\\', '/', $dir);
                        $temp = explode('/', $temp);
                        $path = $temp[0];
                        $qtde = count($temp);
                        $i = 0;
                        while($i < $qtde)
                        {
                                if(!is_dir($path)) {  mkdir($path, 0777); }
                                $i++;
                                if($i < $qtde){ $path .= '/'.$temp[$i]; }
                        }
                }
        }

        /*
        * Função para fazer o upload do arquivo em diretorio informado de uploads
        * Retorna array com informações do arquivo que foi feito upload
        * 
        * @author Breno Henrique Moreno Nunes
        * @params string $dir
        * @return array $data 
        */
        public function do_upload($id = '', $path = '', $type = '')
        {
                $data = array();

                if(!is_dir($path)) $this->build_dir($path);

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'pdf|jpg|jpeg|png|tif';
                $config['max_size'] = 5120; // 5 mega
                $config['file_name'] = $id;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('files')) 
                {
                        $data['upload'] = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $this->load->model('attachment_model');
                        $this->attachment_model->insert(array('id_user_request' => $id, 'description' =>  $this->upload->data('file_name'), 'path' => $path.$this->upload->data('file_name'), 'type' => $type));
                        $data['upload'] = array('success' => $this->upload->data());
                }
                return $data;
        }

        /*
         * Função para encaminhar emails utilizando a função mail do PHP.
         * Retorna TRUE caso o endereço seja aceito para o encaminhamento do email, ou
         * FALSE se não for aceito ou ocorrer erro de validação. 
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $email
         * @return boolean $retorno
         */
        public function send_email($email = array())
        {
                $retorno = FALSE;
                if(isset($email) && $email)
                {
                        $this->load->library('email');
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->to($email['to']);
                        if(isset($email['name']) && !empty($email['name']))
                        {
                                $this->email->from($email['from'], $email['name']);
                        }
                        else
                        {
                                $this->email->from($email['from']);
                        }
                        if(isset($email['cc']) && !empty($email['cc']))
                        {
                                $this->email->cc($email['cc']);
                        }
                        $this->email->subject($email['subject']);
                        $this->email->message($email['message']);
                        $retorno = $this->email->send();
                }
                return $retorno;
        }

        protected function error($data = array())
        {
                $this->layout
                        ->set_title('Admin - Erro')
                        ->set_view('pages/admin/contents/error', $data, 'template/admin/');
        }
}
