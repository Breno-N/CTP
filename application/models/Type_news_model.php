<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type_news_model extends MY_Model
{
        private $table = 'ctp_type_news'; 

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
                $retorno = $this->get_itens_($data);
                return $retorno['itens'];
        }

        public function get_item($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.*, 
                                    ctn.description as category_master,
                                ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_type_news as ctn', 'where' => 'ctn.id = '.$this->table.'.id_master', 'join' => 'LEFT')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['itens'][0]) ? $retorno['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_master as id_master, ';
                $data['fields'] .= $this->table.'.description as description, ';
                $data['fields'] .= $this->table.'.active as active, ';
                $data['fields'] .= 'ctn.description as category_master
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_type_news as ctn', 'where' => 'ctn.id = '.$this->table.'.id_master', 'join' => 'LEFT')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return $retorno;
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
                $retorno = $this->get_itens_($data);
                return $retorno['qtde'][0];
        }
}