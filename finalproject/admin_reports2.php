<?php
include 'db.php';
session_start();

$query="select * from product";
$res=mysqli_query($conn,$query);

$sql="select * from user where role='customer' ";
$res1=mysqli_query($conn,$sql);

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
    </style>

<style>
        h2 {
            color: #333;
            text-align: center;
            margin:20px;
            margin-bottom:0px;
        }
        
        button{
            height:40px;
            width:200px;
            border-radius:5%;
            border: 1px solid #ddd;
            background-color:lightgreen;
        }
        #addcate{
            display:flex;
            width:100%;
            justify-content:center;
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
                <a href="admin_profile.php"><img src="profile1.png" alt="profile"></a>
            </div>
        </div>
    </header>

    <!-- Navigation Section -->
    <nav>
        <div class="container">
            <ul>
                <li><a href="admin.php" >Home</a></li>
                <!-- <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="admin_products.php">Products</a></li> -->
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_delivery_man_list.php">Delivery Man List</a></li>
                <li><a href="admin_reports.php" class="active">Reports</a></li>
            </ul>
        </div>
    </nav>

    </main>
    </div>
    <div id="link">
        <div class="link">
    <a href="admin_reports1.php">
    <button>Report 1</button>
    </a>
    </div>
    <div class="link">
    <a href="admin_reports2.php">
    <button>Report 2</button>
    </a>
    </div>
    </div>
    <h2>Report 2</h2>
    <div id="main">
        <div id="form">
    <form action="" method="post">
    <div id="details">
        Enter from date :<input type="date" name="from"><br><br>
        Enter to date :<input type="date" name="to"><br><br>
        Enter products:<select name="product">
            <?php
            while($rec=mysqli_fetch_assoc($res)){
            echo "<option>".$rec["product_name"]."</option>";
            }
            echo "<br>";
            ?>
            </select>
            <br>
            <br>
            Enter Customer:<select name="customer">
            <?php
            while($rec1=mysqli_fetch_assoc($res1)){
            echo "<option>".$rec1["username"]."</option>";
            }
            echo "<br>";
            ?>
            </select>
            </div>
            <div id="done">
        <input id="report" type="submit" name="submit" value="See Report">
        </div>
    </form>
    </div>
    </div>

    
</body>
</html>

<?php

if(isset($_POST["submit"])){
    $from_date=$_POST["from"];
    $to_date=$_POST["to"];
    $product=$_POST["product"];
    $username=$_POST["customer"];
    // echo $username;
    // echo $from_date;
    // echo $to_date;
    // echo $product;
    $query1="SELECT o.order_id,c.quantity,c.product_id 
    FROM orders o 
    inner join user u on o.customer_id=u.user_id 
    inner join cart c on u.user_id=c.cart_id 
    inner join product p on c.product_id=p.product_id 
    WHERE p.product_name='".$product."' && c.order_id=o.order_id && u.username='".$username."' && o.date_time BETWEEN '".$from_date."' AND '".$to_date."' ";
    $result=mysqli_query($conn,$query1);
    $total_quantity=0;
    while($record=mysqli_fetch_assoc($result)){
        // echo $record["quantity"];
        // echo $record["order_id"];
        // echo $record["product_id"];
        
        $total_quantity=$total_quantity+$record["quantity"];

    }
    echo $total_quantity." quantity of ".$product. " is brought by ".$username;
}

?>


