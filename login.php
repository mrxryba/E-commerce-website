<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "phpHeader.php";
include_once "header.php";
?>


<body>

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

<script src="inc/script.js"></script>
</body>

