<?php

trait UnloggedCart
{
    public function setUnloggedCart(): void
    {
        $stmt = $this->connect()->prepare("INSERT INTO saved_carts VALUES (NULL,NULL,?)");
        $stmt->execute([$this->getSessionID()]);
    }

}

class Session extends Dbh
{
    use UnloggedCart;

    private string $sessionID;
    private string $hashedCookie;
    private $expiresAt;

    /**
     * This creates cookie "sessionID" with expire date set for month
     * @return void
     */
    public function setSessionID()
    {
        if (!isset($_COOKIE['sessionID'])) {
            setcookie("sessionID", session_id(), time() + 60 * 60 * 24 * 30);
            $this->sessionID = session_id();
        } else {
            $this->sessionID = $_COOKIE['sessionID'];
            setcookie("sessionID", $_COOKIE['sessionID'], time() + 60 * 60 * 24 * 30);

        }
        $this->expiresAt = date(('Y-m-d H:i:s'), time() + 60 * 60 * 24 * 30);


    }


    /**
     * @return void
     */
    public function checkSessionID()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM unlogged_users WHERE session_id =?");
        $stmt->execute([$this->sessionID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            $stmt = $this->connect()->prepare("INSERT INTO unlogged_users VALUES (NULL,?,NULL,?)");
            $stmt->execute([$this->sessionID, $this->expiresAt]);
            $this->setUnloggedCart();
        }
    }

    /**
     * @return string
     */
    public function getSessionID(): string
    {
        return $this->sessionID;
    }

    /**
     * @return string
     */
    public function getHashedCookie(): string
    {
        return $this->hashedCookie;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param mixed $expiresAt
     */
    public function setExpiresAt($expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }


}