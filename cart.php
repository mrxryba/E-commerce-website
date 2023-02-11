<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
include_once "phpHeader.php";
include_once "header.php";
?>

<body>
<div class="cart-container">
    <h1 class="cart-heading">Cart <span>(</span><span
                id="cart-heading-qty"><?php echo $cart->getTotalQuantity(); ?></span><span>)</span></h1>
    <div class="cart-operations">

        <a class="cart-operations-link">
            <label class="modal-open modal-label" for="modal-open3">

                <span class="material-symbols-outlined">favorite</span><span
                        class="cart-operations-text"><span>Save as Wishlist</span></span></a>
        </label>
        <input type="radio" name="modal" value="open" id="modal-open3" class="modal-radio"/>
        <div class="modal modal3">
            <label class="modal-label overlay">
                <input type="radio" name="modal" value="close" class="modal-radio"/>
            </label>
            <div class="content">
                <div class="top">
                    <h2>Add new Wishlist</h2>
                    <label class="modal-label close-btn">
                        <input type="radio" name="modal" value="close" class="modal-radio"/>
                    </label>
                </div>
                <h3>Save the cart as a Wishlist</h3>
                <p>Products in the shopping cart will be saved as a Wishlist</p>
                <form action="inc/saveCartasWishlist.php" method="post">
                    <input type="text" name="wishlistName" placeholder="Name of list">
                    <input type="submit" value="Add Wishlist">
                </form>
            </div>
        </div>
        <a class="cart-operations-link" id="removeAllCartItems"> <span
                    class="material-symbols-outlined">delete</span><span
                    class="cart-operations-text">Remove the cart </span></a>
    </div>

    <?php
    $products = $cart->getItems();
    $jsonArray = array();
    foreach ($products as $cartItem) {

        $productArray = array("productId" => $cartItem->getProduct()->getId(),
            "productQty" => $cartItem->getQuantity());
        $jsonArray[] = $productArray;
        ?>
        <div class="cart-item">
            <div class="cart-item-photo"><img class="thumbnail" src="<?php echo $cartItem->getProduct()->getImage(); ?>"
                                              alt=""></div>
            <div class="cart-item-info">
                <div class="item-title-qty">
                    <div class="cart-item-title"><?php echo $cartItem->getProduct()->getTitle(); ?> </div>
                    <button class="remove-from-cart-link">
                        <span class="material-symbols-outlined">delete</span></button>
                </div>
                <div class="item-btn-price">
                    <div class="product-qty-section">
                        <select data-value="<? echo $cartItem->getProduct()->getId() ?>" class="product-qty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9+">9+</option>
                        </select>
                    </div>
                    <div class="cart-item-price"><?php echo $cartItem->getProduct()->getPrice(); ?> zł</div>
                </div>
            </div>
        </div>
        <?php
    }
    $jsonArray = json_encode($jsonArray);
    ?>
    <div class="cart-promo-code">
        <p>Do you have a promo code?</p>
        <form class="promo-code-form">
            <input class="promo-code-input" type="text"/>
            <button class="promo-code-btn" type="submit">Activate</button>
        </form>

    </div>
    <div class="cart-summary">
        <span>Total price</span>
        <span id="cart-total"><?php echo $cart->getTotalSum(); ?><span> zł</span> </span>

        <button class="cart-summary-btn">Go to delivery</button>
    </div>
    <div class="our-partners">
        <span>Info about what payment methods we accept</span>
        <button class="our-partners-btn">Back to shopping</button>
    </div>
    <script type="text/javascript">
        let cartItems = <?php echo $jsonArray?>;
        let cartItemSections = document.querySelectorAll('.product-qty');
    </script>
    <script src="inc/cart.js"></script>
</body>
</html>