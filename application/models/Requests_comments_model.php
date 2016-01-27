<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests_comments_model extends MY_Model
{
        private $table = 'ctp_requests_comments'; 

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

        public function get_select($where = array(), $column = 'id', $order = 'DESC')
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
                return (isset($return['itens']) ? $return['itens'] : array() );
        }
        
        public function get_item($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.* ';
                $data['tables'] =  array(
                                        array($this->table),
                                        //array('from' => 'ctp_type_business', 'where' => 'ctp_type_business.id = '.$this->table.'.id_type_business', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'id', $order = 'DESC', $limit = 5)
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_user as id_user, ';
                $data['fields'] .= $this->table.'.id_request as id_request, ';
                $data['fields'] .= $this->table.'.description as description,';
                $data['fields'] .= 'DATE_FORMAT('.$this->table.'.date, "%d/%m/%Y") as date,';
                $data['fields'] .= $this->table.'.active as active,
                                    ctp_users.name as name';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER'),
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = $limit;
                $return = $this->get_itens_($data);
                return $return;
        }
        
        public function get_itens_by_request($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_request as id_request, ';
                $data['fields'] .= $this->table.'.description as description,';
                $data['fields'] .= 'ctp_users.name as user,
                                    ctp_business.description as business,
                                    ctp_type_business.description as type_business,
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER'),
                                        array('from' => 'ctp_requests', 'where' => 'ctp_requests.id = '.$this->table.'.id_request', 'join' => 'INNER'),
                                        array('from' => 'ctp_business', 'where' => 'ctp_business.id = ctp_requests.id_business', 'join' => 'INNER'),
                                        array('from' => 'ctp_type_business', 'where' => 'ctp_type_business.id = ctp_business.id_type_business', 'join' => 'INNER'),
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'][0];
        }
}