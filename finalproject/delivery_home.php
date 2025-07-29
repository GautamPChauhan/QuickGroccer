<?php
session_start();
include 'db.php';

$user_id=$_SESSION["user_id"];
$city=$_SESSION["city"];

    if(isset($_REQUEST["order_id"])){
        
        $order_id=intval($_REQUEST["order_id"]);
        $query="update orders 
                join shipping_address on orders.address_id=shipping_address.address_id
                set orders.selected_status=1 , orders.delivery_person_id='".$user_id."'
                where orders.order_id='".$order_id."' && shipping_address.city='".$city."' ";
        // $query="update orders set selected_status = 1 , delivery_person_id='".$user_id."' where customer_id='".$customer_id."' ";
        mysqli_query($conn,$query);
        header("location:delivery_home.php");
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
    echo "<h2>Orders</h2>";

    $query = "SELECT o.customer_id,o.order_id,o.total_price ,u.username, u.phone_number, p.product_name, p.price, ca.quantity, ca.cart_id, sa.address, sa.state, sa.city 
              FROM orders o 
              JOIN cart ca ON o.customer_id = ca.cart_id 
              JOIN product p ON ca.product_id = p.product_id 
              JOIN shipping_address sa ON o.address_id = sa.address_id 
              JOIN user u ON o.customer_id = u.user_id 
              WHERE o.customer_id = ca.cart_id  && o.selected_status=0  && sa.city='".$city."'";

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

            
            $tmp_order_id=$rec["order_id"];
            echo "<td>";
            echo "<a href='delivery_product_view.php?tmp_id=$tmp_order_id'>";
            echo "<button class='tablebutton'>View Products</button>";
            echo "</a>";
            echo "</td>";

            $tmp_id=$rec["order_id"];
            echo "<td>";
            echo "<a href='delivery_home.php?order_id=$tmp_id'>";
            echo "<button class='tablebutton'>SELECT</button>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
        else{
            
        }
    }

    echo "</table>";
    echo "</div>";
    echo "</div>";
    // print_r($printed_ids);
?>


