<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
$user = new UserContr();
$isLogged = $user->isAuthenticated();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="inc/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Document</title>
</head>
<body>
<?php if (!$isLogged): ?>
<section>Signup
    <form action="inc/signup.php" method="post">
        <label for="fname">First name:</label>
        <input type="text" name="fname" placeholder="First name">
        <label for="lname">Last name:</label>
        <input type="text" name="lname" placeholder="Last name">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Email">
        <label for="pwd">Password:</label>
        <input type="text" name="pwd" placeholder="Password">
        <?php if (!$isLogged): ?>
        <button type="submit" name="submit">Submit</button>
        <?php endif; ?>


</section>
<?php endif; ?>
<?php if ($isLogged): ?>
    <a href="inc/logout.php">Log out</a>
<?php endif; ?>
<?php if ($isLogged): ?>
    <a href="inc/user.php">Settings</a>
<?php endif; ?>
</form>

<?php if (!$isLogged): ?>
<section>Login

    <form action="inc/login.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Email">
        <label for="pwd">Password:</label>
        <input type="text" name="pwd" placeholder="Password">
        <?php if (!$isLogged): ?>
        <button type="submit" name="submit">Submit</button>
        <?php endif; ?>
    </form>
</section>
<?php endif; ?>

</body>
<?php

$product1 = new Product(5, "Iphone 11", 2500, 10);
$product2 = new Product(2, "M2 SSD", 400, 10);
$product3 = new Product(3, "Samsung Galaxy S20", 3200, 10);

$cart = new Cart();

$cartItem1 = $cart->addProduct($product3);
$cartItem2 = $product2->addToCart($cart);

try {
    $cartItem2->increaseQuantity();
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    var_dump($cart->getItems());
} catch (Exception $e) {
    echo $e->getMessage();
}


?>
</html>