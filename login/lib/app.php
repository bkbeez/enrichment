<?php
    if( file_exists($_SERVER["DOCUMENT_ROOT"].'/login/lib/.env') ){
        $config = explode("\n", file_get_contents($_SERVER["DOCUMENT_ROOT"].'/login/lib/.env'));
        if( isset($config)&&count($config)>0 ){
            foreach($config as $env){
                if( $env ){
                    $envs = explode('=', $env);
                    define(trim($envs[0]), trim($envs[1]));
                }
            }
        }
    }
?>