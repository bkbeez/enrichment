<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/app.php'); ?><?php ob_start(); ?>
<?php
    $title = ((isset($_SESSION['loginmsg'])&&isset($_SESSION['loginmsg']['title'])&&$_SESSION['loginmsg']['title'])?$_SESSION['loginmsg']['title']:"Oops !!!");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
        <title><?=$title?></title>
        <link rel="icon" type="image/png" href="favicon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
        <link rel="icon shortcut" type="image/ico" href="favicon.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="favicon.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="favicon.png">
        <link rel="apple-touch-icon-precomposed" href="favicon.png" />
        <style type="text/css">
            * {
                margin:0px auto;
                padding: 0px;
                text-align:center;
            }
            body {
                background-color: #D4D9ED;
            }
            .cont_principal {
                position: absolute;  
                width: 100%;
                height: 100%;
                overflow: hidden;
            }
            .cont_error {
                position: absolute;
                width: 100%;
                height: 300px;
                top: 50%;
                margin-top:-150px;
            }
            .cont_error > h1  {
                color: red;
                font-family: 'Lato', sans-serif;  
                font-weight: 400;
                font-size: 72px;
                position: relative;
                left:-100%;
                transition: all 0.5s;
            }
            .cont_error > p  {
                font-family: 'Lato', sans-serif;  
                font-weight: 300;
                font-size:20px;
                letter-spacing: 5px;
                color:#9294AE;
                position: relative;
                left:100%;
                transition: all 0.5s;
                transition-delay: 0.5s;
                -webkit-transition: all 0.5s;
                -webkit-transition-delay: 0.5s;
            }
            .cont_aura_1 {
                position:absolute;
                width:300px;
                height: 120%;
                top:25px;
                right: -340px;
                background-color: #8A65DF;
                box-shadow: 0px 0px  60px  20px  rgba(137,100,222,0.5);
                -webkit-transition: all 0.5s;
                transition: all 0.5s;
            }
            .cont_aura_2 {
                position:absolute;
                width:100%;
                height: 300px;
                right:-10%;
                bottom:-301px;
                background-color: #8B65E4;
                box-shadow: 0px 0px 60px 10px rgba(131, 95, 214, 0.5),0px 0px  20px  0px  rgba(0,0,0,0.1);
                z-index:5;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;
            }
            .cont_error_active > .cont_error > h1 {
                left:0%;
            }
            .cont_error_active > .cont_error > p {
                left:0%;
            }
            .cont_error_active > .cont_aura_2 {
                animation-name: animation_error_2;
                animation-duration: 4s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
                animation-direction: alternate;
                transform: rotate(-20deg);    
            }
            .cont_error_active > .cont_aura_1 {
                transform: rotate(20deg);
                right:-170px;
                animation-name: animation_error_1;
                animation-duration: 4s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
                animation-direction: alternate;
            }
            @-webkit-keyframes animation_error_1 {
                from {
                    -webkit-transform: rotate(20deg);
                    transform: rotate(20deg);
                }
                to {
                    -webkit-transform: rotate(25deg);
                    transform: rotate(25deg);
                }
            }
            @-o-keyframes animation_error_1 {
                from {
                    -webkit-transform: rotate(20deg);
                    transform: rotate(20deg);
                }
                to { 
                    -webkit-transform: rotate(25deg);
                    transform: rotate(25deg);
                }
            }
            @-moz-keyframes animation_error_1 {
                from {
                    -webkit-transform: rotate(20deg);
                    transform: rotate(20deg);
                }
                to { 
                    -webkit-transform: rotate(25deg);
                    transform: rotate(25deg);
                }
            }
            @keyframes animation_error_1 {
                from {
                    -webkit-transform: rotate(20deg);
                    transform: rotate(20deg);
                }
                to {
                    -webkit-transform: rotate(25deg);
                    transform: rotate(25deg);
                }
            }
            @-webkit-keyframes animation_error_2 {
                from {
                    -webkit-transform: rotate(-15deg); 
                    transform: rotate(-15deg);
                }
                to {
                    -webkit-transform: rotate(-20deg);
                    transform: rotate(-20deg);
                }
            }
            @-o-keyframes animation_error_2 {
                from {
                    -webkit-transform: rotate(-15deg); 
                    transform: rotate(-15deg);
                }
                to {
                    -webkit-transform: rotate(-20deg);
                    transform: rotate(-20deg);
                }
            }
            @-moz-keyframes animation_error_2 {
                from { -webkit-transform: rotate(-15deg); 
                transform: rotate(-15deg);
                }
                to { -webkit-transform: rotate(-20deg);
                transform: rotate(-20deg);
                }
            }
            @keyframes animation_error_2 {
                from {
                    -webkit-transform: rotate(-15deg); 
                    transform: rotate(-15deg);
                }
                to {
                    -webkit-transform: rotate(-20deg);
                    transform: rotate(-20deg);
                }
            }
            button.back {
                padding: 17px 40px;
                border-radius: 10px;
                border: 0;
                background-color: rgb(255, 56, 86);
                letter-spacing: 1.5px;
                font-size: 15px;
                transition: all 0.3s ease;
                box-shadow: rgb(201, 46, 70) 0px 10px 0px 0px;
                color: hsl(0, 0%, 100%);
                cursor: pointer;
            }
            button.back:hover {
                box-shadow: rgb(201, 46, 70) 0px 7px 0px 0px;
            }

            button.back:active {
                background-color: rgb(255, 56, 86);
                /*50, 168, 80*/
                box-shadow: rgb(201, 46, 70) 0px 0px 0px 0px;
                transform: translateY(5px);
                transition: 200ms;
            }
        </style>
    </head>   
    <body>
        <div class="cont_principal">
            <div class="cont_error">
                <h1><?=$title?></h1>  
                <p><?=((isset($_SESSION['loginmsg'])&&isset($_SESSION['loginmsg']['text'])&&$_SESSION['loginmsg']['text'])?$_SESSION['loginmsg']['text']:"The Page you're looking for isn't here.")?></p>
                <br>
                <button type="button" class="back" onclick="document.location='<?=APP_HOME?>';">Back to Home</button>
            </div>
            <div class="cont_aura_1"></div>
            <div class="cont_aura_2"></div>
        </div>
    </body>
    <script>
        window.onload = function(){
            document.querySelector('.cont_principal').className= "cont_principal cont_error_active";  
        }
    </script>
</html>