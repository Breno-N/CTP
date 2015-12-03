<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_exclusivity_model extends MY_Model
{
        private $table = 'ctp_request_exclusivity'; 

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

        public function get_select($where = array(), $column = 'DESC', $order = 'id')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.date_create as descricao';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }

        public function get_item($where = array(), $column = 'DESC', $order = 'id')
        {
                $data['fields'] = $this->table.'.*, 
                                    ctp_users.name as name,
                                    ctp_users.email as email,
                                    ctp_type_business.description as type_business
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER'),
                                        array('from' => 'ctp_type_business', 'where' => 'ctp_type_business.id = '.$this->table.'.id_type_business', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'DESC', $order = 'id')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_user as id_user, ';
                $data['fields'] .= $this->table.'.id_type_business as id_type_business, ';
                $data['fields'] .= $this->table.'.date_create as date_create, ';
                $data['fields'] .= 'ctp_users.name as name,
                                    ctp_users.email as email,
                                    ctp_type_business.description as type_business
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('nome' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'tipo' => 'INNER'),
                                        array('nome' => 'ctp_type_business', 'where' => 'ctp_type_business.id = '.$this->table.'.id_type_business', 'tipo' => 'INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'DESC', $order = 'id')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'];
        }
}