<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     * Função construtora da classe que herda da classe pai.
     */
    public function __construct($login = TRUE)
    {
            parent::__construct();

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
            $data['user'] = (isset($this->CI->session->userdata['email']) && !empty($this->CI->session->userdata['email']) ? $this->CI->session->userdata['email'] : $user);
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
            $paths = explode('/', $dir);
            $partial_path = $paths[0];
            $actual_path  = 0;
            while( $actual_path < count($paths) )
            {
                    if(!is_dir($partial_path)) mkdir($partial_path);
                    $partial_path .=  $paths[++$actual_path] . '/';
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
    public function do_upload($id = '', $path = '', $ext = 'pdf|doc|docx', $type = '', $max_size = 2048)
    {
            $data = array();
            //$dir = str_replace('\\', '/', getcwd()).'/uploads/files/'.date('Y/m/d').'/'.$id;
            $dir = str_replace('\\', '/', getcwd()).$path.$id;
            if(!is_dir($dir)) $this->build_dir($dir);

            $config['upload_path'] = $dir;
            $config['allowed_types'] = $ext;
            $config['max_size'] = $max_size;
           
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('files')) 
            {
                $data['upload'] = array('error' => $this->upload->display_errors());
            }
            else
            {
                $this->load->model('attachment_model');
                $this->attachment_model->insert(array('id_user_request' => $id, 'description' =>  $this->upload->data('file_name'), 'path' => $this->upload->data('full_path'), 'type' => $type));
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
                    $this->email->from($email['from'], $email['name']);
                    $this->email->to($email['to']);
                    $this->email->cc($email['cc']);
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
                    ->set_view('errors/html/error_action', $data, 'template/admin/');
    }
}
