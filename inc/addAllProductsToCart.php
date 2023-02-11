<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

//try {
$products = [1, 2, 3];

if ($_POST['product']) {
    foreach ($products as $item) {
        $productId = $item;
        $qty = 1;
        if ($productId > 0 && $qty > 0) {
            $productContr = new ProductContr();
            $productId = $productContr->trimWhitespace($productContr->convertToHtmlEntities($productId));
            $qty = $productContr->trimWhitespace($productContr->convertToHtmlEntities($qty));
            $productContr->checkIfProductExists($productId);
            $product = new Product($productId);
            $cart->addProduct($product, $qty);
            echo $cart->getTotalQuantity();
        } else {
            header("Location: ../index.php");
        }
    }
} else {
    header("Location: ../index.php");
}


//} catch (Exception $exception){
//    echo $exception->getMessage();
//}


