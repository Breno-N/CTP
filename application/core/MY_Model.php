<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    
    /*
     * Função construtora que carrega e inicia a conexão com banco.
     * 
     * @author Breno Henrique Moreno Nunes
     */
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    /*
     * função que monta a pesquisa no banco de dados, retorna um array contendo dois elementos:
     * itens = os valores retornadaos da pesquisa no banco, e qtde = numero de registros retornados,
     * caso haja erro na validação retorna array vazio. Se debug for verdadeiro.
     * imprime a consulta na tela
     * 
     * @author Breno Henrique Moreno Nunes
     * @params Array data
     * @params boolean $debug
     * @return Array
     */
    public function get_itens_($data = array(), $debug = 0)
    {
        $retorno = array();
        if(isset($data) && $data)
        {
                if(isset($data['fields']) && $data['fields'])
                {
                        $this->db->select($data['fields'], FALSE);
                }
                else
                {
                        $this->db->select('*', FALSE);
                }
                if( isset($data['tables']) )
                {
                        $this->db->from($data['tables'][0]);
                        unset($data['tables'][0]);
                        if(is_array($data['tables']))
                        {
                                foreach ($data['tables'] as $tabela)
                                {
                                        $this->db->join($tabela['from'], $tabela['where'], ( isset($tabela['join']) && $tabela['join'] ) ? $tabela['join'] : 'LEFT' );
                                }
                        }
                }
                if( isset($data['where']) && !empty($data['where']) ) $this->db->where($data['where']);

                if( isset($data['group']) && !empty($data['group']) ) $this->db->group_by($data['group']); 

                if( isset($data['column']) && !empty($data['column']) ) $this->db->order_by($data['column'], $data['order']);  

                if( isset($data['limit']) && !empty($data['limit'])) $this->db->limit($data['limit'], (isset($data['offset']) ? $data['offset'] : 0));
                
                $query = $this->db->get();
                
                foreach ($query->result() as  $result)
                {
                        $retorno['itens'][] = $result;
                }
                $retorno['qtde'][] = $query->num_rows();
                
                if(isset($debug) && $debug) echo $this->db->last_query();
        }
        else
        {
                $retorno = NULL;
        }
        return $retorno;
    }
}
