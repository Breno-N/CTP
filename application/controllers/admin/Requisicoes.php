<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisicoes extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'title', 'label' => 'Titulo', 'rules' => 'required|trim'),
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|trim'),
                                    array('field'=> 'id_type_business', 'label' => 'Tipo de Requisição', 'rules' => 'required|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('requests_model', 'users_model', 'user_request_model', 'neighborhood_model', 'attachment_model', 'type_request_status_model', 'type_business_model'));
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
                                ->set_title('CTP - Admin - Requisições')
                                ->set_description('')
                                ->set_keywords('')
                                ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                                ->set_includes('js/dataTables/jquery.dataTables.min.js')
                                ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                                ->set_includes('js/chart/Chart.js')
                                ->set_includes('js/data_table.js')
                                ->set_includes('js/requests.js')
                                ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                ->set_breadcrumbs('Requisições', 'admin/requisicoes/', 1)
                                ->set_view('admin/requests/add_list', $data, 'template/admin/');
                }
                else
                {
                        redirect('admin/usuarios/editar/'.$this->session->userdata['id']);
                }
        }
        
        private function _init_data_table()
        {
                $default_filter = ($this->session->userdata['type'] == '3') ? 'ctp_requests.active = 1' : 'ctp_requests.active = 1 AND (ctp_user_request.id_user = '.$this->session->userdata['id'].' OR ctp_requests.id_neighborhood = '.$this->session->userdata['neighborhood'].')';
                $data['itens'] = $this->requests_model->get_itens($default_filter);
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/requests/table', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                if($this->get_neighborhood())
                {
                        $this->form_validation->set_rules($this->validate); 
                        $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                        $this->form_validation->set_message('integer','O campo "{field}" dever ser numérico');
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['request_public_agency'] = (isset($data['request_public_agency']) ? 1 : 0 );
                                $data['have_business_neighborhood'] = (isset($data['have_business_neighborhood']) ? 1 : 0 );
                                $data['id_neighborhood'] = $this->session->userdata['neighborhood'];
                                $data['user_create'] = $this->session->userdata['email'];
                                $data['date_create'] = date('Y-m-d');
                                $id = $this->requests_model->insert($data);
                                if($id)
                                {
                                        $data_user_request['id_request'] = $id;
                                        $data_user_request['id_user'] = $this->session->userdata['id'];
                                        $this->user_request_model->insert($data_user_request);
                                        if(!empty($_FILES['files']['name'])) $this->do_upload($id);
                                }
                                redirect('admin/requisicoes/editar/'.$id.'/1');
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
                                            ->set_title('CTP - Admin - Requisições - Adicionar')
                                            ->set_description('')
                                            ->set_keywords('')
                                            ->set_includes('js/requests.js')
                                            ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                            ->set_breadcrumbs('Requisições', 'admin/requisicoes/', 0)
                                            ->set_breadcrumbs('Adicionar', 'admin/requisicoes/', 1)
                                            ->set_view('admin/requests/add_requests', $data, 'template/admin/');
                        }
                    
                }
                else
                {
                        redirect('admin/usuarios/editar/'.$this->session->userdata['id']);
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->requests_model->get_item('ctp_requests.id = '.$codigo);
                        if($codigo && !empty($_FILES['files']['name']))
                        {
                                $this->do_upload($codigo);
                                redirect('admin/requisicoes/editar/'.$codigo.'/1');
                        }
                        else
                        {
                                $classe = strtolower(__CLASS__);
                                $function = strtolower(__FUNCTION__);
                                $data['classe'] = $classe;
                                $data['function'] = $function;
                                $data['action'] = base_url().'admin/'.$classe.'/'.$function.'/'.$codigo;
                                $data['item'] = $dados;
                                $data['ok'] = (isset($ok) && $ok) ? TRUE : FALSE;
                                $data['status'] = $this->get_status();
                                $data['type_business'] = $this->get_type_business();
                                $data['attachments'] = $this->attachment_model->get_itens('ctp_attachment.id_request = '.$codigo);
                                $data['request_support'] = $this->user_request_model->get_item('ctp_user_request.id_request = '.$codigo.' AND ctp_user_request.id_user = '.$this->session->userdata['id']);
                                $this->layout
                                        ->set_title('CTP - Admin - Requisições - Editar')
                                        ->set_description('')
                                        ->set_keywords('')
                                        ->set_includes('js/requests.js')
                                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                        ->set_breadcrumbs('Requisições', 'admin/requisicoes/', 0)
                                        ->set_breadcrumbs('Editar', 'admin/requisicoes/editar', 1)
                                        ->set_view('admin/requests/add_requests',$data , 'template/admin/');
                        }
                }
                else
                {
                        redirect('painel');
                }
        }
        
        public function remover()
        {
                $this->_is_autorized('admin/requisicoes/adicionar');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->requests_model->get_total_itens('ctp_requests.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->requests_model->update(array('active' => 0),'ctp_requests.id = '.$item);
                                if($deleted) $qtde++;
                        }
                }
                echo json_encode($qtde);
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
                            if($this->user_request_model->insert($data_user_request))
                            {
                                $qtde = $this->requests_model->get_quantity('ctp_requests.id = '.$support['request']);
                                $update = $this->requests_model->update(array('quantity' => ++$qtde), 'ctp_requests.id = '.$support['request'], 1);
                            }
                    }
            }
            echo json_encode($update);
        }
        
        public function download($id = '', $description = '')
        {
                if(empty($id) || empty($description)) exit();
                $file = $this->attachment_model->get_item('ctp_attachment.id_request = '.$id.' AND ctp_attachment.description = "'.$description.'"');
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary"); 
                header('Content-Disposition: attachment; filename="'.$file->description.'"');
                readfile($file->path);
                exit();
        }
        
        public function get_charts()
        {
                $charts['type_business'] = $this->requests_model->get_itens_by_type_business();
                $charts['neighborhood'] = $this->requests_model->get_itens_by_neighborhood();
                $charts['citys'] = $this->requests_model->get_itens_by_city();
                
                echo (empty($charts['type_business']) || empty($charts['neighborhood']) || empty($charts['citys'])) ? 0 : json_encode($charts);
        }
        
        public function get_status()
        {
                return $this->type_request_status_model->get_select(NULL, 'description', 'ASC');
        }
        
        public function get_type_business()
        {
                return $this->type_business_model->get_select('ctp_type_business.active = 1', 'description', 'ASC');
        }
        
        private function get_neighborhood()
        {
                return $this->users_model->get_neighborhood('ctp_users.id = '.$this->session->userdata['id']);
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
