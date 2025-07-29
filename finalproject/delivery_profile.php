<?php
session_start();
include 'db.php';


?>
<?php
if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="logout"){
    header("location:login.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Grocer - Online Grocery Store</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container styles */
        .container {
            width: 90%;
            margin: 0 auto;
        }

        /* Header styles */
        header {
            background-color: lightgreen;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px;
            width: auto;
            vertical-align: middle;
        }

        .logo h1 {
            display: inline;
            font-size: 34px;
            font-weight: bold;
            color: #333;
            margin-left: 10px;
            vertical-align: middle;
        }

        .profile {
            display: inline-block;
            float: right;
        }

        .profile img {
            height: 50px;
            width: auto;
            vertical-align: middle;
        }

        /* Add this CSS to style the categories */
        .categories {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding:20px;
        }

        .category {
            flex-basis: 23%;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            border-radius:30px;
            background-color:lightgreen;
        }

        .category img {
            width: 100%;
            height: auto;
        }

        .category p {
            text-align: center;
            padding: 10px;
            font-weight: bold;
            color: black;
            font-size: large;
        }

        .category a{
            text-decoration: none;
        }
        .button a{
            text-decoration: none;
        }
        /* Navigation styles */
        nav {
            background-color: #333;
            padding: 20px 0;
        }

        nav ul {
            list-style-type: none;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 30px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: large;
        }

        nav ul li a.active {
            color: #ff9800;
        }

        nav ul li a:hover {
            color: #ff9800;
        }
        table{
            border:none;
            border-spacing:20px;
            background:#f2f2f2;
            width:100%;
            border-collapse:collapse;

        }
        th,td{
            border:none;
            padding:8px;
        }
        h3{
            margin:20px;
        }
        h1{
            margin:20px;
        }
        h2{
            margin:25px;
        }
        #table{
            display:flex;

            justify-content:center;
        }
        tr:nth-child(even)
        {
            background-color:white;
        }
        .tablebutton{
            border:none;
            background:#dcdcdc;
            height:35px;
            width:100px;
        }
        a{
            text-decoration:none;
            color:black;
        }
       
    </style>

<style>
        h2 {
            color: #333;
            text-align: center;
        }
        #main{
            
            width:100%;
            height:100%;
            display:flex;
        }
        #form{
            background:#f2f2f2;
            padding:40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            
            
        }
        input ,select{
            margin-left:20px;
            height:25px;
        }
        #report{
            margin:20px;
            margin-top:30px;
            margin-bottom:0px;
            width:100px;
            height:40px;
            position:relative;
            left:60px;
            border:none;
            background:white;
        }
        #report:hover{
           border:1px solid black;
        }         
        #main{
            display:flex;
            width:100%;
            justify-content:center;
            padding-top:70px;
        }
        #form{
            background:#f2f2f2;
            padding:40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            
            
        }
        input ,select{
            margin-left:20px;
            height:25px;
        }
        #report{
            margin:20px;
            margin-top:30px;
            margin-bottom:0px;
            width:100px;
            height:40px;
            position:relative;
            left:60px;
            border:none;
            background:white;
        }
        #report:hover{
           border:1px solid black;
        }
        #link{
            display:flex;
            flex-direction:row;
            width:100%;
            justify-content:center;
        }
        .link{
            margin:40px;
        }


    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="Quick Grocer.png" alt="Quick Grocer Logo">
                <h1>Quick Grocer</h1>
            </div>
            <div class="profile">
                <a href="delivery_profile.php"><img src="profile1.png" alt="profile"></a>
            </div>
        </div>
    </header>

    <!-- Navigation Section -->
    <nav>
        <div class="container">
            <ul>
                <li><a href="delivery_home.php" class="active">Home</a></li>
                <!-- <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="admin_products.php">Products</a></li> -->
                <li><a href="delivery_selected_orders.php">Selected Orders</a></li>
                <li><a href="delivery_delivered_orders.php">Delivered Orders</a></li>
            </ul>
        </div>
    </nav>

   
</body>
</html>
<?php

$user_id=$_SESSION["user_id"];

$query="select u.username,u.email,u.phone_number,s.address,s.city,s.state 
        from user u
        INNER JOIN shipping_address s on u.user_id=s.user_id
        where u.user_id='".$user_id."'  && s.address_name='home' ";
$res=mysqli_query($conn,$query);
$rec=mysqli_fetch_assoc($res);

// echo $rec["username"];


?>
<div id="main">
<div id="form">
<form>
UserName:<input type="text" readonly name="name" value="<?php echo $rec["username"]; ?>"><br><br>
E-mail:<input type="text" readonly name="name" value="<?php echo $rec["email"]; ?>"><br><br>
Phone Number:<input type="text" readonly  name="name" value="<?php echo $rec["phone_number"]; ?>"><br><br>
Address:<input type="text" readonly  name="name" value="<?php echo $rec["address"]; ?>"><br><br>
State:<input type="text" readonly  name="name" value="<?php echo $rec["city"]; ?>"><br><br>
City:<input type="text" readonly  name="name" value="<?php echo $rec["state"]; ?>"><br><br>

</form>
<div id="done">
<a href="delivery_profile.php?task=logout">
<button id="report">Log-Out</button>
</div>
</a>
</div>
    </div>



