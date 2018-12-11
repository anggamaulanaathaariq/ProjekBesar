<?php
session_start();

require 'functions.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['username'])){
    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];

    $result=mysqli_query($conn, "SELECT username FROM user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_POST["Login!"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $result=mysqli_query($conn, "SELECT *FROM users WHERE username='$username'");

    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"]=true;
            if(isset($_POST['remember'])){
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash(sha256, $row['username']), time()+60);
                setcookie('login','true',time()+60);
            }
            header("Location:index.php");
            exit;
        }
    }
    $error=true;
}
?> 
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Halaman Login</title>

        <!-- CSS -->
        <!-- Google font -->
	    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Owl Carousel -->
        <link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
        <link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

        <!-- Magnific Popup -->
        <link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon1.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>
    <body>
    <?php if (isset($error)):?>
    <p style = "color: white; font-style=bold">
    Username & Password Salah</p>
    <?php endif?>
    <!-- Header -->
	<header id="home">
    <form method="post" action="index.php">
    <nav id="nav" class="navbar nav-transparent">
			<div class="container">

				<div class="navbar-header">
                    <!-- Logo -->
					<div class="navbar-brand">
						<a href="index.php">
							<img class="logo" src="img/logo1.png" alt="logo">
							<img class="logo-alt" src="img/logo-alt1.jpg" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

                <div class="nav-collapse">
						<span></span>
                    </div>
                </div>
                    
                    <ul class="main-nav nav navbar-nav navbar-right">
                    <li class="active"><a href="login.php">Login</a></li>	
                    <li><a href="index.php">Home</a></li>
					<li><a href=>Plugins</a></li>
						<ul class="dropdown">
							<li><a href="blog-single.html">blog post</a></li>
						</ul>
					</li>
					<li><a href="signup.php">Sign-Up</a></li>
				</ul>
    
    </nav>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Halaman Login</strong></h1>
                            <div class="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                            		<p>Masukkan Username & Password Anda:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
                                    <ul class="main-nav nav navbar-nav navbar-left">
                                    <button type="submit" name="Login!" class="btn" href="index.php">Login!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
    
    </body>
</html>