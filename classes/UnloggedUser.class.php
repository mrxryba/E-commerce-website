<?php

class UnloggedUser extends Dbh
{
    private int $id;
    private string $sessionID;
    private int $savedCartID;
    private string $hashedSessionIdCookie;

    public function __construct($sessionID)
    {  $this->sessionID = $sessionID;
         $data = $this->getUnloggedData();
        $this->id = $data['unlogged_user_id'];
        $this->savedCartID = $data['saved_cart_id'];
    }


    public function getUnloggedData()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM `unlogged_users` INNER JOIN saved_carts ON unlogged_users.session_id = saved_carts.session_id WHERE unlogged_users.session_id =?;");
        $stmt->execute([$this->sessionID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($results);

    }

    public function checkIfSessionExist()
    {

        // grab from cookie sessionID and compare with sessions in db
        // if exists assign it as actual sessionID
        //        if not exists insert into db and create saved cart_id

    }

    /**
     * @return int|mixed|string
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param int|mixed|string $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSessionID(): string
    {
        return $this->sessionID;
    }

    /**
     * @param string $sessionID
     */
    public function setSessionID(string $sessionID): void
    {
        $this->sessionID = $sessionID;
    }

    /**
     * @return int|mixed|string
     */
    public function getSavedCartID(): mixed
    {
        return $this->savedCartID;
    }

    /**
     * @param int|mixed|string $savedCartID
     */
    public function setSavedCartID(mixed $savedCartID): void
    {
        $this->savedCartID = $savedCartID;
    }

    /**
     * @return string
     */
    public function getHashedSessionIdCookie(): string
    {
        return $this->hashedSessionIdCookie;
    }

    /**
     * @param string $hashedSessionIdCookie
     */
    public function setHashedSessionIdCookie(string $hashedSessionIdCookie): void
    {
        $this->hashedSessionIdCookie = $hashedSessionIdCookie;
    }


}

