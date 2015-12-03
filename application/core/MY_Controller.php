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
            if(!$this->session->userdata('authentication'))
            {
                    redirect('login');
            }
    }
    
    /**
     * Função responsavel por verificar a permissão do usuário logado.
     * @author Breno Henrique Moreno Nunes
     * @params string $redirect funcao para redirecionar caso não esteja autorizado
     */
    protected function _is_autorized($redirect = '')
    {
            if($this->session->userdata['type'] != '3') redirect($redirect);
    }
    
    /*
     * Função para montar query com base nos filtros de pesquisa.
     * Retorna string
     * 
     * @author Breno Henrique Moreno Nunes
     * @params string $table nome da tabela
     * @params array $fields campos de filtro
     * @params array $filter_dafult filtro que sera padrão
     * @return string 
     */
    public function build_filter($table = '', $fields = array(), $filter_default = '')
    {
            $retorno = $filter_default;
            if(isset($fields['param']) && !empty($fields['param']))
            {
                    foreach($fields['param'] as $key => $value)
                    {
                            if(isset($value) && !empty($value))
                            {
                                    $filter[] = $table.'.'.$key.(is_int($value) ? ' = '.$value : ' LIKE "%'.$value.'%" ');
                            }
                    }
            }
            if(isset($filter) && !empty($filter)) 
            {
                    $filter = implode(' AND ', $filter);
                    $retorno = (isset($filter_default) && !empty($filter_default)) ? $filter_default.' AND '.$filter : $filter;
            }
            return $retorno;
    }
    
    /*
     * Função para montar utl com base nos filtros de pesquisa.
     * Retorna string
     * 
     * @author Breno Henrique Moreno Nunes
     * @params array $fields campos de filtro
     * @params array $get campos de filtro preenchidos
     * @return string 
     */
    public function build_url($fields = array(), $get = array())
    {
            if(isset($fields) && !empty($fields))
            {
                foreach($fields as $key => $value)
                {
                        if(isset($get['param'][$key]) && !empty($get['param'][$key])) 
                        {
                                $fields[$key] = 'param['.$key.']='.$get['param'][$key];
                        }
                        elseif(isset($get[$key]) && !empty($get[$key]))
                        {
                            $fields[$key] = $key.'='.$get[$key];
                        }
                        else
                        {
                            $fields[$key] = $key.'=';
                        }
                }
                $fields = implode('&', $fields);
                return $fields;
            }
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
    public function do_upload($id = '')
    {
            $data = array();
            $dir = str_replace('\\', '/', getcwd()).'/uploads/files/'.date('Y/m/d').'/'.$id;
            if(!is_dir($dir)) $this->build_dir($dir);

            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png|pdf|doc|docx|txt';
            $config['max_size'] = 2048;
           
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('files')) 
            {
                $data['upload'] = array('error' => $this->upload->display_errors());
            }
            else
            {
                $this->load->model('attachment_model');
                $this->attachment_model->insert(array('id_request' => $id, 'description' =>  $this->upload->data('file_name'), 'path' => $this->upload->data('full_path')));
                $data['upload'] = array('success' => $this->upload->data());
            }
            return $data;
    }
    
    /*
    * Função para montar paginação de acordo com configuração passada.
    * Retorna string html
    * 
    * @author Breno Henrique Moreno Nunes
    * @params array $config
    * @return string 
    */
    public function get_pagination($config =  array())
    {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            return $this->pagination->create_links();
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
                    $this->email->subject($email['subject']);
                    $this->email->message($email['message']);
                    $retorno = $this->email->send();
            }
            return $retorno;
    }
    
    public function create_ckeditor($texto = '')
    {
        $retorno =  NULL;
        if(isset($texto) && $texto)
        {
            $this->load->helper('ckeditor_helper');
            // Array com as configurações pra essa instância do CKEditor ( você pode ter mais de uma )
            $data = array
            (
                //id da textarea a ser substituída pelo CKEditor
                'id'   => $texto,

                // caminho da pasta do CKEditor relativo a pasta raiz do CodeIgniter
                'path' => 'js/ckeditor',

                // configurações opcionais
                'config' => array
                (
                    'toolbar' => "Full",
                    'width'   => "100%",
                    'height'  => "200px",
                    'filebrowserBrowseUrl'      => base_url().'js/ckeditor/ckfinder/ckfinder.html',
                    'filebrowserImageBrowseUrl' => base_url().'js/ckeditor/ckfinder/ckfinder.html?Type=Images',
                    'filebrowserFlashBrowseUrl' => base_url().'js/ckeditor/ckfinder/ckfinder.html?Type=Flash',
                    'filebrowserUploadUrl'      => base_url().'js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    'filebrowserImageUploadUrl' => base_url().'js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    'filebrowserFlashUploadUrl' => base_url().'js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                )
            );
            $retorno = $data;
        }
        return $retorno;
    }
}
