<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

function build_dir($dir = '')
{
        if (!is_dir($dir) )
        {
                $temp = str_replace('\\', '/', $dir);
                $temp = explode('/', $temp);
                $path = $temp[0];
                $qtde = count($temp);
                $i = 0;
                while($i < $qtde)
                {
                        if(!is_dir($path)) {  mkdir($path, 0777); }
                        $i++;
                        if($i < $qtde){ $path .= '/'.$temp[$i]; }
                }
        }
}

function not_support_browser()
{
        $return = FALSE;
        
        preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);

        if(count($matches) < 2) preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);

        if (count($matches)>1)
        {
            $version = $matches[1];
            $return =  ($version <= 8) ? TRUE : FALSE;
        }
        return $return;
}

function is_same_request()
{
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method =='POST' )
        {
                $request = md5( implode($_POST) );
                $last_request = $_SESSION['last_request'];
                if(isset($last_request) && ($last_request == $request) )
                {
                        return TRUE;
                }
                else
                {
                        $_SESSION['last_request'] = $request;
                }
        }
}