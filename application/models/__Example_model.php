<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 
 * Classe a ser utilizada como exemplo para desenvolvimento de outros Models.
 * @author Breno Henrique Moreno Nunes
 */
class Example_model extends MY_Model
{
        private $table = 'nome_da_tabela'; 

        /**
         * 
         * Função construtora da classe utiliza como base o construtor da classe pai.
         * @author Breno Henrique Moreno Nunes
         */
        public function __construct()
        {
                parent::__construct();
        }

         /**
         * 
         * Função para adicionar os dados na tabela que leva o nome da classe,
         * ou seja da classe $table_model os dados serão adicionados em $table.
         * Recebe o array $dados para inserir no modelo $chave => $valor,
         * e retorna o id da ultima inserção.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $dados
         * @return string
         */
        public function adicionar($data = array(), $debug =  FALSE)
        {
                $this->db->insert($this->table, $data);

                if($debug) echo $this->db->last_query();

                return $this->db->insert_id();
        }

        /**
         * 
         * Função para editar os dados na tabela que leva o nome da classe,
         * ou seja da classe $table_model os dados serão editados em $table.
         * Recebe o array $dados para editar no modelo $chave => $valor,
         * o array ou string filtro para edição, 
         * e retorna o numero de linhas afetadas pela query.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $dados
         * @params array $where
         * @return string
         */
        public function editar($data = array(), $where = NULL, $debug =  FALSE)
        {
                $this->db->update($this->table, $data, $where);

                if($debug) echo $this->db->last_query();

                return $this->db->affected_rows();
        }


        /**
         * 
         * Função para deletar os dados na tabela que leva o nome da classe,
         * ou seja da classe $table_model os dados serão deletados em $table.
         * Recebe como parametro o array ou string filtro para deletar, 
         * e retorna o numero de linhas afetadas pela query.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $where
         * @return string
         */
        public function deletar($where = NULL, $debug =  FALSE)
        {
                $this->db->delete($this->table, $where);

                if($debug) echo $this->db->last_query();

                return $this->db->affected_rows();
        }

        /**
         * 
         * Função para pegar os dados na tabela que leva o nome da classe em formato id e descrição,
         * ou seja da classe $table_model e montar um select.
         * Recebe como parametro o array ou string filtro para consultar, 
         * e as strings coluna e ordem para ordenação do resultado.
         * Retorna array retorno['itens'] contendo os valores da pesquisa.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $where
         * @params string $column
         * @params string $order
         * @return array
         */
        public function get_select($where = array(), $column = 'DESC', $order = 'coluna')
        {
                $data['fields']  = $this->table.'.coluna as coluna,';
                $data['fields'] .= $this->table.'.coluna as coluna';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where'] = $where;
                $data['order'] = $order;
                $data['column'] = $column;
                $return = $this->get_itens_($data);
                return $return['itens'];
        }

        /**
         * 
         * Função para pegar os dados na tabela que leva o nome da classe de acordo com filtro informado.
         * Recebe como parametro o array ou string filtro para consultar, 
         * e as strings coluna e ordem para ordenação do resultado.
         * Retorna array retorno['itens'] contendo os valores da pesquisa.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $where
         * @params string $column
         * @params string $order
         * @return array
         */
        public function get_item($where = array(), $column = 'DESC', $order = 'coluna')
        {
                $data['fields']  = $this->table.'.* ';
                $data['tables'] =  array(
                                        array($this->table)
                                    );
                if(isset($where) && $where) $data['where']  = $where;
                $data['order'] = $order;
                $data['column'] = $column;
                $return = $this->get_itens_($data);
                return (isset($return['itens'][0]) ? $return['itens'][0] : NULL) ;
        }

        /**
         * 
         * Função para pegar todos os dados na tabela que leva o nome da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $where
         * @params string $column
         * @params string $order
         * @return array
         */
        public function get_itens($where = array(), $column = 'DESC', $order = 'coluna', $limit = 50)
        {
                $data['fields']  = $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna, ';
                $data['fields'] .= $this->table.'.coluna as coluna ';
                $data['tables'] =  array(
                                        array($this->table),
                                        array('nome' => 'nome_da_tabela', 'where' => $this->table.'.coluna = nome_da_tabela.coluna', 'tipo' => 'TIPO_INNER'),
                                        array('nome' => 'nome_da_tabela', 'where' => 'nome_da_tabela.coluna = nome_da_tabela.coluna', 'tipo' => 'TIPO_INNER')
                                    );
                $data['where'] = $where;
                $data['group'] = 'coluna';
                $data['order'] = $order;
                $data['column'] = $column;
                $data['limit'] = $limit;
                $return = $this->get_itens_($data);
                return $return;
        }

        /**
         * 
         * Função para pegar a quantidade de itens na tabela que leva o nome da classe.
         * 
         * @author Breno Henrique Moreno Nunes
         * @params array $where
         * @params string $column
         * @params string $order
         * @return array
         */
        public function get_total_itens($where = array(), $column = 'DESC', $order = 'coluna')
        {
            $data['fields'] = $this->table.'.coluna as coluna ';
            $data['tables'] =  array(
                                    array($this->table)
                                );
            if(isset($where) && $where) $data['where'] = $where;
            $data['order'] = $order;
            $data['column'] = $column;
            $return = $this->get_itens_($data);
            return $return['qtde'];
        }
}