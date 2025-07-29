<?php
session_start();
include 'db.php';


$nameerr=$emailerr=$phonenumbererr=$roleerr=" ";

if(isset($_POST["register"])){

	// if (empty($_POST["name"])) {
	// 	$nameerr = "Name is required";
	// }else {
		
		if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
		  $nameerr = "Only letters and white space allowed";
		}
		else{
			$name=$_POST["name"];
		
		}
	// }

	// if (empty($_POST["email"])) {
	// 	$emailerr = "Email is required";
	// }else {
		$semail = ($_POST["email"]);
	
		$pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
		if (!preg_match($pattern, $semail)) {
			$emailerr = "Invalid email format";
		}
		else{
			$email=$semail;
		}
	// }

	// if(empty($_POST["phonenumber"])){
	// 	$phonenumbererr="phone number is required";
	// }
	// else{

		if (!preg_match("/^[0-9]*$/",$_POST["phonenumber"])) {
			$phonenumbererr= "characters are not allowed";
		  }
		  else{
			  $phonenumber=$_POST["phonenumber"];
			}
	// }

		$address=$_POST["address"];
		$city=$_POST["city"];
		$state=$_POST["state"];
		$password=$_POST["password"];
		$enc_password=password_hash($_POST["password"],PASSWORD_DEFAULT);
		//echo $enc_password;
		$role=$_POST["role"];
		
		if(isset($name) && isset($email) && isset($phonenumber)){
			$query="insert into user(username,email,password,phone_number,role)
					values('".$name."','".$email."','".$enc_password."','".$phonenumber."','".$role."')";
			mysqli_query($conn,$query);

			$query1="select * from user where email='".$email."' ";
			$res=mysqli_query($conn,$query1);
			$rec=mysqli_fetch_assoc($res);
			$uid=$rec["user_id"];
			$username=$rec["username"];

			$_SESSION["user_id"]=$uid;
			$_SESSION["username"] =$username;

			$query2="insert into shipping_address(user_id,address,city,state,address_name)
					values('".$uid."','".$address."','".$city."','".$state."','home')";
			mysqli_query($conn,$query2);
			header("location:login.php");
		}
}	

// $2y$10$Cfv7voUeg7TeT/C0QAUu0ufQPt3Lj039dy9k5syq7RJrd1Cszgxpm
// $2y$10$GF.W800P1YhsrIEduyMc8uch.7hwF.raH9PdmBDJKke0eBukjmeUW


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
	margin-top: 30px;
	margin-bottom: 10px;
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
label{
	color: #014670;
	/* font-weight: ; */
	
}

#role
{	margin-top:5px;
	display: flex;
	flex-direction: column;
}

#radio{
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-items: center;
}
#radio input{
	height: 20px;
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
	margin-bottom: 4px;
	color:black;
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
				<h1>Sign up</h1>
			</div>
			<div class="main">
				<form method="post">
					
					<input type="text"  name="name" placeholder="Enter UserName" required=""><br>
                    <span class="required"><?php echo $nameerr; ?></span>

					<br>
					<input type="email" name="email" placeholder="Enter Email" required=""><br>
					<span class="required"><?php echo $emailerr; ?></span>

					<br>
					<input type="text" name="phonenumber" placeholder="Enter phone number" required=""><br>
					<span class="required"><?php echo $phonenumbererr; ?></span>

					<br>
					<input type="text" name="address" placeholder="Enter Address" required=""><br>
					<br>
					<input type="text" name="city" placeholder="Enter city" required=""><br>
					<br>
					<input type="text" name="state" placeholder="Enter state" required=""><br>
					<br>
					<input type="password" name="password" placeholder="Create Password" required=""><br>
					<br>
					<div id="role">
					<div>
						<label>Role :</label>
					</div>
					<div id="radio">
						<div id="cust">
					<input type="radio" name="role"  id="cust" value="customer">
					<label for="cust">Customer</label></div>
					<div id="deli">
					<input type="radio" name="role"  id="deli" value="delivery">
					<label for="deli">Delivery man</label></div>
					<span class="required"><?php echo $roleerr; ?></span>

					</div>
					

				</div>
					<button name="register">Create an account</button>
					<br>
					<div class="signup">Already have an account? <a href="login.php">Login now</a></div>	
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
