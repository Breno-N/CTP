<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends MY_Model
{
        private $table = 'ctp_address'; 

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

        public function get_select($where = array(), $column = 'ctp_address.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.street as descricao';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno['itens'];
        }

        public function get_item($where = array(), $column = 'ctp_address.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.*, 
                                    ctp_neighborhood.description as neighborhood
                                ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhood', 'where' => 'ctp_neighborhood.id = '.$this->table.'.id_neighborhood AND ctp_neighborhood.active = 1', 'join' => 'INNER')
                                        //array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['itens'][0]) ? $retorno['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'ctp_address.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.street as street, ';
                $data['fields'] .= $this->table.'.neighborhood as neighborhood, ';
                $data['fields'] .= $this->table.'.number as number, ';
                $data['fields'] .= $this->table.'.complement as complement, ';
                $data['fields'] .= 'ctp_neighborhood.description as neighborhood
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhood', 'where' => 'ctp_neighborhood.id = '.$this->table.'.id_neighborhood AND ctp_neighborhood.active = 1', 'join' => 'INNER')
                                        //array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city', 'join' => 'INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno;
        }

        public function get_total_itens($where = array(), $column = 'ctp_address.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhood', 'where' => 'ctp_neighborhood.id = '.$this->table.'.id_neighborhood AND ctp_neighborhood.active = 1', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno['qtde'];
        }
}