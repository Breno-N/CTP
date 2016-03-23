<?php

class Logs
{
        private $CI;

        public function __construct() 
        {
                $this->CI =& get_instance();
                $this->CI->load->model('logs_model');
        }
        
        public function save($message = '', $user = '')
        {
                $data['description'] = $message;
                $data['user'] = (isset($this->CI->session->userdata['email']) && !empty($this->CI->session->userdata['email']) ? $this->CI->session->userdata['email'] : $user);
                $data['date'] = date('Y-m-d H:i:s');
                $this->CI->logs_model->insert($data);
        }
}