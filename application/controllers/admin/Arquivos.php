<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arquivos extends MY_Controller
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('attachment_model'));
        }
        
        public function index()
        {
                $this->listar();
        }
        
        public function listar()
        {
                $this->_is_autorized('admin/painel/');
                $data['data_table'] = $this->_init_data_table();
                $data['action_adicionar'] = base_url().'admin/'.strtolower(__CLASS__).'/adicionar';
                $this->layout
                        ->set_title('Admin - Arquivos')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Arquivos', 'admin/arquivos/', 1)
                        ->set_view('pages/admin/contents/files', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->attachment_model->get_itens();
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('pages/admin/tables/files', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules('files', 'Arquivo', array( array('is_extension_csv', array($this->attachment_model, 'is_extension_csv') ) ) );
                if($this->form_validation->run())
                {
                        $this->load->library(array('bcrypt'));
                        $this->load->model(array('requests_model', 'users_model', 'user_request_model'));
                        $csv = file($_FILES['files']['tmp_name']);
                        unset($csv[0]);
                        $qtde = count($csv);
                        $request = 0;
                        $update = 0;
                        
                        $user_query = 'INSERT INTO ctp_users (name, cpf, id_address, email, temp_password, temp_password_date) VALUES ';
                        for($i = 1; $i <= $qtde; $i++)
                        {
                                $fields = explode(';', $csv[$i]);
                                $request = $fields[4];
                                $user_exists = $this->users_model->user_exists($fields[1], $fields[3]);
                                if($user_exists) continue;
                                
                                $values[] = '("'.$fields[0].'", "'.$fields[1].'", "'.$fields[2].'", "'.$fields[3].'", "'.Bcrypt::hash(uniqid(mt_rand(), TRUE)).'", "'.date('Y-m-d').'" )';
                        }
                        $user_query .= implode(',', $values);
                        $this->users_model->query($user_query, 'insert');
                        
                        $user_request_query = 'INSERT INTO ctp_user_request (id_user, id_request) VALUES ';
                        for($i = 1; $i <= $qtde; $i++)
                        {
                                $fields = explode(';', $csv[$i]);
                                $user_exists = $this->users_model->user_exists($fields[1], $fields[3]);
                                if($user_exists)
                                {
                                        $already_support = $this->user_request_model->user_already_support_request($user_exists, $fields[4]);
                                        
                                        if($already_support) continue;
                                        
                                        $requests[] = '("'.$user_exists.'" , "'.$request.'")';
                                        $update++;
                                }
                        }
                        $user_request_query .= implode(',', $requests);
                        $this->user_request_model->query($user_request_query, 'insert');
                        
                        //$this->requests_model->update(array('quantity' => $update), 'ctp_requests.id = '.$request);
                        $this->save_log('Inserção massiva de usuarios e pedidos incluso. ');
                        redirect('admin/arquivos/');
                }
                $classe = strtolower(__CLASS__);
                $function = strtolower(__FUNCTION__);
                $data['classe'] = $classe;
                $data['function'] = $function;
                $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                $this->layout
                            ->set_title('Admin - Arquivos - Adicionar')
                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                            ->set_breadcrumbs('Arquivos', 'admin/arquivos/', 0)
                            ->set_breadcrumbs('Adicionar', 'admin/arquivos/', 1)
                            ->set_view('pages/admin/forms/files', $data, 'template/admin/');
        }
        
        public function remover()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->attachment_model->get_total_itens('ctp_attachment.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->attachment_model->update(array('done' => 0),'ctp_attachment.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Arquivos excluido ID : '.$item);
                                //unlink($caminho_do_arquivo);
                        }
                }
                echo json_encode($qtde);
        }
        
        public function feito()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->attachment_model->get_total_itens('ctp_attachment.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->attachment_model->update(array('done' => 1),'ctp_attachment.id = '.$item);
                                if($deleted) $qtde++;
                                $this->save_log('Arquivos marcados como feito ID : '.$item);
                        }
                }
                echo json_encode($qtde);
        }
        
        private function _get()
        {
                return sanitize($this->input->get(NULL, TRUE));
        }
        
        private function _post()
        {
                return sanitize($this->input->post(NULL, TRUE));
        }
}