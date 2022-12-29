<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="inc/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <title>E-commerce</title>
</head>
<body>
<!--Header-->
<header class="header">
    <nav>
        <ul class="menu">
            <li class="logo"><a href="index.php">Shopi</a></li>
            <div class="icons"  <?php if ($isAdmin): ?> id="icons-admin" <?php endif; ?>>
                <li class="home icon"><a href="./managePage.php"><i class='bx bx-home'></i></a></li>
                <li class="user icon"><a href="#"><i class='bx bx-user'></i></a></li>
                <li class="wishlist icon"><a href="#"><i class='bx bx-heart'></i></a></li>
                <div class="userItem userBreak ">
                    <?php if (!$isLogged): ?>
                        <li class="userItem login"><a href="login.php">Log in</a></li>
                        <li class="userItem signup"><a href="signup.php">Sign up</a></li>
                    <?php endif; ?>
                    <li class="userItem wishlist"><a href="#"><i class='bx bx-heart'><span>Wishlist</span></i></a></li>
                    <?php if ($isLogged): ?>
                        <li class="userItem signup"><a href="./inc/settings.php">Settings</a></li>
                    <?php endif; ?>
                    <?php if ($isLogged): ?>
                        <li class="userItem signup"><a href="./inc/logout.php">Log out</a></li>
                    <?php endif; ?>

                </div>
                <li class="cart icon"><a href="cart.php"><i class='bx bx-cart'></i><span class="icon-zero"><?php
                            echo $cart->getTotalQuantity();
                            ?></span></a></li>
                <li class="toggle icon"><a href="#"><i class='bx bx-menu'></i></a></li>
            </div>
            <li class="item has-submenu ">
                <a tabindex="0" class="">Hair</a>
                <ul class="submenu">
                    <li class="subitem"><a href="#">Pomades</a></li>
                    <li class="subitem"><a href="#">Prestylers</a></li>
                    <li class="subitem"><a href="#">Shampoo</a></li>
                    <li class="subitem"><a href="#">Conditioners</a></li>
                </ul>
            </li>
            <li class="item"><a href="#">Beard</a></li>
            <li class="item"><a href="#">Shaving</a></li>
            <li class="item"><a href="#">Body</a></li>
            <li class="item"><a href="#">Accessories</a></li>
            <li class="item"><a href="#">Brands</a></li>

            <form class="search-bar">
                <input type="search" class="search-input" placeholder="Search for anything"/>
                <button class="search-btn"><i class='bx bx-search'></i></button>
            </form>
        </ul>
    </nav>
</header>
