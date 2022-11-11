<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
//$user = new UserContr();
//$isLogged = $user->isAuthenticated();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="inc/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<?php //if (!$isLogged): ?>
<!--<section>Signup-->
<!--    <form action="inc/signup.php" method="post">-->
<!--        <label for="fname">First name:</label>-->
<!--        <input type="text" name="fname" placeholder="First name">-->
<!--        <label for="lname">Last name:</label>-->
<!--        <input type="text" name="lname" placeholder="Last name">-->
<!--        <label for="email">Email:</label>-->
<!--        <input type="text" name="email" placeholder="Email">-->
<!--        <label for="pwd">Password:</label>-->
<!--        <input type="text" name="pwd" placeholder="Password">-->
<!--        --><?php //if (!$isLogged): ?>
<!--        <button type="submit" name="submit">Submit</button>-->
<!--        --><?php //endif; ?>
<!---->
<!---->
<!--</section>-->
<?php //endif; ?>
<?php //if ($isLogged): ?>
<!--    <a href="inc/logout.php">Log out</a>-->
<?php //endif; ?>
<?php //if ($isLogged): ?>
<!--    <a href="inc/user.php">Settings</a>-->
<?php //endif; ?>
<!--</form>-->
<!---->
<?php //if (!$isLogged): ?>
<!--<section>Login-->
<!---->
<!--    <form action="inc/login.php" method="post">-->
<!--        <label for="email">Email:</label>-->
<!--        <input type="text" name="email" placeholder="Email">-->
<!--        <label for="pwd">Password:</label>-->
<!--        <input type="text" name="pwd" placeholder="Password">-->
<!--        --><?php //if (!$isLogged): ?>
<!--        <button type="submit" name="submit">Submit</button>-->
<!--        --><?php //endif; ?>
<!--    </form>-->
<!--</section>-->
<?php //endif; ?>
<!---->
<!--<main>-->
<!--<div class="gallery">-->
<!--    <div class="content">-->
<!--        <img src="./images/iphone14pro256.jpg" alt="phone">-->
<!--        <h3>Apple iPhone 14 Pro 256GB</h3>-->
<!--        <p>Apple iPhone 14 Pro to smartfon, który spełni oczekiwania nawet najbardziej wymagających użytkowników. Procesor A16 Bionic zapewnia mu niezachwiane działanie nawet przy zaawansowanych operacjach, a solidna bateria pozwala na cały dzień zapomnieć o konieczności ładowania telefonu.</p>-->
<!--        <h5>7749zł</h5>-->
<!--        <ul>-->
<!--            <li><i class="fa fa-star checked"></i></li>-->
<!--            <li><i class="fa fa-star checked"></i></li>-->
<!--            <li><i class="fa fa-star checked"></i></li>-->
<!--            <li><i class="fa fa-star checked"></i></li>-->
<!--            <li><i class="fa fa-star "></i></li>-->
<!--        </ul>-->
<!--        <button class="buy-1">Buy Now</button>-->
<!--    </div>-->


<!--</div>-->
<!--</main>-->
</body>
<?php

$product1 = new Product(1,"Iphone 11", 2500,10);
$cart = new Cart();

?>
</html>