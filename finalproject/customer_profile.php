<?php
require_once("db.php");
session_start();

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
    <title>quick grocer</title>
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
        }

        .profile img {
            height: 50px;
            width: auto;
            vertical-align: middle;
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

        /* Add this CSS to style the search box */
        .search {
            display: inline-block;
            margin-right: 20px;
        }

        .search input[type="text"] {
            padding: 8px;
            width: 200px;
        }

        .search .button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search .button:hover {
            background-color: #45a049;
        }

        /* Adjustments to existing styles */
        header {
            padding: 20px 0;
        }

        nav {
            padding: 20px 0;
        }

        nav ul {
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li:first-child {
            margin-left: 0;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        .cart {
            display: inline-block;
            margin-right: 20px;
        }

        .cart img {
            height: 50px;
            width: auto;
            vertical-align: middle;
        }

        .right{
            float:right;
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
        <span class="right">
        <div class="search">
            <form>
                <input type="text" name="search" placeholder="Search...">
                <input class="button" type="submit" name="submit" value="search">
            </form>
        </div>
        <div class="cart">
            <a href="customer_cart.php"><img src="cart.png" alt="Cart"></a>
        </div>
        
        <div class="profile">
            <a href="customer_profile.php"><img src="profile1.png" alt="profile"></a>
        </div>
    </span>
    </div>
</header>

<!-- Navigation Section -->
<nav>
    <div class="container">
        <ul>
            <li><a href="customer_home.php">Home</a></li>
            <li><a href="customer_products.php">Products</a></li>
            <li><a href="customer_orders_history.php">Orders History</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content Section -->
<main>
    
</main>

</body>
</html>
<?php
$user_id=$_SESSION["user_id"];
$query="select u.username,u.email,u.phone_number,s.address,s.city,s.state
        from user u
        inner join shipping_address s on u.user_id=s.user_id
        where u.user_id='".$user_id."' && s.address_name='home' ";
    $res=mysqli_query($conn,$query);
    $rec=mysqli_fetch_assoc($res)
// echo $rec["username"];

?>
<div id="main">
<div id="form">
<form>
UserName:<input type="text" readonly name="name" value="<?php echo $rec["username"]; ?>"><br><br>
E-mail:<input type="text" readonly name="name" value="<?php echo $rec["email"]; ?>"><br><br>
Phone Number:<input type="text" readonly name="name" value="<?php echo $rec["phone_number"]; ?>"><br><br>
Address:<input type="text" readonly name="name" value="<?php echo $rec["address"]; ?>"><br><br>
State:<input type="text" readonly name="name" value="<?php echo $rec["city"]; ?>"><br><br>
City:<input type="text" readonly name="name" value="<?php echo $rec["state"]; ?>"><br><br>

</form>
<div id="done">
<a href="customer_profile.php?task=logout">

<button id="report">Log-Out</button>
</div>
</a>
</div>
    </div>





