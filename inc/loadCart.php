<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

header('Content-Type:application/json');


$products = $cart->getItems();
$response = array();
if ($products) {
    foreach ($products as $cartItem) {
        $productArray = array("productId" => $cartItem->getProduct()->getId(),
            "productQty" => $cartItem->getQuantity());
        $jsonArray[] = $productArray;
    }
} else {
    $response = array(
        'cartEmpty' => true
    );
}
echo json_encode($response);

?>





