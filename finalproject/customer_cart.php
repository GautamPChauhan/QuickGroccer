<?php
session_start();
require_once('db.php');

// Get the user ID from the session
$user_id = $_SESSION['user_id'];
//$carterr="";
// Fetch cart items for the user
$sql = "SELECT cart.cart_id, cart.quantity, product.product_id, product.product_name, product.image_url, product.price
        FROM cart
        INNER JOIN product ON cart.product_id = product.product_id
        WHERE cart.cart_id = '$user_id' and cart.status=0";
$result = $conn->query($sql);
$cart_items = array();
if ($result->num_rows > 0 ) {
    while($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
}
else{
    //$carterr="Your cart is Empty !";
}

// Handle quantity updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($cart_items as $cart_item) {
        if (isset($_POST['quantity_' . $cart_item['cart_id']])) {
            $cart_id = $cart_item['cart_id'];
            $quantity = $_POST['quantity_' . $cart_item['cart_id']];

            // $update_sql = "UPDATE cart SET quantity='$quantity' WHERE cart_id='$cart_id'";
            // if ($conn->query($update_sql) !== TRUE) {
            //     echo "Error updating quantity: " . $conn->error;
            // }
        }
    }
    // Redirect to refresh the page to prevent resubmission of form data
    // header("Location:customer_cart.php");
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

a{
    text-decoration:none;
    color:black;
}
form {
    text-align: center;
    margin-top: 20px;
}

input[type="submit"] {
    background-color: #5C67F2;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #4a54e1;
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
            <li><a href="customer_home.php">Home</a></li>
            <li><a href="customer_products.php">Products</a></li>
            <!-- <li><a href="customer_orders.php">Orders</a></li> -->
            <li><a href="customer_orders_history.php">Order History</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content Section -->
<main >

<h2 align="center">Cart</h2>
 
    <?php foreach ($cart_items as $cart_item): ?>
        <div class="cart-item">
            <img src="<?php echo $cart_item['image_url']; ?>" alt="<?php echo $cart_item['product_name']; ?>">
            <h3><?php echo $cart_item['product_name']; ?></h3>
            <p>Quantity: <?php echo $cart_item['quantity']; ?></p>
            <p>Unit Price: <?php echo $cart_item['price']; ?></p>
            <?php $total_price = $cart_item['quantity']* $cart_item['price'];?>
            <p>Total Price: <?php echo $total_price; ?></p>
            <button><a href='customer_cart_product_delete.php?task=delete&product_id=<?php echo $cart_item["product_id"]; ?>'>Remove from Cart</a></button>
        </div>
    <?php endforeach; ?>

    <form action="customer_orders.php" method="post">
        <input type="submit" value="Proceed to Order">
    </form>
</main>

</body>
</html>

