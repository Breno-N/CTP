<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests_model extends MY_Model
{
        private $table = 'ctp_requests'; 

        public function __construct()
        {
                parent::__construct();
        }

        public function insert($data = array(), $debug =  FALSE)
        {
                $this->db->insert($this->table, $data);

                if($debug) echo $this->db->last_query();

                return $this->db->insert_id();
        }

        public function update($data = array(), $where = NULL, $debug =  FALSE)
        {
                $this->db->update($this->table, $data, $where);

                if($debug) echo $this->db->last_query();

                return $this->db->affected_rows();
        }

        public function remove($where = NULL, $debug =  FALSE)
        {
                $this->db->delete($this->table, $where);

                if($debug) echo $this->db->last_query();

                return $this->db->affected_rows();
        }

        public function get_select($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.description as descricao';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens']) ? $return['itens'] : array());
        }
        
        public function get_select_business($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id';
                //$data['fields'] .= $this->table.'.id_business as id_business,';
                //$data['fields'] .= $this->table.'.description as descricao';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = '.$this->table.'.id_business AND ctp_business.active = 1', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]->id) ? $return['itens'][0]->id : array());
        }
        
        public function get_itens_by_type_business($where = array(), $column = 'ctp_requests.quantity', $order = 'DESC')
        {
                $data['fields']  = 'SUM('.$this->table.'.quantity) as quantity, ';
                $data['fields'] .= 'ctp_business.description as type_business';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = '.$this->table.'.id_business', 'join' => 'INNER'),
                                    );
                $data['where'] = (isset($where) && $where) ? $where : 'ctp_requests.active = 1';
                $data['group'] = 'ctp_business.description';
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = 5;
                $return = $this->get_itens_($data);
                return (isset($return['itens']) ? $return['itens'] : array()) ;
        }
        
        public function get_itens_by_neighborhood($where = array(), $column = 'ctp_requests.quantity', $order = 'DESC')
        {
                $data['fields']  = 'SUM('.$this->table.'.quantity) as quantity, ';
                $data['fields'] .= 'ctp_neighborhoods.description as neighborhood';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhoods.id_city', 'join' => 'INNER'),
                                    );
                $data['where'] = (isset($where) && $where) ? $where : 'ctp_requests.active = 1';
                $data['group'] = 'ctp_citys.description, ctp_neighborhoods.description';
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = 4;
                $return = $this->get_itens_($data);
                return (isset($return['itens']) ? $return['itens'] : array()) ;
        }
        
        public function get_itens_by_city($where = array(), $column = 'ctp_requests.quantity', $order = 'DESC')
        {
                $data['fields']  = 'SUM('.$this->table.'.quantity) as quantity, ';
                $data['fields'] .= 'ctp_citys.description as city';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhoods.id_city', 'join' => 'INNER'),
                                        array('from' => 'ctp_states', 'where' => 'ctp_states.id = ctp_citys.id_state', 'join' => 'INNER'),
                                    );
                $data['where'] = (isset($where) && $where) ? $where : 'ctp_requests.active = 1';
                $data['group'] = 'ctp_states.description, ctp_citys.description';
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = 4;
                $return = $this->get_itens_($data);
                return (isset($return['itens']) ? $return['itens'] : array()) ;
        }
        
        public function get_itens_by_state($where = array(), $column = 'ctp_requests.quantity', $order = 'DESC')
        {
                $data['fields']  = 'SUM('.$this->table.'.quantity) as quantity, ';
                $data['fields'] .= 'ctp_states.description as state';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhoods.id_city', 'join' => 'INNER'),
                                        array('from' => 'ctp_states', 'where' => 'ctp_states.id = ctp_citys.id_state', 'join' => 'INNER'),
                                    );
                $data['where'] = (isset($where) && $where) ? $where : 'ctp_requests.active = 1';
                $data['group'] = 'ctp_states.description';
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = 4;
                $return = $this->get_itens_($data);
                return (isset($return['itens']) ? $return['itens'] : array()) ;
        }
        
        public function get_quantity($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.quantity';
                $data['tables'] =  array(
                                        array($this->table),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]->quantity) ? $return['itens'][0]->quantity : NULL) ;
        }

        public function get_item($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.*, 
                                    ctp_business.description as business,
                                    ctp_type_business.id as id_type_business,
                                    ctp_type_business.description as type_business,
                                    ctp_type_request_status.description as type_request_status
                                ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = '.$this->table.'.id_business', 'join' => 'INNER'),
                                        array('from' => 'ctp_type_business', 'where' => 'ctp_type_business.id = ctp_business.id_type_business', 'join' => 'INNER'),                    
                                        array('from' => 'ctp_type_request_status', 'where' => 'ctp_type_request_status.id = '.$this->table.'.id_type_request_status', 'join' => 'INNER'),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        //array('from' => 'ctp_address', 'where' => 'ctp_address.zip_code = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : array()) ;
        }

        public function get_itens($where = array(), $column = 'ctp_requests.id', $order = 'DESC', $offset = 0, $limit = 10)
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_business as id_business, ';
                $data['fields'] .= $this->table.'.have_business_neighborhood as have_business_neighborhood, ';
                $data['fields'] .= $this->table.'.request_public_agency as request_public_agency, ';
                $data['fields'] .= $this->table.'.id_neighborhood as id_neighborhood, ';
                $data['fields'] .= $this->table.'.description as description, ';
                $data['fields'] .= $this->table.'.quantity as quantity, ';
                $data['fields'] .= $this->table.'.date_create as date_create, ';
                $data['fields'] .= $this->table.'.date_opening as date_opening, ';
                $data['fields'] .= $this->table.'.active as active, ';
                $data['fields'] .= 'ctp_business.description as business,
                                    ctp_type_business.description as type_business,
                                    ctp_type_request_status.description as type_request_status
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = '.$this->table.'.id_business AND ctp_business.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_type_business', 'where' => 'ctp_type_business.id = ctp_business.id_type_business', 'join' => 'INNER'),                    
                                        array('from' => 'ctp_type_request_status', 'where' => 'ctp_type_request_status.id = '.$this->table.'.id_type_request_status', 'join' => 'INNER'),
                                        //array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        //array('from' => 'ctp_user_request', 'where' => 'ctp_user_request.id_request = '.$this->table.'.id', 'join' => 'INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                //$data['offset'] = $offset;
                //$data['limit'] = $limit;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = '.$this->table.'.id_business', 'join' => 'INNER'),
                                        array('from' => 'ctp_type_request_status', 'where' => 'ctp_type_request_status.id = '.$this->table.'.id_type_request_status', 'join' => 'INNER'),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        array('from' => 'ctp_user_request', 'where' => 'ctp_user_request.id_request = '.$this->table.'.id', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'][0];
        }
        
        public function get_total_requsts($where = array(), $column = 'ctp_requests.id', $order = 'DESC')
        {
                $data['fields'] = 'SUM('.$this->table.'.quantity) as quantity ';
                $data['tables'] =  array(
                                        array($this->table),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]->quantity) ? $return['itens'][0]->quantity : 0) ;
        }
        
        public function is_quantity_greater_than_1($quantity = '')
        {
                if(isset($quantity) && $quantity > 1)
                {
                        return (isset($_FILES['files']['name']) && !empty($_FILES['files']['name']) ? TRUE : FALSE);
                }
                else
                {
                        return TRUE;
                }
            
        }
}