<?php
session_start();
include 'db.php';

// Check if user is an admin
// if ($_SESSION['role'] !== 'admin') {
//     die("You do not have permission to access this page.");
// }

// Get the category ID from the URL
$category_id = $_REQUEST['category_id'];



$sql = "SELECT * FROM product WHERE category_id='$category_id'";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $stock_quantity = $conn->real_escape_string($_POST['stock_quantity']);

    // Check if an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];

        // Check if the file is a PNG or JPG
        $allowed_types = array('image/png', 'image/jpeg');
        if (in_array($image_type, $allowed_types) && $image_size < 5000000) { // 5MB limit
            $image_path = 'Uploads/Products/' . $image_name;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Insert the product into the database
                $sql = "INSERT INTO product (product_name, price, stock_quantity, image_url, category_id) 
                        VALUES ('$product_name', '$price', '$stock_quantity', '$image_path', '$category_id')";

                if ($conn->query($sql) === TRUE) {
                    echo "Product added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Failed to upload image";
            }
        } else {
            echo "Invalid image format or size (PNG or JPG only, max 5MB)";
        }
    } else {
        echo "Please select an image";
    }
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
    #p1{
        display:flex;
        flex-direction:row;
        gap:20px;
        padding:20px;
        flex-wrap:wrap;
        justify-content:center;

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
    a{
        text-decoration: none;
        color: black;
    }
    h2{
    margin-top:30px;
    }
    #main{
        width:100%;
        display:flex;
        justify-content:center;
    }
    #addnew{
            width:100%;
            background:#f2f2f2;
            height:auto;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:20px;
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
                <li><a href="admin_products.php" class="active">Products</a></li> -->
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_delivery_man_list.php">Delivery Man List</a></li>
                <li><a href="admin_reports.php">Reports</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Main Content Section -->
    <main>
      <div id="addnew"> 
    <div id="addpro">
    <?php 
        if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="insert"){
            echo "<h2>Add product details</h2><br>";
    ?>
    <div id="form">
    <form action="admin_products.php?category_id=<?php echo $category_id; ?>" method="post" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

        <label for="stock_quantity">Stock Quantity:</label><br>
        <input type="number" id="stock_quantity" name="stock_quantity" min="0" required><br><br>

        <label for="image">Image (PNG or JPG, max 5MB):</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg" required><br><br>

        <input type="submit" value="Add Product">
    </form>
    </div>
    <?php
        }
    ?>
    </div>
    </div> 
    </main>
    <main>
<h2 align="center">Products</h2>
<div id="p1">
    <?php foreach ($products as $product): ?>
        <div class="pro">
        <div class="product">  
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>">
            <h3><?php echo $product['product_name']; ?></h3>
            <p>Price: <?php echo $product['price']; ?></p>
            <p>Stock Quantity: <?php echo $product['stock_quantity']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?category_id=<?php echo $category_id; ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <!-- QTY : <input type="number" name="quantity" > -->
                <!-- <input type="submit" value="Add to Cart"> -->
            </form>
        </div>
        </div>
    <?php endforeach; ?>
    </div>
</main>

    
</body>
</html>
