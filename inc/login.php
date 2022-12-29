<?php
include "autoloader.inc.php";
if (!isset($_POST['submit'])) {
}else{
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];



    $login = new LoginContr();
    $login->checkLogin($email, $pwd);
}








