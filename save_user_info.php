<?php

require 'dbcon.php';

$fields = $_POST['fields'];

$new_fields = array();
    foreach ($fields as $val) {
        $new_fields[$val['name']] = $val['value'];
    }
 print_r($new_fields);

 $First_Name = $new_fields['First_Name'];
 $Last_Name = $new_fields['Last_Name'];
 $Email = $new_fields['Email'];
 $Notes = $new_fields['Notes'];
 $Street_Address = $new_fields['Street_Address'];
 $City = $new_fields['City'];
 $Zip_Code = $new_fields['Zip_Code'];
 $Country = $new_fields['Country'];
  
$session_id = $_POST['session_id'];

 $sql = "INSERT INTO users (First_Name,Last_Name,Email,Notes,Street_Address,City,Zip_Code,Country) VALUES ('".$First_Name."','".$Last_Name."','".$Email."','".$Notes."','".$Street_Address."','".$City."','".$Zip_Code."','".$Country."')";
//  $users = mysqli_query($conn, $sql);

 if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
  };
 
// todo:
// הזרקת הסשן צריכה להיות ביחד עם הזרקת המשתמש 
// ולא כ2 פעולות נפרדות 
// כדי למנוע פרצה(כפילות מוצר) בפונקולניות של ההזמנה 
// מה שצריך לעשות זה ריקוויר לנתונים של
//  save_order.php ושם לא לעשות להם insert אלה ביחד עם ה user



//  order info
// יש פה בעיית סינטקס צריך לפתור
// $sql_order = "INSERT INTO orders (SessionsID, userID) VALUES ('$session_id', '$last_id');";
// $query = mysqli_query($conn, $sql_order); 

