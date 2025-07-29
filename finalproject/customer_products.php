<?php
session_start();
require_once('db.php');

// Get the category ID from the URL

if(isset($_REQUEST["category_id"])){
    
    $category_id = $_GET['category_id'];

    // Fetch products with the given category ID
    $sql = "SELECT * FROM product WHERE category_id='$category_id'";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }


?>
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
            <form method="post" action="customer_search.php">
                <input type="text" name="search" placeholder="Search...">
                <input class="button" type="submit" name="submit1" value="search">
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
            <li><a href="customer_products.php" class="active">Products</a></li>
            <!-- <li><a href="customer_orders.php">Orders</a></li> -->
            <li><a href="customer_orders_history.php">Order History</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content Section -->
<main>
<h2>Products</h2>
    <div class="main">
    <?php foreach ($products as $product): ?>
        <div class="pro">
        <div class="product">  
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>">
            <h3><?php echo $product['product_name']; ?></h3>
            <p>Price: <?php echo $product['price']; ?></p>
            <p>Stock Quantity: <?php echo $product['stock_quantity']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?category_id=<?php echo $category_id; ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                QTY : <input type="number" name="quantity" >
                <input type="submit" value="Add to Cart">
            </form>
        </div>
        </div>
    <?php endforeach; ?>
    </div>
</main>

</body>


<?php
}
}
else{
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }


?>
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
            <form method="post" action="customer_search.php">
                <input type="text" name="search" placeholder="Search...">
                <input class="button" type="submit" name="submit1" value="search">
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
            <li><a href="customer_products.php" class="active">Products</a></li>
            <!-- <li><a href="customer_orders.php">Orders</a></li> -->
            <li><a href="customer_orders_history.php">Order History</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content Section -->

<main>
<h2>Products</h2>
<div class="main">
    <?php foreach ($products as $product): ?>
        <div class="pro">
        <div class="product">  
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>">
            <h3><?php echo $product['product_name']; ?></h3>
            <p>Price: <?php echo $product['price']; ?></p>
            <p>Stock Quantity: <?php echo $product['stock_quantity']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?product_id=<?php echo $product['product_id']; ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                QTY : <input type="number" name="quantity" >
                <input type="submit" value="Add to Cart">
            </form>
        </div>
        </div>
        
    <?php endforeach; ?>
    </div>
</main>

</body>


<?php
}

// Handle adding to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    
    $product_id = $conn->real_escape_string($_POST['product_id']);
    $product_qty = $conn->real_escape_string($_POST['quantity']);

    $user_id = $_SESSION['user_id']; // Assuming you have stored user ID in session

    // Check if the product is already in the cart
    $check_sql = "SELECT * FROM cart WHERE cart_id='$user_id' AND product_id='$product_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $query="select * from cart where cart_id='$user_id' ";
        $result=mysqli_query($conn,$query);
        $rec=mysqli_fetch_assoc($result);
        if($rec["status"]==0){
            $rec["quantity"]=$rec["quantity"]+$product_qty;
            $query1="update cart set quantity='".$rec["quantity"]."' where cart_id='$user_id' ";
            mysqli_query($conn,$query1);
            
        }
        else{
            // Insert product into cart table
            $insert_sql = "INSERT INTO cart (cart_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$product_qty')";
            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("Product added to cart");</script>';
            } else {
                echo '<script>alert("Error adding product to cart: ' . $conn->error . '");</script>';
            }
        }
    }
    else{
        // Insert product into cart table
        $insert_sql = "INSERT INTO cart (cart_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$product_qty')";
        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("Product added to cart");</script>';
        } else {
            echo '<script>alert("Error adding product to cart: ' . $conn->error . '");</script>';
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
    </style>

<style>

    h2 {
        text-align: center;
        color: #333;
    }

    .product {
        height:400px;
        width:400px;
        font-family: 'Arial', sans-serif;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        
        padding-bottom:20px;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .pro{
        display:flex;
        flex-direction:row;
        justify-content:center;
        align-items:center;
    }

    .product img {
        width: 100%;
        max-width: 300px; /* Adjusts the size of the image */
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product h3 {
        margin: 10px 0;
        color: #5a5a5a;
    }

    .product p {
        margin: 5px 0;
        font-size: 16px;
        color: #666;
    }

    form {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }

    input[type="number"], input[type="submit"] {
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #5cb85c;
        color: white;
        cursor: pointer;
        border-color: #4cae4c;
    }

    input[type="submit"]:hover {
        background-color: #4cae4c;
    }

    input[type="number"] {
        width: 80px;
    }
    .main{
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        justify-content:center;
        align-items:center;
        gap:20px;
        padding:20px;
    }
    h2{
        margin-top:30px;
    }
</style>

</head>


</html>

