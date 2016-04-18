<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['opauth_config'] = array(
        'path' => (strstr($_SERVER['HTTP_HOST'], 'localhost') ? '/ctp/acesso/social/' : '/acesso/social/'),
        'callback_url' => (strstr($_SERVER['HTTP_HOST'], 'localhost') ? '/ctp/acesso/auth_social/' : '/acesso/auth_social/'),
        'callback_transport' => 'post',
        'security_salt' => '$2a$08$MTY1MzE3NDMwNTU3MGI5MOIpr93AKWkNIp1uuqoqE5w5LKCBQ6BLO',
        'debug' => FALSE,
        'Strategy' => array(
            'Google' => array(
                'client_id' => '1033359941354-nkgqg6takbeja34cdcek4rcmj5efhhea.apps.googleusercontent.com',
                'client_secret' => '41b9wLLCqxlxsdhvCJaCJ_Cv'
                //'client_id' => '903915271246-4eeu5qjr00eadhr9keorq3tfq3npv8p3.apps.googleusercontent.com',
                //'client_secret' => 'VrGKatUMItrl9u5e8bD-Pn4-'
            ),
            'Facebook' => array(
                'app_id' => '505745622947328',
                'app_secret' => '8be0b03501bf5d148fe055c56c6fffe4',
                'scope' => 'public_profile, email'
            ),
            'LinkedIn' => array(
                'api_key' => '77oq1yrhmvgopz',
                'secret_key' => 'fH3fxOTSngqp1RQi'
            ),
        )
    );

/* End of file ci_opauth.php */
/* Location: ./application/config/ci_opauth.php */