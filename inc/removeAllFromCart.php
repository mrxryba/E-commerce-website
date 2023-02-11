<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";


    if (($_GET['product'] === "all")) {
        $cartItems = $cart->getItems();
        foreach ($cartItems as $cartItem) {
            $cartItem->getProduct();
            $cart->removeProduct($cartItem->getProduct());
        }
        $response = array(
            "cartEmpty" => true
        );
        echo json_encode($response);
    }

