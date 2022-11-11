<?php

class UserContr extends User
{
    public function isAuthenticated()
    {
        return $_SESSION['logged'] ?? false;
    }
}
