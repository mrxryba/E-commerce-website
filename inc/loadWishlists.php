<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

header('Content-Type:application/json');
//try {
if ($_GET['product']) {
    if ($isLogged) {
        $productId = $_GET['product'];
        $productContr = new ProductContr();
        $productId = $productContr->trimWhitespace($productContr->convertToHtmlEntities($productId));
        if (!$productContr->checkIfProductExists($productId)) {
            throw new Exception("Product doesn't exist ");
        } else {
            $wishlistContr = new WishlistContr();
            $json = array();
            $wishlists = $wishlistContr->getWishlist($user->getId());
            if (!$wishlists) {
                $response = array(
                    'wishlistNotExist' => true
                );
                array_push($json, $response);
            } else {
                foreach ($wishlists as $item) {
                    $wishlist = new Wishlist($item['wishlist_id']);
                    $wishlist->findWishlistItem($productId) ? $productAdded = true : $productAdded = false;


                    $response = array(
                        'wishlistName' => $wishlist->getName(),
                        'wishlistNumber' => $wishlist->getWishlistNumber(),
                        'productAdded' => $productAdded

                    );
                    array_push($json, $response);
                }
            }
        }
    }else{
        $json = array(
            'userNotLogged' => true
        );
    }
    echo json_encode($json);
}



//} catch (Exception $exception) {
//    $response = array(
//        "error" => $exception->getMessage()
//    );
//    echo json_encode($response);
//}


