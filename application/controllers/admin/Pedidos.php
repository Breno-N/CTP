<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends MY_Controller
{
        public function __construct() 
        {
            parent::__construct();
                $this->load->model(array('requests_model', 'users_model', 'user_request_model', 
                    'neighborhood_model', 'attachment_model', 'business_model', 'type_business_model', 
                    'type_request_status_model', 'requests_comments_model'));
        }
        
        public function index()
        {
                $this->listar();
        }
        
        public function listar()
        {
                if($this->get_neighborhood())
                {
                        $data['data_table'] = $this->_init_data_table();
                        $data['action_adicionar'] = base_url().'admin/'.strtolower(__CLASS__).'/adicionar';
                        $this->layout
                                ->set_title('Admin - Pedidos')
                                ->set_css('admin/css/layout-datatables.css')
                                ->set_js('admin/js/data_table.js')
                                ->set_js('admin/js/update_delete.js')
                                ->set_js('admin/js/requests.js')
                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                ->set_breadcrumbs('Pedidos', 'admin/pedidos/', 1)
                                ->set_view('pages/admin/contents/requests', $data, 'template/admin/');
                }
                else
                {
                        redirect('admin/usuarios/editar/'.$this->session->userdata['id']);
                }
        }
        
        private function _init_data_table()
        {
                $default_filter = ($this->session->userdata['type'] != '1') ? 'ctp_requests.active = 1' : 'ctp_requests.active = 1 AND (ctp_user_request.id_user = '.$this->session->userdata['id'].' OR ctp_requests.id_neighborhood = '.$this->session->userdata['neighborhood'].')';
                $data['itens'] = $this->requests_model->get_itens($default_filter);
                $data['action_detalhes'] = base_url().'admin/'.strtolower(__CLASS__).'/detalhes/';
                $this->layout->set_html('pages/admin/tables/requests', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                if($this->get_neighborhood())
                {
                        $this->_adicionar_pedido_session();
                        $this->form_validation->set_rules('business', 'Negócio', array('required', array('is_valid_business', array($this->business_model, 'is_valid_business')), 'trim'));
                        $this->form_validation->set_rules('description', 'Descrição', array('required', 'trim'));
                        $this->form_validation->set_rules('quantity', 'Reforçar Pedidos', array('integer', 'trim'));
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $id_business = $this->business_model->get_business_by_name($data['business']);
                                $data['id_business'] = $id_business;
                                $data['quantity'] = (isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : 1);
                                $data['request_public_agency'] = (isset($data['request_public_agency']) ? 1 : 0 );
                                $data['have_business_neighborhood'] = (isset($data['have_business_neighborhood']) ? 1 : 0 );
                                $data['id_neighborhood'] = $this->session->userdata['neighborhood'];
                                $data['user_create'] = $this->session->userdata['email'];
                                $data['date_create'] = date('Y-m-d');
                                unset($data['business']);
                                $id = $this->requests_model->insert($data);
                                if($id)
                                {
                                        $this->save_log('Pedidos inserido ID : '.$id);
                                        $data_user_request['id_request'] = $id;
                                        $data_user_request['id_user'] = $this->session->userdata['id'];
                                        $id_user_request = $this->user_request_model->insert($data_user_request);
                                        $this->save_log('Relação de Pedidos e Usuarios inserido ID : '.$id_user_request);
                                        if(isset($_FILES['files']['name']) && !empty($_FILES['files']['name']))
                                        {
                                                $this->do_upload($id, 'uploads/files/'.date('Y/m/'), 'Arquivo');
                                        }
                                }
                                redirect('admin/pedidos/detalhes/'.$id.'/1');
                        }
                        else
                        {
                                $classe = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['classe'] = $classe;
                                $data['function'] = $function;
                                $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                                $data['status'] = $this->get_status();
                                $data['type_business'] = $this->get_type_business();
                                $this->layout
                                            ->set_title('Admin - Pedidos - Adicionar')
                                            ->set_js('admin/js/business_autocomplete.js')
                                            ->set_js('admin/js/requests.js')
                                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                            ->set_breadcrumbs('Pedidos', 'admin/pedidos/', 0)
                                            ->set_breadcrumbs('Adicionar', 'admin/pedidos/', 1)
                                            ->set_view('pages/admin/forms/requests', $data, 'template/admin/');
                        }
                }
                else
                {
                        redirect('admin/usuarios/editar/'.$this->session->userdata['id']);
                }
        }
        
        private function _adicionar_pedido_session()
        {
                if(isset($this->session->userdata['pedido_session']) && !empty($this->session->userdata['pedido_session']))
                {
                        $data = $this->session->userdata['pedido_session'];
                        $id_business = $this->business_model->get_business_by_name($data['business']);
                        unset($data['business']);
                        if(isset($id_business) && $id_business)
                        {
                                $business_exists_neighborhood = $this->requests_model->get_select_business('ctp_business.id = "'.$id_business.'" AND ctp_requests.id_neighborhood = '.$this->session->userdata['neighborhood'].' AND ctp_requests.active = 1');
                                if($business_exists_neighborhood)
                                {
                                        $update = 0;
                                        $have_support = $this->user_request_model->get_item('ctp_user_request.id_request = '.$business_exists_neighborhood.' AND ctp_user_request.id_user = '.$this->session->userdata['id']);
                                        if(!isset($have_support))
                                        {
                                                $data_user_request['id_user'] = $this->session->userdata['id'];
                                                $data_user_request['id_request'] = $business_exists_neighborhood;
                                                $id_user_request = $this->user_request_model->insert($data_user_request);
                                                if($id_user_request)
                                                {
                                                        $this->save_log('Relação de Pedidos e Usuarios inserido ID : '.$id_user_request);
                                                        $qtde = $this->requests_model->get_quantity('ctp_requests.id = '.$business_exists_neighborhood);
                                                        $update = $this->requests_model->update(array('quantity' => ++$qtde), 'ctp_requests.id = '.$business_exists_neighborhood);
                                                        $this->save_log('Pedidos apoiado ID : '.$business_exists_neighborhood);
                                                        
                                                        if(isset($this->session->userdata['pedido_upload']) && !empty($this->session->userdata['pedido_upload']))
                                                        {
                                                                $old_file = $this->session->userdata['pedido_upload']['tmp_path'].$this->session->userdata['pedido_upload']['tmp_id'].'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                                                                $new_dir = 'uploads/files/'.date('Y/m/').$business_exists_neighborhood.'/';
                                                                $new_name = date('His').'.'.$this->session->userdata['pedido_upload']['tmp_ext'];

                                                                $this->build_dir($new_dir);
                                                                $new_file = $new_dir.$new_name;

                                                                rename($old_file, $new_file);

                                                                $this->attachment_model->remove('ctp_attachment.id_user_request = "'.$this->session->userdata['pedido_upload']['tmp_id'].'" ');
                                                                $this->attachment_model->insert(array('id_user_request' => $business_exists_neighborhood, 'description' =>  $new_name, 'path' => $new_file, 'type' => 'Arquivo'));
                                                        }
                                                        
                                                        $this->session->unset_userdata(array('pedido_session', 'pedido_upload'));
                                                        redirect('admin/pedidos/detalhes/'.$business_exists_neighborhood.'/3');
                                                }
                                        }
                                        else
                                        {
                                                if(isset($this->session->userdata['pedido_upload']) && !empty($this->session->userdata['pedido_upload']))
                                                {
                                                        $old_file = $this->session->userdata['pedido_upload']['tmp_path'].$this->session->userdata['pedido_upload']['tmp_id'].'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                                                        $new_dir = 'uploads/files/'.date('Y/m/').$business_exists_neighborhood.'/';
                                                        $new_name = date('His').'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                                                        
                                                        $this->build_dir($new_dir);
                                                        $new_file = $new_dir.$new_name;
                                                       
                                                        rename($old_file, $new_file);
                                                        
                                                        $this->attachment_model->remove('ctp_attachment.id_user_request = "'.$this->session->userdata['pedido_upload']['tmp_id'].'" ');
                                                        $this->attachment_model->insert(array('id_user_request' => $business_exists_neighborhood, 'description' =>  $new_name, 'path' => $new_file, 'type' => 'Arquivo'));
                                                }
                                            
                                                $this->session->unset_userdata(array('pedido_session', 'pedido_upload'));
                                                redirect('admin/pedidos/detalhes/'.$business_exists_neighborhood.'/2');
                                        }
                                }
                                else
                                {
                                        $data['id_business'] = $id_business;
                                        $data['id_neighborhood'] = $this->session->userdata['neighborhood'];
                                        $data['user_create'] = $this->session->userdata['email'];
                                        $data['date_create'] = date('Y-m-d');
                                        $id = $this->requests_model->insert($data);
                                        if($id)
                                        {
                                                $this->save_log('Pedidos inserido ID : '.$id);
                                                $data_user_request['id_request'] = $id;
                                                $data_user_request['id_user'] = $this->session->userdata['id'];
                                                $id_user_request = $this->user_request_model->insert($data_user_request);
                                                $this->save_log('Relação de Pedidos e Usuarios inserido ID : '.$id_user_request);
                                                
                                                if(isset($this->session->userdata['pedido_upload']) && !empty($this->session->userdata['pedido_upload']))
                                                {
                                                        $old_file = $this->session->userdata['pedido_upload']['tmp_path'].$this->session->userdata['pedido_upload']['tmp_id'].'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                                                        $new_dir = 'uploads/files/'.date('Y/m/').$id.'/';
                                                        $new_name = date('His').'.'.$this->session->userdata['pedido_upload']['tmp_ext'];
                                                        
                                                        $this->build_dir($new_dir);
                                                        $new_file = $new_dir.$new_name;
                                                       
                                                        rename($old_file, $new_file);
                                                        
                                                        $this->attachment_model->remove('ctp_attachment.id_user_request = "'.$this->session->userdata['pedido_upload']['tmp_id'].'" ');
                                                        $this->attachment_model->insert(array('id_user_request' => $id, 'description' =>  $new_name, 'path' => $new_file, 'type' => 'Arquivo'));
                                                }
                                        }
                                        $this->session->unset_userdata(array('pedido_session', 'pedido_upload'));
                                        redirect('admin/pedidos/detalhes/'.$id.'/1');
                                }
                        }
                }
        }
        
        public function detalhes($codigo = '', $ok = FALSE)
        {
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->requests_model->get_item('ctp_requests.id = '.$codigo);
                        if(!isset($dados) || empty($dados))
                        {
                                $this->error();
                        }
                        else
                        {
                                $classe = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['classe'] = $classe;
                                $data['function'] = $function;
                                $data['action'] = base_url().'admin/'.$classe.'/'.$function.'/'.$codigo;
                                $data['item'] = $dados;
                                $data['ok'] = (isset($ok) && $ok) ? $ok : FALSE;
                                $data['status'] = $this->get_status();
                                $data['type_business'] = $this->get_type_business();
                                $data['attachments'] = $this->attachment_model->get_itens('ctp_attachment.id_user_request = '.$codigo.' AND ctp_attachment.type = "Arquivo" AND ctp_attachment.done = 0');
                                $data['request_support'] = $this->user_request_model->get_item('ctp_user_request.id_request = '.$codigo.' AND ctp_user_request.id_user = '.$this->session->userdata['id']);
                                $this->layout
                                        ->set_title('Admin - Pedidos - Detalhes')
                                        ->set_js('admin/js/business_autocomplete.js')
                                        ->set_js('admin/js/requests.js')
                                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                        ->set_breadcrumbs('Pedidos', 'admin/pedidos/', 0)
                                        ->set_breadcrumbs('Detalhes', 'admin/requisicoes/detalhes', 1)
                                        ->set_view('pages/admin/forms/requests', $data, 'template/admin/');
                        }
                }
                else
                {
                        redirect('painel');
                }
        }
        
        public function apoiar()
        {
                $support = $this->_post();
                $update = 0;
                if(isset($support['request']) && !empty($support['request']))
                {
                        $have_support = $this->user_request_model->get_item('ctp_user_request.id_request = '.$support['request'].' AND ctp_user_request.id_user = '.$this->session->userdata['id']);
                        if(!isset($have_support))
                        {
                                $data_user_request['id_user'] = $this->session->userdata['id'];
                                $data_user_request['id_request'] = $support['request'];
                                $id_user_request = $this->user_request_model->insert($data_user_request);
                                if($id_user_request)
                                {
                                        $this->save_log('Relação de Pedidos e Usuarios inserido ID : '.$id_user_request);
                                        $qtde = $this->requests_model->get_quantity('ctp_requests.id = '.$support['request']);
                                        $update = $this->requests_model->update(array('quantity' => ++$qtde), 'ctp_requests.id = '.$support['request']);
                                        $this->save_log('Pedidos apoiado ID : '.$support['request']);
                                }
                        }
                }
                echo json_encode($update);
        }
        
        public function download($id = '')
        {
                $this->_is_autorized('admin/painel/');
                if(empty($id)) exit();
                //$file = $this->attachment_model->get_item('ctp_attachment.id_user_request = '.$id.' AND ctp_attachment.type = "Arquivo" ');
                $file = $this->attachment_model->get_item('ctp_attachment.id = '.$id.' AND ctp_attachment.type = "Arquivo" ');
                $name = explode('.', $file->description);
                $name = $file->id.'.'.$name[1];
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary"); 
                header('Content-Disposition: attachment; filename="'.$name.'"');
                readfile($file->path);
                exit();
        }
        
        public function get_status()
        {
                return $this->type_request_status_model->get_select(NULL, 'description', 'ASC');
        }
        
        private function get_neighborhood()
        {
                return $this->users_model->get_neighborhood('ctp_users.id = '.$this->session->userdata['id']);
        }
        
        public function get_type_business()
        {
                return $this->type_business_model->get_select('ctp_type_business.active = 1', 'description', 'ASC');
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