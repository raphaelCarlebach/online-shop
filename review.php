<?php

require 'dbcon.php';

$fields = $_POST['fields'];
$product = $_POST['product'];

$new_fields = array();
    foreach ($fields as $val) {
        $new_fields[$val['name']] = $val['value'];
    }
 print_r($new_fields);
 print_r($product);


 $rating = $new_fields['rating'];
 $comment = $new_fields['comment'];
 
  $sql = "INSERT INTO reviews (productID,rating,comment) VALUES ('".$product."','".$rating."','".$comment."');";

 $reviews = mysqli_query($conn, $sql);