<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./app/fbapp/fb.js"></script>
    <style>

        .LoginForm{
            border:none;
            margin-top:-7px;
        }
        textarea{
            height:120px;
        }

        form{
            padding-bottom:20px;
        }
        .loginpage{
            background-image: url("images/gyanrootslogin1.jpg");
            width:100%;
            height:800px;
            background-size: cover;
            padding-right:50px;
            padding-top :200px;
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            color:#fff;
        }
    </style>

    <script type="text/javascript">
        $('.loginpage').css("height",$(window).height());
        $('.loginpage').css("width",$(window).width());
    </script>
</head>


<body>
<div class="container loginpage">
    <div class="row">
        <div class="pull-left col-xs-offset-4">
            <h3><span style="font-weight: bold;font-size: 1.15em;padding-left:40px;">Software learning made easy !</span></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="row">
        <span class="LoginForm">
                <div class="pull-left col-xs-offset-6">
                  <div class="fb-login-button" size="xlarge" data-scope="public_profile,email" onlogin="checkLoginState();"></div>
                </div>
        </span>
        </div>
    </div>
</div>

</body>
</html>
