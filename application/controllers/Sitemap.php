<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct(FALSE);
        }

        public function index()
        {
                $this->layout
                    ->set_title('Faz, Que Falta - SiteMap')
                    ->set_view('pages/site/sitemap');
        }
}
