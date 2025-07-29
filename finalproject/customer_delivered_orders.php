<?php
session_start();
require_once("db.php");

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

        img .c{
            width:10px;
        }
    </style>

    <style>
        h2 {
            color: #333;
            text-align: center;
        }

        .categories {
            font-family: Arial, sans-serif;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .category {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            transition: transform 0.2s;
        }

        .category a {
            display: block;
            padding: 20px;
            color: #333;
            text-decoration: none;
        }

        .category img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .category span {
            display: block;
            margin-top: 10px;
        }

        .category:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        /* css for order history table */
        table {
    border-collapse: collapse;
    width: 400px;
    margin: 20px 0;
}

table, th, td {
    border: 2px solid black;

}

th, td {
    padding: 8px;
    text-align: left;
    vertical-align: middle;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

td img {
    max-width: 100px;
    height: auto;
    display: block;
}

.cart img {
            height: 50px;
            width: auto;
            vertical-align: middle;
        }

        .right{
            float:right;
        }
    </style>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.cart-item {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 20px auto; 
    padding: 20px;
    max-width: 600px; 
    display: flex;
    align-items: center;
}

.cart-item img {
    width: 100px; /* Fixed width for the image */
    height: auto; /* Auto height to maintain aspect ratio */
    margin-right: 20px; /* Margin between image and text */
    border-radius: 4px; /* Slightly rounded corners for the image */
}

.cart-item h3 {
    margin: 0;
    color: #333;
    flex-grow: 1;
}

.cart-item p {
    margin: 5px 10px;
    color: #666;
}
h4{
    color:red;  
}
.but{
    width:100%;
    display:flex;
    flex-direction:row;
    justify-content:center;
}
.buttons{
    margin:30px;
}
button{
    height:50px;
    width:100px;
    border-radius:10%;
    font-weight:bold;
    
}
#but1{
    color:red;
   
}
#but2{
    color:green;
}
#link1{
    text-decoration:none;
    color:red;
}
#link2{
    text-decoration:none;
    color:green;
}
h2{
    margin-top:30px;
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
            <!-- <form>
                <input type="text" name="search" placeholder="Search...">
                <input class="button" type="submit" name="submit" value="search">
            </form> -->
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
            <li><a href="customer_home.php" >Home</a></li>
            <li><a href="customer_products.php">Products</a></li>
            <!-- <li><a href="customer_orders.php">Orders</a></li> -->
            <li><a href="customer_orders_history.php" class="active">Order History</a></li>
        </ul>
    </div>
</nav>
<h2>Delivered Orders</h2>
<div class="but">
    <div class="buttons">
    <a id="link1" href="customer_pending_orders.php">
    <button id="but1">Pending</button>
    </a>
    </div>
    <div class="buttons">
    <a id="link2" href="customer_delivered_orders.php">
    <button id="but2">Delivered</button>
    </a>
    </div>
    </div>
</body>
</html>
<?php

$user_id = $_SESSION['user_id'];

$query="SELECT cart.cart_id , cart.product_id,orders.status, product.product_name,product.image_url, product.price ,cart.quantity
        FROM cart
        Inner Join orders ON cart.order_id=orders.order_id
        INNER JOIN product ON cart.product_id = product.product_id
        -- INNER JOIN orders ON cart.cart_id=orders.customer_id
        WHERE cart.cart_id='".$user_id."' && orders.status=1 ";


$res=mysqli_query($conn,$query);
$order_history=array();
while($row = mysqli_fetch_assoc($res)) {
    $order_history[] = $row;
}



foreach ($order_history as $cart_item): 
?>
        
        <div class="cart-item">
            
            <?php if($cart_item["status"] == 1){
                $str="Delivered";

            ?>
            <img src="<?php echo $cart_item['image_url']; ?>" alt="<?php echo $cart_item['product_name']; ?>">
            <h3><?php echo $cart_item['product_name']; ?></h3>
            <p>Quantity: <?php echo $cart_item['quantity']; ?></p>
            <?php $total_price = $cart_item['quantity']* $cart_item['price'];?>
            <p>Total Price: <?php echo $total_price; ?></p>
            <?php
            }
            ?>
            <p>Status: <?php echo "</p><h4>$str</h4>"; ?>
        </div>
    <?php endforeach; ?>



