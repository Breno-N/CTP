<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manutencao extends CI_Controller
{
        public function __construct() 
        {
                parent::__construct();
        }
        
        public function index()
        {
                if(not_support_browser()) redirect('manutencao/sem_suporte');
            
                $this->load->view('pages/maintenance', array());
        }
        
        public function sem_suporte()
        {
                $this->load->view('pages/not_support', array());
        }
}