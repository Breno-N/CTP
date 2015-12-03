<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['per_page'] = 10;
$config['num_links'] = 5;
$config['page_query_string'] = TRUE;

$config['full_tag_open'] = '<div><ul class="pagination">';
$config['full_tag_close'] = '</ul></div><!--pagination-->';

$config['first_link'] = '&laquo; Primeiro';
$config['first_tag_open'] = '<li class="prev page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Último &raquo;';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Próximo &rarr;';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&larr; Anterior';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';