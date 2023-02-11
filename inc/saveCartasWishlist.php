<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";
if ($isLogged) {
    if (isset($_POST['wishlistName'])) {
        $wishlistContr = new WishlistContr();
        $wishlistName = $_POST['wishlistName'];
        $wishlistName = $wishlistContr->trimWhitespace($wishlistName);
        $wishlistName = $wishlistContr->convertToHtmlEntities($wishlistName);
        $wishlistId = $wishlistContr->createWishlist($user->getId(), $wishlistName)['wishlist_id'];
        $wishlist = new Wishlist($wishlistId);
        $wishlistNumber = $wishlist->getWishlistNumber();
        $cartItems = $cart->getItems();
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->getProduct();
            $wishlist->addProductToWishlist($product);
        }
    }
    header("Location: ../wishlist.php?wishlist=$wishlistNumber");
} else {
    header("Location: ../index.php");
}