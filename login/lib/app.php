<?php
    ob_start();
    session_start();
    define('APP_ROOT', $_SERVER["DOCUMENT_ROOT"]);
    define('APP_HOST', ((in_array($_SERVER["HTTP_HOST"], array('127.0.0.1','localhost','enrichment-program.edu.cmu')))?'http://':'https://').$_SERVER["HTTP_HOST"]);
    define('APP_HOME', APP_HOST);
    if( file_exists($_SERVER["DOCUMENT_ROOT"].'/login/lib/env/env.conf') ){
        $config = explode("\n", file_get_contents($_SERVER["DOCUMENT_ROOT"].'/login/lib/env/env.conf'));
        if( isset($config)&&count($config)>0 ){
            foreach($config as $env){
                if( $env ){
                    $envs = explode('=', $env);
                    define(trim($envs[0]), trim($envs[1]));
                }
            }
        }
    }
    function var_debug($datas, $is_exit=false){
        echo '<pre class=debug>';
        print_r($datas);
        echo '</pre>';
        if($is_exit) exit();
    }
    require_once(APP_ROOT.'/login/lib/database.php');
    require_once(APP_ROOT.'/login/lib/site.class.php');
    require_once(APP_ROOT.'/login/lib/student.class.php');
?>