<?php

class SignupContr extends Signup
{

    public function checkUser($fname, $lname, $email, $pwd)
    {
        $result = null;
        if ((bool)empty($fname) || empty($lname) || empty($email) || empty($pwd)) {
            $result = true;
            echo "error fill all blanks";
            die;
        }
        if ((bool)!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
            echo "error enter correct email";
            die;
        }
        if ((bool)!preg_match("/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ-]{2,30}$/", $fname)) {
            $result = true;
            echo "error First name must have 2 to 30 characters, letters only";
            die;
        }
        if ((bool)!preg_match("/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ-]{2,30}$/", $lname)) {
            $result = true;
            echo "error Last name must have 2 to 30 characters, letters only";
            die;
        }
        if ((bool)!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%^&*]{6,20}$/", $pwd)) {
            $result = true;
            echo "Password is too short, has to contain from 6 to 20 chars, at least one number, one letter";
            die;
        }

        if ($this->emailExist($email)) {
            $result = true;
            echo "error this email already exists";
            die;
        }

        if ($result !== true) {
            echo "user created";
            $this->setUser($fname, $lname, $email, $pwd);
        }
    }

}