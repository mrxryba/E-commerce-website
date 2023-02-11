<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
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
        <a class="ad-container-link" href="#">
            <?php if ($isLogged): ?>

                <h1>Hello <?php echo $user->getFirstname(); ?>!</h1>

            <?php endif; ?>
            <!--            <img class="ad-photo" src="https://unsplash.it/250/150?gravity=center">-->
        </a>
    </div>
    <div class="ad-carousel">
        <a class="ad-carousel-link" href="#">
            <!--                <img class="ad-photo" src="https://unsplash.it/250/150?gravity=center">-->
        </a>
    </div>
</section>

<!--</div>-->


<a href="product.php?product=1">Iphone 14</a> <br>
<a href="product.php?product=2">M2 SSD</a>



<?php

$product2 = new Product(2);
$product1 = new Product(1);

?>
<script src="inc/script.js"></script>
</body>
</html>