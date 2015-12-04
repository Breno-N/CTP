<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends MY_Controller
{
        private $validate = array(
                                    array('field'=> 'id_news_category', 'label' => 'Categoria', 'rules' => 'required|trim'),
                                    array('field'=> 'title', 'label' => 'Titulo', 'rules' => 'required|trim'),
                                    array('field'=> 'description', 'label' => 'Descrição', 'rules' => 'required|trim'),
                                ); 

        public function __construct() 
        {
                parent::__construct();
                $this->load->model(array('news_model', 'type_news_model'));
        }
        
        public function index()
        {
                $this->listar();
        }
        
        public function listar()
        {
                $data['data_table'] = $this->_init_data_table();
                $data['action_adicionar'] = base_url().'admin/'.strtolower(__CLASS__).'/adicionar';
                $this->layout
                        ->set_title('CTP - Admin - Notícias')
                        ->set_description('')
                        ->set_keywords('')
                        ->set_includes('css/dataTables/dataTables.bootstrap.min.css')
                        ->set_includes('js/dataTables/jquery.dataTables.min.js')
                        ->set_includes('js/dataTables/dataTables.bootstrap.min.js')
                        ->set_includes('js/chart/Chart.js')
                        ->set_includes('js/data_table.js')
                        ->set_includes('js/news.js')
                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                        ->set_breadcrumbs('Notícias', 'admin/noticias/', 1)
                        ->set_view('admin/news/add_list', $data, 'template/admin/');
        }
        
        private function _init_data_table()
        {
                $data['itens'] = $this->news_model->get_itens('ctp_news.active = 1');
                $data['action_editar'] = base_url().'admin/'.strtolower(__CLASS__).'/editar/';
                $this->layout->set_html('admin/news/table', $data);
                return $this->layout->get_html();
        }
        
        public function adicionar()
        {
                $this->_is_autorized('admin/painel/');
                $this->form_validation->set_rules($this->validate); 
                $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                if($this->form_validation->run())
                {
                        $data = $this->_post();
                        $data['id_user'] = $this->session->userdata['id'];
                        $data['date_create'] = date('Y-m-d');
                        $data['active'] = (isset($data['active']) ? 1 : 0 );
                        $id = $this->news_model->insert($data);
                        redirect('admin/noticias/editar/'.$id.'/1');
                }
                else
                {
                        $classe = strtolower(__CLASS__);
                        $function = strtolower(__FUNCTION__);
                        $data['classe'] = $classe;
                        $data['function'] = $function;
                        $data['action'] = base_url().'admin/'.$classe.'/'.$function;
                        $data['news_categories'] = $this->_get_news_categories();
                        $this->layout
                                    ->set_title('CTP - Admin - Notícias - Adicionar')
                                    ->set_description('')
                                    ->set_keywords('')
                                    ->set_includes('js/neighborhood.js')
                                    ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                    ->set_breadcrumbs('Notícias', 'admin/noticias/', 0)
                                    ->set_breadcrumbs('Adicionar', 'admin/noticias/', 1)
                                    ->set_view('admin/news/add_news', $data, 'template/admin/');
                }
        }
        
        public function editar($codigo = '', $ok = FALSE)
        {
                $this->_is_autorized('admin/painel/');
                if(isset($codigo) && $codigo)
                {
                        $dados = $this->news_model->get_item('ctp_news.id = '.$codigo);
                        $this->form_validation->set_rules($this->validate); 
                        $this->form_validation->set_message('required','O campo "{field}" é obrigatório');
                        if($this->form_validation->run())
                        {
                                $data = $this->_post();
                                $data['active'] = (isset($data['active']) ? 1 : 0 );
                                $this->news_model->update($data, 'ctp_news.id = '.$codigo);
                                redirect('admin/noticias/editar/'.$codigo.'/1');
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
                                $data['news_categories'] = $this->_get_news_categories();
                                $this->layout
                                        ->set_title('CTP - Admin - Notícias - Editar')
                                        ->set_description('')
                                        ->set_keywords('')
                                        ->set_includes('js/news.js')
                                        ->set_breadcrumbs('Painel', 'admin/painel/', 0)
                                        ->set_breadcrumbs('Notícias', 'admin/noticias/', 0)
                                        ->set_breadcrumbs('Editar', 'admin/noticias/editar', 1)
                                        ->set_view('admin/news/add_news',$data , 'template/admin/');
                        }
                }
                else
                {
                        redirect('painel');
                }
        }
        
        public function remover()
        {
                $this->_is_autorized('admin/painel/');
                $itens = $this->_post();
                $qtde = 0;
                foreach($itens['selecteds'] as $item)
                {
                        $exists = $this->news_model->get_total_itens('ctp_news.id = '.$item);
                        if($exists)
                        {
                                $deleted = $this->news_model->update(array('active' => 0),'ctp_news.id = '.$item);
                                if($deleted) $qtde++;
                        }
                }
                echo json_encode($qtde);
        }
        
        private function _get_news_categories()
        {
                return $this->type_news_model->get_select();
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