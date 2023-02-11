<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

    if (isset($_GET['product']) && is_numeric($_GET['product'])) {
        $productId = $_GET['product'];
        $productContr = new ProductContr();
        $productId = $productContr->trimWhitespace($productContr->convertToHtmlEntities($productId));
        $product = new Product($productId);
        $cart->removeProduct($product);
        $products = $cart->getItems();
        if ($products){
            $response = array();
            $response[] =array(
                "cartQty" => $cart->getTotalQuantity(),
                "cartTotal" => $cart->getTotalSum()
            );
        }else{
            $response = array(
                "cartEmpty" => true
            );
        }
        echo json_encode($response);
    } else {
        header("Location: ../index.php");
    }
