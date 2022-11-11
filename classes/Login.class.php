<?php

class Login extends Dbh
{

    public function existsLogin($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt->rowCount();
    }

    public function loginUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            $hashedpwd = $result['password'];
        }

        if (!password_verify($pwd, $hashedpwd)) {
            echo "Wrong password";
            die;
        } else {
            $firstname = $result['first_name'];
            $email = $result['email'];
            session_start();
            $_SESSION['logged'] = true;
            header("Location:../index.php");
        }


    }

}