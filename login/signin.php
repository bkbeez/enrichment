<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/app.php'); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/azure.class.php'); ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/azureinfo.class.php'); ?>
<?php
    define('APP_HOME', 'https://enrichment-program.edu.cmu.ac.th');
    $signin = new Azure();
    $signin->setCallbackUri(APP_HOME.'/login/signin.php');
    $signin->setScope('api://cmu/Mis.Account.Read.Me.Basicinfo api://cmu/Mis.Hr.Read.Me.Basicinfo api://cmu/Mis.Hr.Read.Me.Personalinfo');
    if( isset($_GET['error']) ){
        if (isset($_SESSION['login'])) { unset($_SESSION['login']); }
        if (isset($_SESSION['oauth2state'])) { unset($_SESSION['oauth2state']); }
        $_SESSION['loginmsg']['title'] = $_GET['error'];
        $_SESSION['loginmsg']['text'] = ( (isset($_GET['error_description'])&&$_GET['error_description']) ? $_GET['error_description'] : null );
        header('location: '.APP_HOME.'/deny.php');
        exit();
    }else if( !isset($_GET['code']) ){
        $_SESSION['oauth2state'] = $signin->setState();
        $signin->initAzure();
    }else if( empty($_GET['state'])||(isset($_SESSION['oauth2state'])&&$_GET['state']!==$_SESSION['oauth2state']) ){
        if (isset($_SESSION['login'])) { unset($_SESSION['login']); }
        if (isset($_SESSION['oauth2state'])) { unset($_SESSION['oauth2state']); }
        $_SESSION['loginmsg']['title'] = 'Invalid';
        $_SESSION['loginmsg']['text'] = 'Invalid State.';
        header('location: '.APP_HOME.'/deny.php');
        exit();
    }else{
        $code = $_GET['code'];
        $accessToken = $signin->getAccessTokenAuthCode($code);
        $azure = new Azureinfo();
        echo '<pre style="border:none!important;">';
        print_r($azure);
        echo '</pre>';
        $basic = $azure->getBasicinfo($accessToken->access_token);
        echo '<pre style="border:none!important;">';
        print_r($basic);
        echo '</pre>';
        $person = $azure->getPersonalinfo($accessToken->access_token);
        echo '<pre style="border:none!important;">';
        print_r($person);
        echo '</pre>';

        //header('location: '.APP_HOME);
        exit();
    }
?>