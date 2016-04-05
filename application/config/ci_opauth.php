<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['opauth_config'] = array(
    'path' => '/ctp/acesso/do_login_social/',
    'callback_url' => '/ctp/acesso/validate_login_social/',
    'callback_transport' => 'post',
    'security_salt' => '47493435157039f35140d38.92478579',
    'debug' => false,
    'Strategy' => array(
        'Facebook' => array(
            'app_id' => 'app_id',
            'app_secret' => 'app_secret'
        ),
        'Google' => array(
            'client_id' => '903915271246-4eeu5qjr00eadhr9keorq3tfq3npv8p3.apps.googleusercontent.com',
            'client_secret' => 'VrGKatUMItrl9u5e8bD-Pn4-',
            'scope' => 'profile email'
        ),
        'LinkedIn' => array(
            'api_key' => 'YOUR API KEY',
            'secret_key' => 'YOUR SECRET KEY'
        )
    )
);
