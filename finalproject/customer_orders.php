<?php
session_start();
require_once('db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch cart items for the user
$user_id = $_SESSION['user_id'];
// $user_id = 4;

$sql = "SELECT cart.cart_id, cart.quantity, product.product_id, product.product_name, product.image_url, product.price 
        FROM cart
        INNER JOIN product ON cart.product_id = product.product_id
        WHERE cart.cart_id = '$user_id' and cart.status=0 ";
$result = $conn->query($sql);

$cart_items = array();
$total_amount = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $total_price = $row['price'] * $row['quantity'];
        $total_amount += $total_price;
        $cart_items[] = array(
            'cart_id' => $row['cart_id'],
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'image_url' => $row['image_url'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'total_price' => $total_price
        );
    }
}
else{
    header("location:customer_cart.php");
}

// Handle order confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
    // Insert order into order table
    $order_date = date("Y-m-d H:i:s");
    $insert_order_sql = "INSERT INTO `orders` (customer_id, date_time) VALUES ('$user_id', '$order_date')";
    if ($conn->query($insert_order_sql) === TRUE) {
        $order_id = $conn->insert_id;
        // Update order with selected or new address ID
        if (isset($_POST['address_id'])) {
            $address_id = $_POST['address_id'];
            $update_order_sql = "UPDATE `orders` SET address_id='$address_id' WHERE order_id='$order_id'";
            $conn->query($update_order_sql);
        }
        
        if (isset($_POST['total_amount'])) {
            $total_amount = $_POST['total_amount'];
            $update_order_total_sql = "UPDATE `orders` SET total_price='$total_amount' WHERE order_id='$order_id'";
            $conn->query($update_order_total_sql);
        }
        $query="update cart set status=1 , order_id='".$order_id."' where cart_id='$user_id' && status=0 ";
        mysqli_query($conn,$query);
        // Redirect to order confirmation page or display success message
        //echo '<script>alert("Thank you for your Order !");</script>';

        header("Location: customer_home.php");
        echo '<script>alert("Thank you for your Order !");</script>';
        
    } else {
        echo "Error inserting order: " . $conn->error;
    }
}

// Fetch user addresses
if(isset($_REQUEST["new_address_id"])){
    $ship_id=$_REQUEST["new_address_id"];
    $sql = "SELECT * FROM shipping_address WHERE address_id=$ship_id ";
    $result = $conn->query($sql);
    $addresses = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }
    }

}
else{
    $sql = "SELECT * FROM shipping_address WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $addresses = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }
    }

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
            display:flex;
            align-items:center;
            justify-content:center;
            margin-top:50px;

        }
        #invoice{
            background:#f2f2f2;
            width:600px;
            height:auto;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:20px;
        }
        #invoice h2,h3{
            margin-bottom:20px;
        }
        #invoice table{
            background-color:white;
            width:500px;
            margin-bottom:20px;
            display:flex;
            text-align:center;
            border-collapse:separate;
            border-spacing:20px;
            justify-content:center;
        }
        p{
            text-align:center;
            margin-bottom:20px;
        }
        .address{
            width:500px;
            display:flex;
            flex-direction:column;
            justify-content:flex-start;

        }
        .address select{
            margin-left:10px;
            height:30px;
            width:300px;
            margin-right:20px;
            
        }
        #addressopt{
            display:flex;
            flex-direction:row;
            justify-content:center;
        }
        .add{
            color:black;
            font-weight:bold;
            margin-left:20px;
            text-decoration:none;
        }
        #confirm{
           /*border:black 1px solid;*/
            display:flex;
           
            
            justify-content:center;
        }
        #confirm input{
            margin-top:20px;
            position:relative;
            right:10px;
          
            background-color: lightgreen;
            border:none;
            width:200px;
            height:35px;
            
        }
        form{
            display:flex;
            flex-direction:column;
            justify-content:flex-start;
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
            <li><a href="customer_home.php">Home</a></li>
            <li><a href="customer_products.php">Products</a></li>
            <!-- <li><a href="customer_orders.php" class="active">Orders</a></li> -->
            <li><a href="customer_orders_history.php">Order History</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content Section -->
 <div id="main">
<main id="invoice">
<h2>Order Confirmation</h2>
    <div class="invoice">
        <h3>INVOICE:</h3>
        <table>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Unit Pirce </th>
        <th>Total Price</th>
        <?php foreach ($cart_items as $item): ?>
            <tr>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['total_price']; ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
        <p>Total Amount: <?php echo $total_amount; ?></p>
    </div>
    <div class="address">
    <div id="addressopt">
        <h3>Shipping Address:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <select name="address_id">
                <?php foreach ($addresses as $address): ?>
                    <option value="<?php echo $address['address_id']; ?>"><?php echo $address['address']; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <input type="hidden" name="total_amount" value="<?php echo $total_amount;?>">
            
            <p>Or <a class="add" href="add_address.php">add a new address </a></p>
            

            <div id="confirm">
            <input type="submit" name="confirm_order" value="Confirm Order with COD">
            </div>
        </form>

       
        
    </div>
</main>
</div>
</body>
</html>