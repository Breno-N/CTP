<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
        private $table = 'ctp_users'; 

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

        public function get_select($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id,';
                $data['fields'] .= $this->table.'.name as descricao';
                $data['tables'] =   array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }
        
        public function get_neighborhood($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields'] = 'ctp_address.id_neighborhood as id_neighborhood';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_address', 'where' => 'ctp_address.zip_code = '.$this->table.'.id_address', 'join' => 'INNER'),
                                        //array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = ctp_address.id_neighborhood', 'join' => 'INNER'),
                                        //array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhood.id_city', 'join' => 'INNER'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]->id_neighborhood) ? $return['itens'][0]->id_neighborhood : NULL) ;
        }

        public function get_item($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.*, 
                        ctp_type_users.description as type_user,
                        CONCAT(ctp_address.type_street, " ", ctp_address.street) as street,
                        ctp_neighborhoods.id as id_neighborhood,
                        ctp_neighborhoods.description as neighborhood,
                        ctp_citys.id_state as state,
                        ctp_citys.description as city,
                        ctp_attachment.path as photo,
                        ';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_type_users', 'where' => 'ctp_type_users.id = '.$this->table.'.id_type_user AND ctp_type_users.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_address', 'where' => 'ctp_address.zip_code = '.$this->table.'.id_address', 'join' => 'LEFT'),
                                        array('from' => 'ctp_neighborhoods', 'where' => 'ctp_neighborhoods.id = ctp_address.id_neighborhood', 'join' => 'LEFT'),
                                        array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhoods.id_city', 'join' => 'LEFT'),
                                        array('from' => 'ctp_attachment', 'where' => 'ctp_attachment.id_user_request = '.$this->table.'.id', 'join' => 'LEFT'),
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        public function get_itens($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields']  = $this->table.'.id as id, ';
                $data['fields'] .= $this->table.'.name as name, ';
                $data['fields'] .= $this->table.'.email as email, ';
                $data['fields'] .= $this->table.'.birthday as birthday, ';
                $data['fields'] .= $this->table.'.genre as genre, ';
                $data['fields'] .= $this->table.'.active as active, ';
                $data['fields'] .= $this->table.'.date_create as date_create, ';
                $data['fields'] .= $this->table.'.id_address as id_address, ';
                $data['fields'] .= 'ctp_type_users.description as type_user ';
                $data['tables'] =   array(
                                        array($this->table),
                                        array('from' => 'ctp_type_users', 'where' => 'ctp_type_users.id = '.$this->table.'.id_type_user AND ctp_type_users.active = 1', 'join' => 'INNER'),
                                        array('from' => 'ctp_address', 'where' => 'ctp_address.zip_code = '.$this->table.'.id_address', 'join' => 'INNER'),
                                        //array('from' => 'ctp_neighborhood', 'where' => 'ctp_neighborhood.id = ctp_address.id_neighborhood', 'join' => 'INNER'),
                                        //array('from' => 'ctp_citys', 'where' => 'ctp_citys.id = ctp_neighborhood.id_city', 'join' => 'INNER'),
                                    );
                $data['where'] = $where;
                $data['group'] = 'id';
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return;
        }

        public function get_total_itens($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.id as id ';
                $data['tables'] =   array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'][0];
        }

        public function get_password_by_email($where = array(), $column = 'ctp_users.id', $order = 'DESC')
        {
                $data['fields'] = $this->table.'.password as password ';
                $data['tables'] =   array(
                                        array($this->table)
                                    );
                $data['where']  = $where;
                $data['column'] = $column;
                $data['order'] = $order;
                $return = $this->get_itens_($data);
                return $return['qtde'];
        }
        
        public function is_valid_cpf($cpf = '')
        {
                if(isset($cpf) && !empty($cpf))
                {
                        $cpf = preg_replace('/[^0-9]/', '', $cpf);
                        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
                        if (strlen($cpf) != 11)
                        {
                                return FALSE;
                        }
                        else if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') 
                        {
                                return FALSE;
                        }
                        else
                        {   
                                for ($t = 9; $t < 11; $t++)
                                {
                                        for ($d = 0, $c = 0; $c < $t; $c++) { $d += $cpf{$c} * (($t + 1) - $c); }

                                        $d = ((10 * $d) % 11) % 10;

                                        if ($cpf{$c} != $d) return FALSE;
                                }
                                return TRUE;
                        }
                }
                else
                {
                        return TRUE;
                }
        }
}