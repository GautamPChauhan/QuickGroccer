<?php
session_start();
include 'db.php';

$deliver_man_id=$_SESSION["user_id"];
//echo $deliver_man_id;
$city=$_SESSION["city"];

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
            border-collapse:collapse;
            width:100%;
            
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
            width:100%;
            padding:25px;
            justify-content:center;
        }
        .tablebutton{
            border:none;
            background:white;
            height:25px;
        }
        .tablebutton:hover{
            border:1px solid black;
            background:lightgreen;
        }
        #delivered{
            height:35px;
        }
        tr:nth-child(even)
        {
            background-color:white;
        }
    </style>

<style>
        h2 {
            color: #333;
            text-align: center;
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
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Checkboxes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

    <!-- <script>
        document.getElementById('select-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.row-select');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script> -->
</body>
</html>
<?php
   

?>

<?php
    $tmp_id=$_REQUEST["tmp_id"]; 
    // $query = "SELECT cart.cart_id, cart.quantity, product.product_id, product.product_name, product.price
    //     FROM cart
    //     INNER JOIN product ON cart.product_id = product.product_id
    //     WHERE cart.cart_id = '$tmp_id' and cart.status=1 ";
    // $query = "SELECT o.customer_id, u.username,o.total_price ,u.phone_number, p.product_name, p.price, ca.quantity, ca.cart_id, sa.address, sa.state, sa.city 
    // FROM orders o 
    // JOIN cart ca ON o.customer_id = ca.cart_id 
    // JOIN product p ON ca.product_id = p.product_id 
    // JOIN shipping_address sa ON o.address_id = sa.address_id 
    // JOIN user u ON o.customer_id = u.user_id 
    // WHERE ca.cart_id='".$tmp_id."' && o.status=0 && ca.status=1 && sa.city='".$city."'  ";
    $query ="SELECT cart.cart_id, cart.quantity, product.product_id, product.product_name, product.price
            FROM cart
             INNER JOIN product ON cart.product_id = product.product_id
             WHERE cart.order_id = '$tmp_id' and cart.status=1 ";


    $result = mysqli_query($conn, $query);
    echo "<div id='table'>";
    echo "<div id='tablecenter'>";
    echo "<table border=2px solid black>";
    echo "<tr id='headrow'>";
    echo "<th>Product Name</th>";
    echo "<th>Quantity</th>";
    echo "</tr>";
    while ($rec = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$rec["product_name"]."</td>";
        echo "<td>".$rec["quantity"]."</td>";    
        echo "</tr>";
    }

echo "</table>";
echo "</div>";
echo "</div>";

    


?>