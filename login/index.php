<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
        <title>Login</title>
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
                background: url('https://enrichment-program.edu.cmu.ac.th/assets/img/edcmu/head_index1.jpg') top center no-repeat;
                background-size: cover;
            }
            .widget {
                position: absolute;  
                width: 100%;
                height: 100%;
                overflow: hidden;
            }
            .widget-login {
                bottom: 5%;
                width: 100%;
                z-index: 10;
                position: fixed;
            }
            .widget-login > h1  {
                color: red;
                font-family: 'Lato', sans-serif;  
                font-weight: 400;
                font-size:150px;
                position: relative;
                left:-100%;
                transition: all 0.5s;
            }
            .widget-login > p {
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
            .widget-login > p > span {
                padding: 6px 12px;
                background: white;
                border-radius: 5px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
            }
            .widget-aura-1 {
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
            .widget-aura-2 {
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
            .widget-login_active > .widget-login > h1 {
                left:0%;
            }
            .widget-login_active > .widget-login > p {
                left:0%;
            }
            .widget-login_active > .widget-aura-2 {
                animation-name: animation_error_2;
                animation-duration: 4s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
                animation-direction: alternate;
                transform: rotate(-20deg);    
            }
            .widget-login_active > .widget-aura-1 {
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
            .pushable {
              position: relative;
              background: transparent;
              padding: 0px;
              border: none;
              cursor: pointer;
              outline-offset: 4px;
              outline-color: deeppink;
              transition: filter 250ms;
              margin-bottom: 5px;
              -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
            .shadow {
              position: absolute;
              top: 0;
              left: 0;
              height: 100%;
              width: 100%;
              background: hsl(226, 25%, 69%);
              border-radius: 8px;
              filter: blur(2px);
              will-change: transform;
              transform: translateY(2px);
              transition: transform 600ms cubic-bezier(0.3, 0.7, 0.4, 1);
            }
            .edge {
              position: absolute;
              top: 0;
              left: 0;
              height: 100%;
              width: 100%;
              border-radius: 8px;
              background: linear-gradient(
                to right,
                hsl(248, 39%, 39%) 0%,
                hsl(248, 39%, 49%) 8%,
                hsl(248, 39%, 39%) 92%,
                hsl(248, 39%, 29%) 100%
              );
            }
            .front {
              display: block;
              position: relative;
              border-radius: 8px;
              background: hsl(248, 53%, 58%);
              padding: 16px 32px;
              color: white;
              font-weight: 600;
              text-transform: uppercase;
              letter-spacing: 1.5px;
              font-size: 1rem;
              transform: translateY(-4px);
              transition: transform 600ms cubic-bezier(0.3, 0.7, 0.4, 1);
            }
            .pushable:hover {
              filter: brightness(110%);
            }
            .pushable:hover .front {
              transform: translateY(-6px);
              transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
            }
            .pushable:active .front {
              transform: translateY(-2px);
              transition: transform 34ms;
            }
            .pushable:hover .shadow {
              transform: translateY(4px);
              transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
            }
            .pushable:active .shadow {
              transform: translateY(1px);
              transition: transform 34ms;
            }
            .pushable:focus:not(:focus-visible) {
              outline: none;
            }
            @media only all and (max-width: 520px){
                .widget-login > p {
                    font-size:3vw;
                    line-height:13vw;
                }
            }
            @media only all and (max-width: 320px){
                .widget-login > p {
                    display: block;
                    overflow:hidden;
                    white-space:nowrap;
                    text-overflow:ellipsis;
                }
            }
        </style>
    </head>   
    <body>
        <div class="widget">
            <div class="widget-login">
                <div>
                    <button class="pushable">
                        <span class="shadow"></span>
                        <span class="edge"></span>
                        <span class="front">SIGN IN WITH CMU ACCOUNT</span>
                    </button>
                </div>  
                <p><span>โปรดเข้าสู่ระบบก่อนเข้าร่วมกิจกรรม</span></p>
            </div>
            <div class="widget-aura-1"></div>
            <div class="widget-aura-2"></div>
        </div>
    </body>
    <script>
        window.onload = function(){
            document.querySelector('.widget').className= "widget widget-login_active";  
        }
    </script>
</html>