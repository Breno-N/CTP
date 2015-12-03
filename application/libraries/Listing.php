<?php

class Listing 
{
    private $actions;
    
    private $fields;
    
    private $filters;
    
    private $itens;
    
    private $CI;
    
    public function __construct() 
    {
            $this->CI =& get_instance();
    }
    
    public function get_actions() 
    {
            return $this->actions;
    }

    public function get_fields() 
    {
            return $this->fields;
    }

    public function get_filters()
    {
            return $this->filters;
    }
    
    public function get_itens()
    {
            return $this->itens;
    }

    public function set_actions($actions) 
    {
            $this->actions = $actions;
            return $this;
    }

    public function set_fields($fields) 
    {
            $this->fields = $fields;
            return $this;
    }

    public function set_filters($filters) 
    {
            $this->filters = $filters;
            return $this;
    }
    
    public function set_itens($itens) 
    {
            $this->itens = $itens;
            return $this;
    }

    public function build_list()
    {
            $dados['actions'] = $this->get_actions();
            $dados['filters'] = $this->get_filters();
            $dados['fields'] = $this->get_fields();
            $dados['itens'] = $this->get_itens();
            return $this->CI->load->view('template/admin/list', $dados, TRUE);
    }
}
