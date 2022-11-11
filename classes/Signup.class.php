<?php

class Signup extends Dbh
{

    protected function setUser($fname, $lname, $email, $pwd)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users VALUES (NULL,?,?,?,?,NULL,NULL)");
        $hashPwd = password_hash($pwd,PASSWORD_DEFAULT);
        $stmt->execute([$fname, $lname, $email, $hashPwd]);

    }


    protected function emailExist($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt->rowCount();
    }

}