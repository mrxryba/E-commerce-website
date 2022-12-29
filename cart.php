<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "phpHeader.php";
include_once "header.php";
?>

<body>
<div class="cart-container">
    <h1 class="cart-heading">Cart <span>(<?php echo $cart->getTotalQuantity(); ?>)</span></h1>
    <div class="cart-operations">
        <a class="cart-operations-link" href="#"> <span class="material-symbols-outlined">favorite</span><span class="cart-operations-text">Save</span></a>
        <a class="cart-operations-link" href="#"> <span class="material-symbols-outlined">delete</span><span class="cart-operations-text">Remove the basket </span></a>
    </div>

    <?php
    $products = $cart->getItems();
    foreach ($products as $cartItem) {

        ?>
        <div class="cart-item">
            <div class="cart-item-photo"><img class="thumbnail" src="<?php echo $cartItem->getProduct()->getImage(); ?>"
                                              alt=""></div>
            <div class="cart-item-info">
                <div class="item-title-qty">
                    <div class="cart-item-title"><?php echo $cartItem->getProduct()->getTitle(); ?> </div>
                    <span class="material-symbols-outlined">delete</span>
                </div>
                <div class="item-btn-price">
                    <form action="">
                        <select name="qty" id="product-qty">
                            <option value="<?php echo $cartItem->getQuantity();?>" hidden><?php echo $cartItem->getQuantity();?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9+</option>
                        </select>
                    </form>
<!--                    <div class="cart-item-qty">--><?php //echo $cartItem->getQuantity(); ?><!-- szt</div>-->
                    <div class="cart-item-price"><?php echo $cartItem->getProduct()->getPrice(); ?> zł</div>
                </div>
            </div>

            <!--            <button id="removeFromCart">Remove</button>-->
        </div>
        <?php
    }
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
        <span><?php
            echo $cart->getTotalSum();
            ?>zł</span>
        <button class="cart-summary-btn">Go to delivery</button>
    </div>
    <div class="our-partners">
        <span>Info about what payment methods we accept</span>
        <button class="our-partners-btn">Back to shopping</button>
    </div>
    <!--    <div class="cartTotalContainer">-->
    <!---->
    <!--        <div class="cartItemQty">Items(number)</div>-->
    <!--        <div class="cartItemPrice">Price</div>-->
    <!--        <div class="cartShipping">Shipping</div>-->
    <!--        <div class="cartTotal"><span>Total</span>-->
    <!--        <div class="cartTotalPrice">Price</div>-->
    <!--        </div>-->
    <!---->
    <!---->
    <!--        <button>Go to checkout</button>-->
    <!--    </div>-->
    <!--</div>-->


    <script src="inc/script.js"></script>
</body>
</html>