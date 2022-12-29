<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "phpHeader.php";
include_once "header.php";

?>

<!--<div class="wrapper">-->
    <div class="categories">
        <section class="category-section">
            <a href="#" class="category">Category 1</a>
            <a href="#" class="category">Category 2</a>
            <a href="" class="category">Category 3</a>
            <a href="" class="category">Category 4</a>
            <a href="" class="category">Category 5</a>
            <a href="" class="category">Category 6</a>
            <a href="" class="category">Category 7</a>
            <a href="" class="category">Category 8</a>
            <a href="" class="category">Category 9</a>
            <a href="" class="category">Category 10</a>
        </section>
    </div>
<section class="main">
    <div class="ad-container">
        <a class="ad-container-link" href="#" >
<!--            <img class="ad-photo" src="https://unsplash.it/250/150?gravity=center">-->
        </a>
    </div>
    <div class="ad-carousel">
        <a class="ad-carousel-link" href="#" >
            <!--                <img class="ad-photo" src="https://unsplash.it/250/150?gravity=center">-->
        </a>
    </div>
</section>

<!--</div>-->


<?php if ($isLogged): ?>

    <h1>Hello <?php echo $user->getFirstname(); ?>!</h1>

    <section>Product 1 - Iphone 11</section>
    <button type="button" onclick="addProduct()" name="button1">Add to Cart</button>
    <section>Product 2 - M2 SSD</section>
    <button type="button" onclick="addProduct()" name="button2">Add to Cart</button>
    <section>Product 3 - Samsung Galaxy S20</section>
    <button type="button" onclick="addProduct()" name="button3">Add to Cart</button>


<?php endif; ?>

<?php

$product2 = new Product(2);
$product1 = new Product(1);


?>
<script src="inc/script.js"></script>
</body>
</html>