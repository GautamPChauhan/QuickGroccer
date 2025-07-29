<?php
require_once('db.php');

// if ($_SESSION['role'] !== 'admin') {
//     die("You do not have permission to access this page.");
// }

// Handle form submission
if (isset($_POST["submit"])) {
    $category_name = $conn->real_escape_string($_POST['category_name']);

    // Check if an image was uploaded
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_name = $_FILES['image_url']['name'];
        $image_tmp_name = $_FILES['image_url']['tmp_name'];
        $image_size = $_FILES['image_url']['size'];
        $image_type = $_FILES['image_url']['type'];

        // Check if the file is a PNG or JPG
        $allowed_types = array('image/png', 'image/jpeg');
        if (in_array($image_type, $allowed_types) && $image_size < 5000000) { // 5MB limit
            $image_path = 'Uploads/Categories/' . $image_name;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Insert the category into the database
                $sql = "INSERT INTO category (category_name, image_url) VALUES ('$category_name', '$image_path')";

                if ($conn->query($sql) === TRUE) {
                    // echo "Category added successfully";
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

$sql = "SELECT * FROM category";
$result = $conn->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
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
                <!-- <li><a href="admin_categories.php" class="active">Categories</a></li>
                <li><a href="admin_products.php">Products</a></li> -->
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_delivery_man_list.php">Delivery Man List</a></li>
                <li><a href="admin_reports.php">Reports</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main>
        <br><br><button><a href="admin_categories.php?task=insert">Add Category</a></button>
        
        
        <h2>Categories</h2>
        <div class="categories">
        <?php foreach ($categories as $category): ?>
            <div class="category">
                <a href="admin_products.php?category_id=<?php  echo $category['category_id']; ?>">    
                <img src="<?php echo $category['image_url']; ?>" alt="<?php echo $category['category_name']; ?>">     
                Add products to <?php  echo $category['category_name']; ?></a>
            </div>
            <?php endforeach; ?>
        </div>
    
    </main>

    
</body>
</html>
<?php

if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="insert"){



?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required><br><br>

        <label for="image_url">Category Image:</label>
        <input type="file" id="image_url" name="image_url" required><br><br>

        <input type="submit" name="submit" value="Add Category">
    </form>
<?php
}
?>