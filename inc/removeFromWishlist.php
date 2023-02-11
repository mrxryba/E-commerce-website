<?php
session_start();
include_once "../inc/autoloader.inc.php";
include_once "../inc/traitAutoloader.php";
include_once "../phpHeader.php";

    if ($_GET['product'] && $_GET['wishlistNumber']) {
        $productId = $_GET['product'];
        $wishlistNumber = $_GET['wishlistNumber'];
        $wishlistContr = new WishlistContr();
        $wishId = $wishlistContr->getWishlistByNumber($wishlistNumber)['wishlist_id'];
        $wishlist = new Wishlist($wishId);
        $product = new Product($productId);
        $wishlist->removeProductFromWishlist($product);
        if (!$wishlist->findWishlistItem($productId)) {
            $response = array(
                'productRemoved' => true
            );
        } else {
            $response = array(
                'productRemoved' => false
            );
        }
        echo json_encode($response);

    }