<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Erro extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
        }

        public function index()
        {
                $this->layout
                    ->set_title('Faz, Que Falta - Erro')
                    ->set_view('pages/site/error');
        }
}
