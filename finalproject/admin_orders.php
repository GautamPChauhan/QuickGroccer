<?php
require_once("db.php");
session_start();

?><!DOCTYPE html>
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
        a{
            text-decoration: none;
            color:black;
        }
        .button{
            background-color:lightgreen;
            border-radius:7px;;
            width:200px;
            height:50px;
            margin:30px;
        }
        #main{
        width:100%;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        /* background-color:#f2f2f2; */
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
        #table{
            display:flex;

            justify-content:center;
        }
        .tablebutton{
            border:none;
            background:#dcdcdc;
            height:35px;
        }
        .tablebutton:hover{
            border:1px solid black;
            background:#f0f0f0;
        }
        #delivered{
            height:35px;
        }
        tr:nth-child(even)
        {
            background-color:white;
            
        }
        .tablebutton:nth-child(even)
        {
            background-color:white;
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
                <li><a href="admin.php">Home</a></li>
                <!-- <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="admin_products.php">Products</a></li> -->
                <li><a href="admin_orders.php"  class="active">Orders</a></li>
                <li><a href="admin_delivery_man_list.php">Delivery Man List</a></li>
                <li><a href="admin_reports.php">Reports</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main>
        <div id="main">
        <div id="order">
        <h1>Order Page</h1>
        </div>
        <div id="twobuttons">
        <a href="admin_orders.php?task=undelivered">
        <button class="button">Undelivered</button>
        </a>
        <a href="admin_orders.php?task=delivered">
        <button class="button">Delivered</button>
        </a>
        </div>
        </div>
    </main>

    
</body>
</html>
<?php

if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="undelivered"){
    echo "<h3 align=center>UNDELIVERED</h3>";

    $query = "SELECT o.customer_id,o.order_id,o.total_price, o.date_time,u.username, u.phone_number, p.product_name, p.price, ca.quantity, ca.cart_id, sa.address, sa.state, sa.city 
              FROM orders o 
              JOIN cart ca ON o.customer_id = ca.cart_id 
              JOIN product p ON ca.product_id = p.product_id 
              JOIN shipping_address sa ON o.address_id = sa.address_id 
              JOIN user u ON o.customer_id = u.user_id 
              WHERE o.customer_id = ca.cart_id   && o.status=0 ";
    $result = mysqli_query($conn, $query);
    $printed_ids = array(); // to track printed customer_ids
    echo "<div id='table'>" ;
    echo "<div id='tablecenter'>" ;
    echo "<table border=2px solid black>";
    echo "<tr>";
    echo "<th>Name of customer</th>";
    echo "<th>Address</th>";
    echo "<th>State</th>";
    echo "<th>City</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Total Price</th>";
    echo "<th>Order Date</th>";
    echo "</tr>";
    while ($rec = mysqli_fetch_assoc($result)) {
        $current_id = $rec["order_id"];

        // Check if the customer_id has already been printed
        if (!in_array($current_id, $printed_ids)) {
            // Add customer_id to the printed_ids array to avoid reprinting
            $printed_ids[] = $current_id;

            // Print the row for the current record
            echo "<tr>";
            echo "<td>" . $rec["username"] . "</td>";
            // echo "<td>" . $rec["product_name"] . "</td>";
            // echo "<td>" . $rec["quantity"] . "</td>";
            echo "<td>" . $rec["address"] . "</td>";
            echo "<td>" . $rec["state"] . "</td>";
            echo "<td>" . $rec["city"] . "</td>";
            echo "<td>" . $rec["phone_number"] . "</td>";
            echo "<td>" . $rec["total_price"] . "</td>";
            echo "<td>" . $rec["date_time"] . "</td>";
            
            $tmp_order_id=$rec["order_id"];
            echo "<td>";
            echo "<a href='admin_product_view.php?tmp_id=$tmp_order_id'>";
            echo "<button class='tablebutton'>View Products</button>";
            echo "</a>";
            echo "</td>";

            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div >" ;
    echo "</div >" ;
}

if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="delivered"){
    echo "<h3 align=center>DELIVERED</h3>";
    $query = "SELECT o.customer_id,o.order_id,o.total_price ,o.date_time,o.delivery_date,u.username, u.phone_number, p.product_name, p.price, ca.quantity, ca.cart_id, sa.address, sa.state, sa.city 
              FROM orders o 
              JOIN cart ca ON o.customer_id = ca.cart_id 
              JOIN product p ON ca.product_id = p.product_id 
              JOIN shipping_address sa ON o.address_id = sa.address_id 
              JOIN user u ON o.customer_id = u.user_id 
              WHERE o.customer_id = ca.cart_id  && o.selected_status=1 && o.status=1 ";
    $result = mysqli_query($conn, $query);
    $printed_ids = array(); // to track printed customer_ids
        
    echo "<table border=2px solid black>";
    echo "<tr>";
    echo "<th>Name of customer</th>";
    echo "<th>Address</th>";
    echo "<th>State</th>";
    echo "<th>City</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Total Price</th>";
    echo "<th>Order Date</th>";
    echo "<th>Delivery Date</th>";
    echo "</tr>";
    while ($rec = mysqli_fetch_assoc($result)) {
        $current_id = $rec["order_id"];

        // Check if the customer_id has already been printed
        if (!in_array($current_id, $printed_ids)) {
            // Add customer_id to the printed_ids array to avoid reprinting
            $printed_ids[] = $current_id;

            // Print the row for the current record
            echo "<tr>";
            echo "<td>" . $rec["username"] . "</td>";
            // echo "<td>" . $rec["product_name"] . "</td>";
            // echo "<td>" . $rec["quantity"] . "</td>";
            echo "<td>" . $rec["address"] . "</td>";
            echo "<td>" . $rec["state"] . "</td>";
            echo "<td>" . $rec["city"] . "</td>";
            echo "<td>" . $rec["phone_number"] . "</td>";
            echo "<td>" . $rec["total_price"] . "</td>";
            echo "<td>".$rec["date_time"]."</td>";
            echo "<td>".$rec["delivery_date"]."<td>";
            
            $tmp_order_id=$rec["order_id"];
            echo "<td>";
            echo "<a href='admin_product_view.php?tmp_id=$tmp_order_id'>";
            echo "<button id='delivered' class='tablebutton'>View Products</button>";
            echo "</a>";
            echo "</td>";

            echo "</tr>";


        }
    }
    echo "</table>";
}


?>
