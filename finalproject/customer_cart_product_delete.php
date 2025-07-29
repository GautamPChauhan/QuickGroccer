<?php
require_once("db.php");
if(isset($_REQUEST["task"]) && $_REQUEST["task"]=="delete"){
    $pid=$_REQUEST["product_id"];
    $query="delete from cart where product_id=$pid ";
    mysqli_query($conn,$query);
    header("Location:customer_cart.php");
}

?>