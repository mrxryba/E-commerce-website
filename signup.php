<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "phpHeader.php";
include_once "header.php";
?>

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

<script src="inc/script.js"></script></body>
</body>


