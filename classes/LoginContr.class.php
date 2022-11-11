<?php

class LoginContr extends Login
{
    public function checkLogin($email, $pwd)
    {
        $result = null;
        if ((bool)empty($email) || empty($pwd)) {
            $result = true;
            echo "error fill all blanks";
            die;
        }
        if ((bool)!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
            echo "error enter correct email";
            die;
        }

        if (!$this->existsLogin($email)) {
            $result = true;
            echo "error this email doesn't exists";
            die;
        }

        if ((bool)!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%^&*]{6,20}$/", $pwd)) {
            $result = true;
            echo "Login details are not correct. Please try again";
            die;
        }

        if ($result !== true) {
            $this->loginUser($email, $pwd);
        }

    }
}