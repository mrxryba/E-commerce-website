<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

try {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        if (($_GET['product']) && ($_GET['qty'])) {
            $qty = $_GET['qty'];
            $productId = $_GET['product'];
            if ($productId > 0 && $qty > 0) {
                $productContr = new ProductContr();
                $productId = $productContr->trimWhitespace($productContr->convertToHtmlEntities($productId));
                $qty = $productContr->trimWhitespace($productContr->convertToHtmlEntities($qty));
                $productContr->checkIfProductExists($productId);
                $product = new Product($productId);
                $cart->addProduct($product, $qty);
                $response = array(
                    "cartQty" => $cart->getTotalQuantity()
                );
                echo json_encode($response);
            }
        }
    }
} catch (Exception $exception) {
    $response = array(
        "error" => $exception->getMessage()
    );
    echo json_encode($response);
}

