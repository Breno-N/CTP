<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citys_model extends MY_Model
{
        private $table = 'ctp_citys'; 

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

        public function get_select($where = array(), $column = 'ctp_citys.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.description as descricao';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_states', 'where' => 'ctp_states.id = '.$this->table.'.id_state', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }

        public function get_item($where = array(), $column = 'ctp_citys.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.* ';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_states', 'where' => 'ctp_states.id = '.$this->table.'.id_state', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'ctp_citys.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.description as city, ';
                $data['fields'] .= 'ctp_states.description as state ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_states', 'where' => 'ctp_states.id = '.$this->table.'.id_state', 'join' => 'INNER'),
                                    );
                $data['where'] = $where;
                $data['group'] = 'ctp_citys.id';
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'ctp_citys.id', $order = 'DESC')
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