<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 
 * Classe a ser utilizada como exemplo para desenvolvimento de outros Controllers.
 * @author Breno Henrique Moreno Nunes
 */
class Example extends MY_Controller
{
        /**
         * Array de dados que será validado com a classe auxiliar do CodeIgniter.
         * 
         * @author Breno Henrique Moreno Nunes
         * @var array $valida
         */
        private $valida = array(
                                    array('field'=> 'campo', 'label' => 'nome_do_campo', 'rules' => 'regras_separadas_por_barra_vertical'),
                                    array('field'=> 'campo', 'label' => 'nome_do_campo', 'rules' => 'regras_separadas_por_barra_vertical'),
                                    array('field'=> 'campo', 'label' => 'nome_do_campo', 'rules' => 'regras_separadas_por_barra_vertical'),
                                    array('field'=> 'campo', 'label' => 'nome_do_campo', 'rules' => 'regras_separadas_por_barra_vertical')
                                ); 

        /**
         * Função construtora, carrega classes utilizadas por padrão.
         * 
         */
        public function __construct() 
        {
                parent::__construct();
                $this->load->library(array('library'));
                $this->load->model(array('model'));
        }

        /**
         * Primeira Função a ser executada quando o controlador for chamado.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function index()
        {
                $this->listar();
        }

        /**
         * Recupera dados utilizando o model e exibe a listagem de dados na view add_listagem.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function listar()
        {
                $itens = $this->model->get_itens();
                $data['listagem'] = $this->_inicia_listagem($itens);
                $this->layout
                        ->set_includes('js/script.js')
                        ->set_includes('js/script.js')
                        ->set_view('add_listagem', $data);

        }

        /**
         * Função privada que se encarrega de montar a listagem de dados.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        private function _inicia_listagem($itens = array(), $extras = array())
        {
            $data['cabecalho'] = array(
                (object) array('campo' => 'coluna', 'titulo' => 'nome'),
                (object) array('campo' => 'coluna', 'titulo' => 'nome'),
                (object) array('campo' => 'coluna', 'titulo' => 'nome'),
                (object) array('campo' => 'coluna', 'titulo' => 'nome'),
                (object) array('campo' => 'coluna', 'titulo' => 'nome'),
            );
            $data['itens'] = $itens['itens'];
            $data['extras'] = $extras;
            $this->listagem->inicia($data);
            return $this->listagem->set_itens();
        }

        /*
         * Função responsável por realizar validação dos campos do formulário,
         * se estiver tudo certo adiciona os dados de usuario,
         * por fim redireciona para formulário de edição com os dados já preenchidos.
         * Caso de erro na validação redireciona usuario para formulario de inserção novamente.
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function adicionar()
        {
            $this->form_validation->set_rules($this->valida); 
            $this->form_validation->set_message('required','O {field} é obrigatório');
            $this->form_validation->set_message('valid_email','O campo {field} deve ser um E-mail válido');
            $this->form_validation->set_message('max_length','O campo {field} não pode exceder o tamanho de {param} caracteres');
            if($this->form_validation->run())
            {
                $data = $this->_post();
                $data['campo'] = Bcrypt::hash($data['campo']);
                $id = $this->model->adicionar($data);
                redirect('controller/editar/'.$id.'/1');
            }
            else
            {
                $classe = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['classe'] = $classe;
                $data['function'] = $function;
                $data['action'] = base_url().$classe.'/'.$function;
                $this->layout
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/', 0)
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/listar', 0)
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/', 1)
                            ->set_view('add_view',$data);
            }
        }

        /*
         * Função responsável por realizar validação dos campos do formulário,
         * se estiver tudo certo edita os dados de usuario e alguns dados da sessão
         * por fim redireciona para formulario de edição com os dados já preenchidos.
         * Caso de erro na validação redireciona usuario para formulario de edição novamente.
         * Caso o código não exista redireciona para pagina principal do sistema.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param integer $codigo representa o id a ser editado
         * @param boolean $ok indica se a alteração foi realizada com sucesso ou não
         */
        public function editar($codigo = '', $ok = FALSE)
        {
            if(isset($codigo) && $codigo)
            {
                $dados = $this->model->get_item('nome_da_tabela.id = '.$codigo);
                $this->form_validation->set_rules($this->valida); 
                $this->form_validation->set_message('required','O campo %s é obrigatório');
                $this->form_validation->set_message('valid_email','O campo %s deve ser um E-mail válido');
                $this->form_validation->set_message('max_length','O campo %s não pode exceder o tamanho de %s caracteres');
                if($this->form_validation->run())
                {
                    $data = $this->_post();
                    if(isset($data['campo']) && !empty($data['campo']))
                    {
                        $data['campo'] = Bcrypt::hash($data['campo']);
                    }

                    $id = $this->model->editar($data, 'nome_da_tabela.id = '.$codigo);

                    if($this->session->userdata['id'] == $codigo)
                    {
                        $session = array(
                            'nome' => $data['nome'],
                            'tipo' => $data['tipo']
                        );
                    }
                    $this->session->set_userdata($session);
                    redirect('controller/editar/'.$codigo.'/1');
                }
                else
                {
                    $classe = strtolower(__CLASS__);
                    $function = strtolower(__FUNCTION__);
                    $data['classe'] = $classe;
                    $data['function'] = $function;
                    $data['action'] = base_url().$classe.'/'.$function.'/'.$codigo;
                    $data['item'] = $dados;
                    $data['ok'] = (isset($ok) && $ok) ? TRUE : FALSE;
                    $this->layout
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/', 0)
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/listar', 0)
                            ->set_breadcrumbs('Breadscrumbs', 'breadscrumbs/', 1)
                            ->set_view('add_views',$data);
                }
            }
            else
            {
                redirect('controller');
            }
        }

        /*
         * Função responsável por realizar a exclusão de registros,
         * se  o usuario confirmar a exclusão será realizada e uma mensagem de sucesso aparecera.
         * Caso de erro outra mensagem aparecerá
         * 
         * @author Breno Henrique Moreno Nunes
         */
        public function remover()
        {
            $data = $this->_post();
            $qtde = $this->model->deletar('nome_da_tabela.id IN('.implode(',', $data['deletar']).')');
            echo $qtde;
        }

        /**
         * Função que recupera e trata todos os $_POST que ocorrem neste controller.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        private function _post()
        {
            return sanitize($this->input->post(NULL, TRUE));
        }
        
        /**
         * Função que recupera e trata todos os $_POST que ocorrem neste controller.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        private function _get()
        {
            return sanitize($this->input->get(NULL, TRUE));
        }
}
