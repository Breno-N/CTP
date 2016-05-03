<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_request_model extends MY_Model
{
        private $table = 'ctp_user_request'; 

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
                $data['fields'] .= $this->table.'.id_request as descricao';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }

        public function get_item($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.* ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER'),
                                        array('from' => 'ctp_requests', 'where' => 'ctp_requests.id = '.$this->table.'.id_request', 'join' => 'INNER')
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.id_user as id_user, ';
                $data['fields'] .= $this->table.'.id_request as id_request, ';
                $data['fields'] .= 'ctp_users.name as name,
                                    ctp_users.email as email
                                    ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('from' => 'ctp_users', 'where' => 'ctp_users.id = '.$this->table.'.id_user', 'join' => 'INNER'),
                                        array('from' => 'ctp_requests', 'where' => 'ctp_requests.id = '.$this->table.'.id_request', 'join' => 'INNER')
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
                return $return['qtde'];
        }
        
        public function user_already_support_request($user = '', $request = '')
        {
                $qtde = $this->get_total_itens('ctp_user_request.id_user = '.$user.' AND ctp_user_request.id_request = '.$request);
                
                return ($qtde[0]) ? TRUE : FALSE;
        }
}