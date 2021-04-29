<?php
require "dbcon.php";

$session_id = $_POST['session_id'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];

$sql_insert = "INSERT INTO carts (Quantity,ProductID,SessionsID) VALUES ('". $quantity."','".$product."','".$session_id."');";
$query = mysqli_query($conn, $sql_insert);




// $sql_order = "INSERT INTO `orders` (`SessionsID`, `userID`) VALUES ('".$session_id."'','".$userID."');";
// $query = mysqli_query($conn, $sql_order);


 

          
   


    






