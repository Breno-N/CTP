<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
        public function __construct($login = TRUE, $maintenance = FALSE)
        {
                parent::__construct();
                
                if(not_support_browser()) redirect('manutencao/sem_suporte');
                
                if($maintenance) redirect('manutencao');

                $this->load->library(array('layout'));

                if(isset($login) && $login) $this->_is_authenticated();
        }
        
        private function _is_authenticated()
        {
                if(!$this->session->userdata('authentication')) redirect('login');
        }

        protected function _is_autorized($redirect = '')
        {
                if(!$this->session->userdata('admin')) redirect($redirect);
        }
        
        public function do_upload($id = '', $path = '', $type = '')
        {
                $data = array();

                if(!is_dir($path)) build_dir($path);

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'pdf|jpg|jpeg|png|tif';
                $config['max_size'] = 5120; // 5 mega
                $config['file_name'] = $id;
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('files')) 
                {
                        $data['upload'] = array('error' => $this->upload->display_errors());
                }
                else
                {
                        if($type == 'Foto')
                        {
                                $resize['image_library'] = 'gd2';
                                $resize['source_image'] = $path.$this->upload->data('file_name');
                                $resize['create_thumb'] = FALSE;
                                $resize['maintain_ratio'] = TRUE;
                                $resize['width'] = 283;
                                $resize['height'] = 188;
                                $this->load->library('image_lib', $resize);
                                $this->image_lib->resize();
                        }
                        $this->load->model('attachment_model');
                        $this->attachment_model->insert(array('id_user_request' => $id, 'description' =>  $this->upload->data('file_name'), 'path' => $path.$this->upload->data('file_name'), 'type' => $type));
                        $data['upload'] = array('success' => $this->upload->data());
                }
                return $data;
        }
        
        protected function _set_temp_pedido($post = array())
        {
                $pedido_session = array(
                    'pedido_session' => array(
                        'business' => $post['business'],
                        'description' => $post['description'],
                        'have_business_neighborhood' => (isset($post['have_business_neighborhood']) && $post['have_business_neighborhood'] ? 1 : 0),
                        'quantity' => (isset($post['quantity']) && !empty($post['quantity']) && $post['quantity'] ? $post['quantity'] : 1),
                    )
                );
                $this->session->set_tempdata($pedido_session, NULL, 3600);
        }
        
        protected function _set_temp_pedido_upload($files = array())
        {
                if(isset($files['files']['name']) && !empty($files['files']['name']))
                {
                        $pedido_upload['pedido_upload']['tmp_id'] = mt_rand();
                        $pedido_upload['pedido_upload']['tmp_path'] = 'uploads/files/'.date('Y/m/');
                        $pedido_upload['pedido_upload']['tmp_ext'] = pathinfo($files['files']['name'], PATHINFO_EXTENSION);
                        $this->do_upload($pedido_upload['pedido_upload']['tmp_id'], $pedido_upload['pedido_upload']['tmp_path'], 'Arquivo');
                        $this->session->set_userdata($pedido_upload);
                }
        }
        
        protected function _unlink_temp_pedido_upload()
        {
                if(isset($this->session->userdata['pedido_upload']['tmp_id']) && !empty($this->session->userdata['pedido_upload']['tmp_id']))
                {
                        $old_file = $this->session->userdata['pedido_upload']['tmp_path'].$this->session->userdata['pedido_upload']['tmp_id'].'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                        unlink($old_file);
                }
        }

        public function send_email($email = array())
        {
                $retorno = FALSE;
                if(isset($email) && $email)
                {
                        $this->load->library('email');
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->to($email['to']);
                        if(isset($email['name']) && !empty($email['name']))
                        {
                                $this->email->from($email['from'], $email['name']);
                        }
                        else
                        {
                                $this->email->from($email['from']);
                        }
                        $this->email->cc(array('guilhermec341@gmail.com', 'marcello.do.nascimento@gmail.com'));
                        $this->email->subject($email['subject']);
                        $this->email->message($email['message']);
                        $retorno = $this->email->send();
                }
                return $retorno;
        }

        protected function save_log($message = '', $user = '')
        {
                $data['description'] = $message;
                $data['user'] = (isset($this->session->userdata['email']) && !empty($this->session->userdata['email']) ? $this->session->userdata['email'] : $user);
                $data['date'] = date('Y-m-d H:i:s');
                $this->load->model('logs_model');
                $this->logs_model->insert($data);
        }
        
        protected function error($data = array())
        {
                $this->layout
                        ->set_title('Admin - Erro')
                        ->set_view('pages/admin/contents/error', $data, 'template/admin/');
        }
}
