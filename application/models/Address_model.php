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

        public function get_select($where = array(), $column = 'ctp_address.zip_code', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.zip_code as id,';
                $data['fields'] .= 'CONCAT( '.$this->table.'type_stret," ",'.$this->table.'.street, " ",'.$this->table.'.complement) as descricao';
                $data['tables'] =   array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno['itens'];
        }
        
        public function get_neighborhood_by_address($where = array())
        {
                $data['fields']  = $this->table.'.id_neighborhood as id_neighborhood '; 
                $data['tables'] =   array(
                                        array($this->table),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['itens'][0]->id_neighborhood) ? $retorno['itens'][0]->id_neighborhood : NULL) ;
        }

        public function get_item($where = array(), $column = 'ctp_address.zip_code', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.zip_code as zip_code, '; 
                $data['fields'] .= 'CONCAT('.$this->table.'.type_street, " ", '.$this->table.'.street) as street, 
                                   ctp_neighborhoods.description as neighborhood,
                                   ctp_citys.description as city,
                                   ctp_citys.id_state as state,
                                ';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER'),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = 1;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['itens'][0]) ? $retorno['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'ctp_address.zip_code', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.zip_code as zip_code, ';
                $data['fields'] .= $this->table.'.street as street, ';
                $data['fields'] .= $this->table.'.neighborhood as neighborhood, ';
                $data['fields'] .= $this->table.'.complement as complement, ';
                $data['fields'] .= 'ctp_neighborhoods.description as neighborhood
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER')
                                        //array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = '.$this->table.'.id_city', 'join' => 'INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno;
        }

        public function get_total_itens($where = array(), $column = 'ctp_address.zip_code', $order = 'DESC', $limit = NULL)
        {
                $data['fields'] = $this->table.'.zip_code as id ';
                $data['tables'] =  array(
                                        array($this->table),
                                        //array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = '.$this->table.'.id_neighborhood', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $data['limit'] = $limit;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['qtde'][0]) ? $retorno['qtde'][0] : 0 );
        }
}