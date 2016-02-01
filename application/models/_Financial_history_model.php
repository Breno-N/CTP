<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financial_history_model extends MY_Model
{
        private $table = 'ctp_financial_history'; 

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
                $data['fields'] .= $this->table.'.billing_date as descricao';
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
                $data['fields'] = $this->table.'.* ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_financial', 'where' => 'ctp_financial.id_user = '.$this->table.'.id_financial', 'join' => 'INNER')
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
                $data['fields'] .= $this->table.'.billing_date as billing_date, ';
                $data['fields'] .= $this->table.'.its_paid as its_paid, ';
                $data['fields'] .= 'ctp_financial.payday as payday,
                                    ctp_financial.billing_email as billing_email,
                                    ctp_financial.billing_address as billing_address
                                ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_financial', 'where' => 'ctp_financial.id_user = '.$this->table.'.id_financial', 'join' => 'INNER')
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
                return $retorno['qtde'];
        }
}