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
                    ->set_keywords('Empreendedor, Empreendedorismo, Pequenos, Negócios, Abrir um negócio, Social, Faz Que Falta, Falta, Demanda, Ideia, Cidadão, Bairro')
                    ->set_description('Faz Que Falta, o sistema que conecta o empreendedor às demandas da sociedade. Faça o seu pedido!')
                    ->set_js('site/js/footer.js')
                    ->set_view('pages/site/about', array());
        }
}
