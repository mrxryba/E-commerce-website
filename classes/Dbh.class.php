<?php

class Dbh
{

    public function connect()
    {
        $pdo = new PDO('mysql:host=mysql;dbname=hairshop;', "root", "root");
        return $pdo;
    }
}