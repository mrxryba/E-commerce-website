<?php


class CurrentUser
{

    private int $id = 0;

    /**
     * @param int $id
     */
    public function __construct()
    {
        if (!session_status()) {
            session_start();
        }
        $this->id = $_SESSION['userId'] ?? 0;
    }

    /**
     * This checks if the id is assigned, and if yes it returns the new user, if not it returns NULL.
     * @return User|null
     */
    public function getUser()
    {
        return ($this->id) ? new User ($this->id) : null;
    }

    public function getUnloggedUser()
    {

    }

    /**
     * This checks if id is assigned and returns whether User is logged in or not.
     * @return bool
     */
    public function isAuthenticated()
    {
        return (bool)$this->id;
    }

    /**
     * This checks if user is Admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->id === 5;

    }
}