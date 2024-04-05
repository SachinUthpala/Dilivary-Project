<?php
session_start();

?>



<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<title>East-Link Engineering</title>
	<link rel="stylesheet" type="text/css" href="./Assets/Css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--for sweet alert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>


</head>
<body>

<!-- 
	Sweet alert for wrong password
-->
<?php

if($_SESSION['userUnSet_e'] == 1){

	echo '
                <script>
                Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Wrong Email !",
				  });
                  </script>
                '
                ;
	$_SESSION['userUnSet_e'] = null;

}else if($_SESSION['userUnSet_p'] == 1){
	echo '
                <script>
                Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Wrong Password!",
				  });
                  </script>
                '
                ;
	$_SESSION['userUnSet_p'] = null;
}else if($_SESSION['logout'] == 1){

	echo '
                <script>
                Swal.fire({
                    title: "Logout Sucessfull!",
                    text: "You are sucessfully Loged out!",
                    icon: "success"
                  });
                  </script>
                '
                ;

	$_SESSION['logout'] = 0;
}

?>

	<img class="wave" src="./Assets/Img/wave.png">
	<div class="container">
		<div class="img">
			<img src="./Assets/Img/bg.svg">
		</div>
		<div class="login-content">
			<form action="./DatabaseActions/login.php" method="post">
				<img src="./Assets/Img/avatar.svg">
				<h2 class="title">Welcome To</h2>
                <h3>East - Link Delivery Arrangements</h3><br>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password" required>
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login" name="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="./Assets/Js/main.js"></script>

	<!--for sweet alert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>
</body>
</html>
