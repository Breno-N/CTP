<?php

/*
* Função que realiza a limpeza dos dados que são passados por POST ou GET
* @author Breno Henrique Moreno Nunes
* 
* @params array $item
* @return array $retorno
*/
function sanitize($item = array())
{
        if(isset($item) && $item)
        {
                if(is_array($item) || is_object($item))
                {
                        foreach($item as $key => $value)
                        {
                                $item[$key] = sanitize($value);
                        }
                }
                else
                {
                        $item = strip_tags($item);
                        $item = addslashes($item);
                        $item = htmlspecialchars($item);
                        $item = preg_replace('/(from|FROM|select|SELECT|insert|INSERT|update|UPDATE|delete|DELETE|where|WHERE|truncate|TRUNCATE|alter table|ALTER TABLE|create table|CREATE TABLE|drop table|DROP TABLE|show tables|SHOW TABLES| or | OR |DATABASE|database| AND | and |JOIN|join|#|\*|\\\\)/', '', $item);
                        $item = trim($item);
                }
        }
        return $item;
}

/*
* Função que realiza curl na url informada por parametro
* @author Breno Henrique Moreno Nunes
* 
* @params string $url url em que será executada o curl
* @return array|boolean $retorno retorna um array de dados se der certo ou booleano se der errado
*/
function curl_executavel($url)
{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 12);
        $retorno = curl_exec($ch); 
        return $retorno;
}

/*
* Função que monta select html de acordo com valores passados por parametros
* @author Breno Henrique Moreno Nunes
* 
* @params array $itens array com itens do select
* @params string $selected valor do item selecionado se tiver
* @return string $retorno string contendo html montado
*/
function form_select($itens = array(), $selected = '')
{
        $retorno  = '<select name="'.$itens['nome'].'" id="'.$itens['nome'].'" '.$itens['extra'].'>';
        $retorno .= '<option value="">Selecione... </option>';
        if(isset($itens) && $itens)
        {
                foreach ($itens['itens'] as $item)
                {
                        $retorno .= '<option value="'.$item->id.'" '.(($item->id == $selected) ? 'selected="selected"' : '').'>'.$item->descricao.'</option>';
                }
        }
        $retorno .= '</select>';
        return $retorno;
}

function read_csv($file = '')
{
        $file = fopen(str_replace('\\', '/', getcwd()).'/uploads/cat3.csv', 'r');
        if ($file) 
        {
                // Ler cabecalho do arquivo
                //$cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
                //$cabecalho = fgetcsv($file, 0, ',');
                //$c = explode(';', $cabecalho[0]);

                // Enquanto nao terminar o arquivo
                while (!feof($file)) 
                {
                        // Ler uma linha do arquivo
                        $linha = fgetcsv($file, 0, ',');
                        
                        if (!$linha) continue;
                        
                        $l = explode(';', $linha[0]);
                        $r[] = '('.$l[0].', "'.iconv('ISO-8859-1', 'UTF-8', $l[1]).'")';
                }
                fclose($file);
                //$val = implode(',', $r);
                //$query = 'INSERT INTO ctp_business (id_type_business, description) VALUES '.$val;
                //var_dump($query).PHP_EOL;
        }
}