<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";
if ($isLogged) {
    $wishlistName = file_get_contents('php://input');
    $wishlistName = json_decode(stripslashes($wishlistName), true);
    $wishlistContr = new WishlistContr();
    $wishlistName = $wishlistContr->trimWhitespace($wishlistName);
    $wishlistName = $wishlistContr->convertToHtmlEntities($wishlistName);
    $wishlistNumber = $wishlistContr->createWishlist($user->getId(), $wishlistName)['wishlist_number'];
    if ($wishlistNumber){
        $response = array(
            'wishlistCreated' => true
        );
    }else{
        $response = array(
            'wishlistCreated' => false
        );
    }
    echo json_encode($response);
}