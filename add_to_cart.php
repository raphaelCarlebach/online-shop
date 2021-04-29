<?php
    session_start();

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }

    $already_in_cart = false; // יוצא מנקודת הנחה שהמוצר אינו קיים בעגלה

    foreach ($cart as $index => $val) { //עובר על כל העגלה אחד אחד
        if ($val['product'] == $_POST['product']) { // אם המוצר אותו אני רוצה להוסיף לעגלה כבר קיים בעגלה
            $cart[$index]['quantity'] = $cart[$index]['quantity'] + $_POST['quantity']; // להוסיף לו את הכמות המדוברת
            $already_in_cart = true; // קובע שהמוצר כבר קיים בעגלה
        }
    }

    if (!$already_in_cart) { //If item is already in the cart array
        // $item = array($_POST['product'], $_POST['quantity']); // Array[ product_id, quantity ]
        $item = array(
            'product' => $_POST['product'],
            'quantity' => $_POST['quantity']
        );

        $cart[] = $item; //Push $item to the $cart array like (array_push)
    }

    $_SESSION['cart'] = $cart;