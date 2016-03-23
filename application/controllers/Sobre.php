<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sobre extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
        }

        public function index()
        {
                $this->layout
                    ->set_title('Faz, Que Falta - Sobre')
                    ->set_description('')
                    ->set_view('pages/site/about', array());
        }
}
