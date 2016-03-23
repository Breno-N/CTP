<?php

class Layout
{
        /**
         * Propriedade privada da classe que representa os inlcudes
         * @property array 
         */
        private $includes = array();
        
        /**
         * Propriedade privada da classe que representa os arquivos javascripts
         * @property array 
         */
        private $js = array();
        
        /**
         * Propriedade privada da classe que representa os arquivos css
         * @property array 
         */
        private $css = array();

         /**
         * Propriedade privada da classe que representa o titulo da pagina
         * @property string 
         */
        private $title = '';

         /**
         * Propriedade privada da classe que representa a meta description
         * @property string 
         */
        private $description = '';

         /**
         * Propriedade privada da classe que representa a meta keywords
         * @property string 
         */
        private $keywords = '';

         /**
         * Propriedade privada da classe que representa o breadcrumbs
         * @property string 
         */
        private $breadcrumbs = '';
        
         /**
         * Propriedade privada da classe que representa uma view ou parte de html em formato de string
         * @property string 
         */
        private $html = '';

         /**
         * Propriedade privada da classe que representa o objeto CI do CodeIgniter
         * @property object 
         */
        private $CI;

        /**
         * Função construtora da classe que atribui a propriedade $CI
         * uma instancia do objeto CI.
         */
        public function __construct() 
        {
                $this->CI =& get_instance();
        }

        /**
         * Função que recupera o atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_includes()
        {
                return $this->includes;
        }
        
        /**
         * Função que recupera o atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_js()
        {
                return $this->js;
        }
        
        /**
         * Função que recupera o atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_css()
        {
                return $this->css;
        }


         /**
         * Função que recupera o valor atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_title()
        {
                return $this->title;
        }

         /**
         * Função que recupera o valor atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_description()
        {
                return $this->description;
        }

         /**
         * Função que recupera o valor atributo privado que leva o nome da função, ou seja
         * get_$propriedade, vai retornar a propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @return object
         */
        public function get_keywords()
        {
                return $this->keywords;
        }

        /**
         * Função que recupera os valores e monta o breadcrumbs(caminho de pão)
         * 
         * @author Breno Henrique Moreno Nunes
         * @param array $iten possui os valores a serem preenchidos para o breadcrumbs
         * @return string contem o html a ser montado
         */
        public function get_breadcrumbs()
        {
                $retorno = '';
                if(isset($this->breadcrumbs) && $this->breadcrumbs)
                {
                        $retorno  = '<ol class="breadcrumb">';
                        $retorno .= $this->breadcrumbs;
                        $retorno .= '</ol>';
                }
                return $retorno;
        }
        
        /**
         * Função que recupera a view em formato de string
         * 
         * @author Breno Henrique Moreno Nunes
         * @return string contem o html
         */
        public function get_html()
        {
                return $this->html;
        }

        /**
         * Função que seta o valor do atributo privado que leva o nome da função, ou seja
         * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param array|NULL|string $includes
         * @return object $this retorna a instancia do objeto da classe
         */
        public function set_includes($includes = NULL)
        {
                if(isset($includes) && $includes)
                {
                        switch($includes)
                        {
                                case strpos($includes, 'js/'):
                                    $this->includes[] = '<script src="'.base_url().'assets/'.$includes.'"></script>';
                                    break;
                                case strpos($includes, 'css/'):
                                    $this->includes[] = '<link rel="stylesheet" href="'.base_url().'assets/'.$includes.'" />';
                                    break;
                        }
                        return $this;
                }
        }
        
        /**
         * Função que seta o valor do atributo privado que leva o nome da função, ou seja
         * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param array|NULL|string $js
         * @return object $this retorna a instancia do objeto da classe
         */
        public function set_js($js = NULL, $externo = 0)
        {
                if(isset($js) && $js)
                {
                        $href = ($externo ? $js : base_url().'assets/'.$js);
                        $this->js[] = '<script type="text/javascript" src="'.$href.'"></script>';
                        return $this;
                }
        }
        
        /**
         * Função que seta o valor do atributo privado que leva o nome da função, ou seja
         * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param array|NULL|string $css
         * @return object $this retorna a instancia do objeto da classe
         */
        public function set_css($css = NULL, $externo = 0)
        {
                if(isset($css) && $css)
                {
                        $href = ($externo ? $css : base_url().'assets/'.$css);
                        $this->css[] = '<link rel="stylesheet" href="'.$href.'" />';
                        return $this;
                }
        }

        /**
        * Função que seta o valor do atributo privado que leva o nome da função, ou seja
        * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
        * 
        * @author Breno Henrique Moreno Nunes
        * @param string $title
        * @return object $this retorna a instancia do objeto da classe
        */
        public function set_title($title = '')
        {
                $this->title = $title;
                return $this;
        }

        /**
        * Função que seta o valor do atributo privado que leva o nome da função, ou seja
        * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
        * 
        * @author Breno Henrique Moreno Nunes
        * @param string $description
        * @return object $this retorna a instancia do objeto da classe
        */
        public function set_description($description = '')
        {
                $this->description = $description;
                return $this;
        }

        /**
        * Função que seta o valor do atributo privado que leva o nome da função, ou seja
        * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
        * 
        * @author Breno Henrique Moreno Nunes
        * @param string $keywords
        * @return object $this retorna a instancia do objeto da classe
        */
        public function set_keywords($keywords = '')
        {
                $this->keywords = $keywords;
                return $this;
        }


        /**
        * Função que seta o valor do atributo privado que leva o nome da função, ou seja
        * set_$propriedade, vai setar o valor que receber por parâmetro na propriedade da classe.
        * 
        * @author Breno Henrique Moreno Nunes
        * @param string $titulo titulo do link
        * @param string $link link propriamente dito
        * @param boolean $ativo se o link vai estar ativo ou não
        * @return object $this retorna a instancia do objeto da classe
        */
        public function set_breadcrumbs($titulo = '', $link = '', $ativo = FALSE)
        {
                if(!empty($titulo) && !empty($link))
                {
                        if((isset($ativo) && $ativo))
                        {
                                $this->breadcrumbs .= '<li '.((isset($ativo) && $ativo) ? 'class="active"' : '').'>'.$titulo.'</li>';
                        }
                        else
                        {
                                $this->breadcrumbs .= '<li '.((isset($ativo) && $ativo) ? 'class="active"' : '').'><a href="'.base_url().$link.'">'.$titulo.'</a></li>';
                        }
                        return $this;
                }
        }
        
        /**
         * Função que seta a view ou parte do html em formato de string
         * 
         * @author Breno Henrique Moreno Nunes
         * @param string $html view que contem o html a ser incluido na pagina
         * @param string $data dados que serão utilizados por este html
         * @return string html em formato de string
         */
        public function set_html($html = '', $data = array())
        {
                $this->html = $this->CI->load->view($html, $data, TRUE);
        }

        /**
         * Função que seta duas views padrões: topo e o rodape, e entre elas carrega a view informada
         * para montar a pagina, com ou sem dados adicionais.
         * 
         * @author Breno Henrique Moreno Nunes
         * @param string $view view que será carregada.
         * @param array  $data dados adicionais a passar para a view.
         * @param string $template string indicando o caminho do layout padrão a ser carregado.
         */
        public function set_view($view = '', $data = NULL, $template = 'template/site/')
        {
                $header['title'] = $this->get_title();
                $header['description'] = $this->get_description();
                $header['keywords'] = $this->get_keywords();
                $header['includes'] = $this->get_includes();
                $header['css'] = $this->get_css();
                $navbar['breadcrumbs'] = $this->get_breadcrumbs();
                $dados['header'] = $this->CI->load->view($template.'header', $header, TRUE);
                $dados['navbar'] = $this->CI->load->view($template.'navbar', $navbar, TRUE);
                $dados['footer'] = $this->CI->load->view($template.'footer', NULL, TRUE);
                $dados['content'] = $this->CI->load->view($view, $data, TRUE);
                $dados['js'] = $this->get_js();
                $this->CI->load->view($template.'layout', $dados);
        }
}