<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
include_once "./phpHeader.php";
if (!isset($_GET['wishlist'])) {
    header("Location: ../index.php");
}
if (!($_GET['wishlist'])) {
    header("Location: ../index.php");
}
include_once "./header.php";
$wishlistContr = new WishlistContr();
if (($_GET['wishlist'])) {
    $wishId = $wishlistContr->getWishlistByNumber($_GET['wishlist'])['wishlist_id'];
    $wishlist = new Wishlist($wishId);
    $containProducts = (bool)$wishlist->getItems();

    foreach ($wishlist->getItems() as $product) {
        echo $product->getId();
    }
}
?>


<div class="wrapper">
    <a class="wishlist-back-btn" href="wishlists.php"><span class="material-symbols-outlined">arrow_back_ios</span>
        <span>Show all Wishlists</span></a>
    <div class="wishlist-title-section">
        <!--        <span>Info about notifications</span>-->
        <!--        <span>Button Log in and Save this Wishlist</span>-->
        <h2 class="wishlist-title"><?php echo $wishlist->getName(); ?></h2>
        <span class="material-symbols-outlined">more_vert</span>
    </div>
    <?php if ($containProducts): ?>
        <div class="wishlist-items">
            <span class="wishlist-select">Select all</span>
            <?php foreach ($wishlist->getItems() as $product): ?>
                <div class="wishlist-item">
          <span class="wishlist-item-image-wrapper">  <img class="wishlist-item-image"
                                                           src="<?php echo $product->getImage(); ?>"
                                                           alt="<?php echo $product->getTitle(); ?>"/></span>
                    <div class="wishlist-item-info">
                        <div class="wishlist-item-title-sett">
                            <span class="wishlist-item-title"><?php echo $product->getTitle(); ?></span>
                            <span class="wishlist-item-settings"><span
                                        class="material-symbols-outlined">more_vert</span></span>
                        </div>
                        <div class="wishlist-item-price-qty"> <span class="wishlist-item-price">
                <?php echo $product->getPrice(); ?><span>zł</span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="wishlist-summary">
            <div><span>Total products:</span><span><?php echo " " . $wishlist->getTotalProducts(); ?></span></div>
            <div>
                <span>Total Wishlist price:</span><span><?php echo " " . $wishlist->getTotalSum(); ?></span><span>zł</span>
            </div>
        </div>
        <div class="wishlist-btn-section">
            <a class="wishlist-add-to-cart-btn" href="#"><span>Add to Cart</span></a>
        </div>
    <?php endif;
    if (!$containProducts): ?>
    <div class="wishlist-empty">Empty</div>
     <?php endif;?>
</div>
<script src="inc/script.js"></script>
</body>