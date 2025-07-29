<?php
require_once("db.php");
session_start();

if(isset($_POST["submit"])){
    $category_name=$_POST["category_name"];
    if(isset($_FILES["image"]) && $_FILES["image"]["error"]==0){
        $image_name=$_FILES["image"]["name"];
        $image_tmp_name=$_FILES["image"]["tmp_name"];
        $image_path = 'Uploads/Categories/' . $image_name;

        move_uploaded_file($image_tmp_name, $image_path);

        $query="insert into category(category_name,image_url)
                values('".$category_name."','".$image_path."')";
                
        mysqli_query($conn,$query);
        header("location:admin.php");
        exit;
    }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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
    </style>

<style>
        h2 {
            color: #333;
            text-align: center;
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
                <li><a href="admin.php" class="active">Home</a></li>
                <!-- <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="admin_products.php">Products</a></li> -->
                <li><a href="admin_orders.php">Orders</a></li>
                <li><a href="admin_delivery_man_list.php">Delivery Man List</a></li>
                <li><a href="admin_reports.php">Reports</a></li>
            </ul>
        </div>
    </nav>

<div id="addnew"> 
<div id="addpro">
<div id="form">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="product_name">Category Name:</label><br>
        <input type="text"  name="category_name" required><br><br>

        <label for="image">Image (PNG or JPG, max 5MB):</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg" required><br><br>

        <input type="submit" name="submit" value="Add Category">
    </form>
    </div>
    </div>
    </div>
</body>
</html>
<?php


?>

