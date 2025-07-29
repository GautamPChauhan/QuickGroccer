<?php
session_start();
include 'db.php';

$loginerr=$emailerr=$captchaerr="";
if(isset($_POST["login"])){

	$semail = ($_POST["email"]);
	
	$pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
	if (!preg_match($pattern, $semail)) {
		$emailerr = "Invalid email format";
	}
	else{
		$email=$semail;
	}

	$password=$_POST["password"];

	if(isset($email) && isset($password)){
		$query="select * from user where email='".$email."' ";
		$result=mysqli_query($conn,$query);

		if(mysqli_num_rows($result)>0){
			$record=mysqli_fetch_assoc($result);
			$enc_password=$record["password"];
			$_SESSION["user_id"]=$record["user_id"];
			$_SESSION["username"]=$record["username"];
			$_SESSION["role"]=$record["role"];
			
			
			$tmp_id=$record["user_id"];
			//echo $tmp_id;
			$query1="select * from shipping_address where user_id=$tmp_id ";
			$res1=mysqli_query($conn,$query1);
			$rec1=mysqli_fetch_assoc($res1);
			$city=$rec1["city"];
			$_SESSION["city"]=$city;
			//echo $city;
			//echo $_SESSION["user_id"];
			if(password_verify($password,$record["password"])){
				if($record["role"]=="Admin"){
					header("location:admin.php");
				}
				if($record["role"]=="customer"){
					header("location:customer_home.php");
				}
				if($record["role"]=="delivery"){
					header("location:delivery_home.php");
				}
			}
			else{
				$loginerr="Record not found , Please Register !";
			}
	}
	else{
		$loginerr="Record not found , Please Register !";
	}
}
}



?>


<html>
 <head>
<style>
	* {
	padding: 0;
	margin: 0;
}

html,body {
	width: 100%;
	height: 100%;
	display: flex;
	/*background-image: url(bg.jpg);*/
	background-color: #c7f9cc;
	background-size: cover;
	background-position: center;
	font-family: sans-serif;
}

::placeholder{
	font-weight: bold;
}

.container {
	display: flex;
	margin: auto;
	width: 800px;
	height: auto;
	box-shadow: 4px 4px 4px #014670;
}

.login {
	order: 1;
	width: 300px;
	background-color: #80ed99;
	text-align: center;
}

.header h1{
	margin-top: 50px;
	margin-bottom: 30px;
	color: #22577a;
	font-size: 35px;
}

.main input,button {
	width: 80%;
	height: 35px;
	margin-top: 25px;
	padding-left: 8px;
	box-sizing: border-box;
	outline: none;
	border:1px solid #014670;
	color: #014670;

}

.main button {
	padding: 0;
	font-size: 15px;
	background-color: white;
}

.main button:hover, input:hover {
	box-shadow: 3px 3px 3px rgba(1,70,112,.5);
}

.main a {
	display:inline;
	font-size: 13px; 
	text-align: right;
	/*margin-right:60px;;
	/*margin: 10px 32px;*/
	color: #22577a;
}
a:hover
{
	font-weight:bold ;
}
.signup
{	font-size:15px;
	margin-top:20px;
	color:black;
	margin-bottom:3px;
}

.img {
	display: flex;
	order: 2;
	flex-grow: 2;
	background-image: url(templogo.png);
	
	background-size: cover;
	background-position: center;
	text-align: center;
	color: #eee;
}

.img span {
	margin: auto;
}

.img span h1 {
	font-size: 50px;
	text-shadow: 0 0 10px #014670;
	
}

.img span p {
	font-size: 15px;
}

span{
	font-size: 15px;
	font-family: sans-serif;
	color:red;
	/* font-weight: bold; */
}


</style>
</head>

<body>
	
	<div class="container">
		<div class="login">
			<div class="header">
				<h1>Login</h1>
			</div>
			
			<div class="main">
				<form method="post">
					<input type="email" name="email" placeholder="E-mail" required=""><br>
					<span><?php echo $emailerr; ?></span>

					<br>
					<input type="password" name="password" placeholder="Password" required="">
					<br>
					<?php echo $loginerr; ?>
					<br>
					
					<button name="login">Login</button>
					<br>
					<div class="signup">Don't have an account? <a href="register.php">Signup now</a></div>
					
				</form>
			</div>
		</div>
		<div class="img">
			<span>
				<h1></h1>
				
			</span>
		</div>
	</div>
	

</body>

</html>

