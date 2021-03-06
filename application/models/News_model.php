<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends MY_Model
{
        private $table = 'ctp_news'; 

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
                $data['fields'] .= $this->table.'.title as descricao';
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
                                    ctp_type_news.description as category,
                                    ctp_users.name as user
                                ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_type_news', 'where' => 'ctp_type_news.id = '.$this->table.'.id_news_category', 'join' => 'INNER'),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $retorno = $this->get_itens_($data);
                return (isset($retorno['itens'][0]) ? $retorno['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'id', $order = 'DESC', $limit = NULL)
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.title as title, ';
                $data['fields'] .= $this->table.'.description as description, ';
                $data['fields'] .= $this->table.'.date_create as date_create, ';
                $data['fields'] .= 'ctp_type_news.description as category,
                                    ctp_users.name as user
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_type_news', 'where' => 'ctp_type_news.id = '.$this->table.'.id_news_category', 'join' => 'INNER'),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                if(isset($limit) && !empty($limit)) $data['limit'] = $limit;
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
                return $retorno['qtde'];
        }
}