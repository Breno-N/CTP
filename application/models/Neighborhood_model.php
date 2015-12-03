<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Neighborhood_model extends MY_Model
{
        private $table = 'ctp_neighborhood'; 

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
        
        public function get_neighborhood_by_user($where = array(), $column = 'ctp_neighborhood.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_address', 'where' => 'ctp_address.id_neighborhood = '.$this->table.'.id', 'join' => 'INNER'),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id_address = ctp_address.id', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'][0]->id;
        }

        public function get_select($where = array(), $column = 'ctp_neighborhood.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.description as descricao';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city AND ctp_citys.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_state', 'where' => 'ctp_state.id = ctp_citys.id_state AND ctp_state.active = 1', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }

        public function get_item($where = array(), $column = 'ctp_neighborhood.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.*, ';
                $data['fields'] .= 'ctp_citys.id as id_city_selected, ';
                $data['fields'] .= 'ctp_state.id as id_state_selected ';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city AND ctp_citys.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_state', 'where' => 'ctp_state.id = ctp_citys.id_state AND ctp_state.active = 1', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'ctp_neighborhood.id', $order = 'DESC', $group = 'ctp_citys.id')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.description as description, ';
                $data['fields'] .= $this->table.'.active as active, ';
                $data['fields'] .= 'ctp_citys.description as city, ';
                $data['fields'] .= 'ctp_state.description as state ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city AND ctp_citys.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_state', 'where' => 'ctp_state.id = ctp_citys.id_state AND ctp_state.active = 1', 'join' => 'INNER'),
                                    );
                $data['where'] = $where;
                //$data['group'] = 'ctp_citys.id';
                $data['group'] = $group;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'ctp_neighborhood.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city AND ctp_citys.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_state', 'where' => 'ctp_state.id = ctp_citys.id_state AND ctp_state.active = 1', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'][0];
        }
}