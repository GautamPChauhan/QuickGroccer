<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_address']) && isset($_POST['new_address_city']) && isset($_POST['new_address_state'])) {
    $user_id = $_SESSION['user_id'];
    $new_address = $conn->real_escape_string($_POST['new_address']);
    echo $new_address;
    $new_address_city = $conn->real_escape_string($_POST['new_address_city']);
    $new_address_state = $conn->real_escape_string($_POST['new_address_state']);

    // Insert new address into the database
    $insert_sql = "INSERT INTO shipping_address (user_id, address, city, state) VALUES ('$user_id', '$new_address', '$new_address_city', '$new_address_state')";
    if ($conn->query($insert_sql) === TRUE) {
        $query1="select * from shipping_address where address='".$new_address."' ";
        $result=mysqli_query($conn,$query1);
        $rec=mysqli_fetch_assoc($result);
        $new_address_id=$rec["address_id"];
        echo "New address added successfully";
        header("Location:customer_orders.php?new_address_id=$new_address_id");

    } else {
        echo "Error adding new address: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Address</title>
</head>
<style>
     h2 {
            color: #333;
            text-align: center;
        }
        #main{
            
            width:100%;
            height:100%;
            display:flex;
        }
        #form{
            background:#f2f2f2;
            padding:40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            
            
        }
        input ,select{
            margin-left:20px;
            height:25px;
        }
        #report{
            margin:20px;
            margin-top:30px;
            margin-bottom:0px;
            width:100px;
            height:40px;
            position:relative;
            left:60px;
            border:none;
            background:white;
        }
        #report:hover{
           border:1px solid black;
        }         
        #main{
            display:flex;
            width:100%;
        justify-content:center;
            padding-top:70px;
        }
        #form{
            background:#f2f2f2;
            
            padding:40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            
            
        }
        input ,select{
            margin-left:20px;
            height:25px;
        }
        #report{
            margin:20px;
            margin-top:30px;
            margin-bottom:0px;
            width:100px;
            height:40px;
            position:relative;
            left:60px;
            border:none;
            background:white;
        }
        #report:hover{
           border:1px solid black;
        }
        #link{
            display:flex;
            flex-direction:row;
            width:100%;
            justify-content:center;
        }
        .link{
            margin:40px;
        }
</style>
<body>
<div id="main">
<div id="form">
    <h2>Add New Address</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="align">
        <label for="new_address">Address:</label>
        <input type="text" id="new_address" name="new_address" required><br><br>
        </div>
        <div class="align">
        <label for="new_address_city">City:</label>
        <input type="text" id="new_address_city" name="new_address_city" required><br><br>
        </div>
        <div class="align">
        <label for="new_address_state">State:</label>
        <input type="text" id="new_address_state" name="new_address_state" required><br><br>
        </div>
        <input id="report"type="submit" value="Add New Address">
    </form>
    </div>
    </div>
</body>
</html>
