<?php
include "autoloader.inc.php";
if (!isset($_POST['submit'])) {
} else {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];


    $signup = new SignupContr();
    $signup->checkUser($fname, $lname, $email, $pwd);
//    echo $signup->userExist($email);


}
