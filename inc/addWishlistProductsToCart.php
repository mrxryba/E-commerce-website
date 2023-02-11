<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";
if ($isLogged) {
    if (($_GET['wishlist'])) {
        $wishlistContr = new WishlistContr();
        $wishId = $wishlistContr->getWishlistByNumber($_GET['wishlist'])['wishlist_id'];
        $wishlist = new Wishlist($wishId);
        foreach ($wishlist->getItems() as $product) {

        }
    }
} else {
    header("Location: ../index.php");
}
