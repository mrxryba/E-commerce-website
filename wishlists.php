<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
include_once "./phpHeader.php";
include_once "./header.php";
?>

<div class="wrapper">

    <?php if ($isLogged): ?>
        <a class="wishlists-back-button" href="./settings.php"><span class="material-symbols-outlined">arrow_back_ios</span><span>Back</span></a>
    <?php endif; ?>
    <div class="wishlists-nav" style="display: none">
        <span>nav</span>
    </div>
    <div class="wishlists-title-section">
        <h1 class="wishlists-title">Wishlists</h1>
        <form action="inc/createWishlist.php" method="post">
            <input type="text" name="wishlistName" placeholder="Name of list">
            <input type="submit" value="Add Wishlist">
        </form>
        <?php if (!$isLogged): ?>
            <a class="wishlists-add-wishlist-button" href="login.php"><span>Add Wishlist</span></a>
        <?php endif; ?>
        <?php if($isLogged):  ?>
        <label class="modal-open modal-label" for="modal-open3">
            <a class="wishlists-add-wishlist-button"><span>Add Wishlist</span></a>
        </label>
        <input type="radio" name="modal" value="open" id="modal-open3" class="modal-radio"/>
        <div class="modal modal3">
            <label class="modal-label overlay">
                <input type="radio" name="modal" value="close" class="modal-radio"/>
            </label>
            <div class="content">
                <div class="top">
                    <h2>Add new wishlist</h2>
                    <label class="modal-label close-btn">
                        <input type="radio" name="modal" value="close" class="modal-radio"/>
                    </label>
                </div>

            </div>
            <?php endif; ?>

        </div>


    </div>
    <?php if ($isLogged): ?>
        <div class="wishlists">
            <?php
            if ($isLogged) {
                $wishlistContr = new WishlistContr();
                $wishlists = $wishlistContr->getWishlist($user->getId());
                foreach ($wishlists as $item) {
                    $wishlist = new Wishlist($item['wishlist_id']);
                    ?>

                    <div class="wishlists-item">
                        <a class="wishlists-item-link"
                           href="./wishlist.php?wishlist=<?php echo $wishlist->getWishlistNumber(); ?>">
                            <h2 class="wishlists-item-title"><?php echo $wishlist->getName(); ?></h2>
                            <div class="wishlists-item-image-wrapper">
                                <?php $wishlistProducts = $wishlist->getItems();
                                foreach ($wishlistProducts as $product) { ?>
                                    <img class="wishlists-item-image" src="<?php echo $product->getImage(); ?>"
                                         alt="<?php echo $wishlist->getName(); ?>"/>
                                <?php } ?>
                            </div>
                            <?php if (!$wishlistProducts): ?>
                                <p>This wishlist is empty</p>
                            <?php endif;
                            if ($wishlistProducts):?>
                                <p class="wishlists-item-total"><?php echo $wishlist->getTotalSum() . " "; ?>
                                    <span>zł</span></p>
                            <?php endif; ?>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    <?php endif; ?>
    <?php if (!$isLogged): ?>
        <div class="wishlists-not-logged-section">
            <h3>How to use the wishlists?</h3>
            <p>1.
                Add products to your cart and save as a list
                Save the products you are interested in for later, don't waste time searching for them again.</p>
            <p>2.
                Create as many lists as you need
                You can create as many shopping lists as you need. Save computer sets, gift ideas or suggestions for
                friends.</p>
            <p>3.
                Share
                Want to advise your family or ask your friends for feedback? Share your list instead of sending each
                link separately.</p>
        </div>
    <?php endif; ?>

</div>

<script src="inc/script.js"></script>
</body>