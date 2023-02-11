<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

//try {

$newCartItemsQty = file_get_contents('php://input');
$newCartItemsQty = json_decode(stripslashes($newCartItemsQty), true);

if ($newCartItemsQty) {

    foreach ($newCartItemsQty as $item) {
        $productId = $item['productId'];
        $qty = $item['productQty'];
        if ($productId > 0 && $qty > 0) {
            $productContr = new ProductContr();
            $productContr->checkIfProductExists($productId);
            $product = new Product($productId);
            $cart->changeProductQty($product, $qty);
        }
    }
}
$response = array(
    "cartQty" => $cart->getTotalQuantity(),
    "cartTotal" => $cart->getTotalSum()
);
echo json_encode($response);
//} catch (Exception $exception) {
//    $response = array(
//        "error" => $exception->getMessage()
//    );
//    echo json_encode($response);
//}
//
