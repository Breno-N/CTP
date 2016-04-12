<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quem_somos extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
        }

        public function index()
        {
                $this->layout
                    ->set_title('Faz, Que Falta - Sobre')
                    ->set_keywords('Faz Que Falta, empreendedorismo, empreendedor, transformação social, demanda, sociedade, pedidos, ideia')
                    ->set_description('Quem Somos - Faz Que Falta, conheça um pouco de quem faz o Faz Que Falta')
                    ->set_view('pages/site/about', array());
        }
}
