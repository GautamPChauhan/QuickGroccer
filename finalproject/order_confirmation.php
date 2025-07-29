<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch total amount from the order table
// $sql = "SELECT * 
//         FROM orders
//         WHERE orders.customer_id = '$user_id' && status=0";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_amount = $row['total_price'];
// }



// Insert order into the order table
// $order_date = date('Y-m-d H:i:s');
// $insert_order_sql = "INSERT INTO `orders` (customer_id, date_time, total_price) VALUES ('$user_id', '$order_date', '$total_amount')";
// if ($conn->query($insert_order_sql) === TRUE) {
    // Clear the cart after successful order placement
    // $clear_cart_sql = "DELETE FROM cart WHERE cart_id='$user_id'";
    // $conn->query($clear_cart_sql);
// } else {
    // echo "Error placing order: " . $conn->error;
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank You for Your Order</h2>
    
</body>
</html>

