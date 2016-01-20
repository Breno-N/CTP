<?php

class Comment
{
        private $comments = array();
        
        private $title = '';
        
        private $is_admin = 0;
        
        private $can_post = 0;
        
        private $CI;
    
        public function __construct()
        {
                $this->CI =& get_instance();
        }
        
        public function get_comments() 
        {
                return $this->comments;
        }
        
        public function set_comments($comments) 
        {
                $this->comments = $comments;
                return $this;
        }
        
        public function get_title() 
        {
                return $this->title;
        }

        public function set_title($title) 
        {
                $this->title = $title;
                return $this;
        }
        
        public function get_is_admin() 
        {
                return $this->is_admin;
        }

        public function set_is_admin($is_admin) 
        {
                $this->is_admin = $is_admin;
                return $this;
        }
        
        public function get_can_post() 
        {
                return $this->can_post;
        }

        public function set_can_post($can_post) 
        {
                $this->can_post = $can_post;
                return $this;
        }
        
        public function set_view()
        {
                $data['comments'] = $this->comments;
                $data['title'] = $this->title;
                $data['is_admin'] = $this->is_admin;
                $data['can_post'] = $this->can_post;
                return $this->CI->load->view('admin/comment/add_list', $data, TRUE);
        }
}