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