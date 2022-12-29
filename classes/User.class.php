<?php

class User extends Dbh
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $username;
    private string $email;
    private string $pwd;
    private $wishlistID;
    private int $savedCartID;


    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $data = $this->getUserData();
        $this->email = (string)$data['email'];
        $this->firstname = (string)$data['first_name'];
        $this->lastname = (string)$data['last_name'];
        $this->username = (string)$data['username'];
        $this->savedCartID = (int)$data['saved_cart_id'];
        $this->wishlistID = (int)$data['wishlist_id'];
    }

    /**
     * Returns array with User data form DB.
     * @return false|mixed
     */
    public function getUserData()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM `users` INNER JOIN saved_carts ON users.user_id = saved_carts.user_id LEFT JOIN wishlists ON users.user_id = wishlists.user_id WHERE users.user_id =?;");
        $stmt->execute([$this->id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($results);

    }


    /**
     * Returns user's saved Cart in DB.
     * @return Cart
     */
    public function getCart()
    {
        return new Cart($this->savedCartID);
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = $pwd;
    }

    /**
     * @return int
     */
    public function getWishlistID(): int
    {
        return $this->wishlistID;
    }

    /**
     * @param int $wishlistID
     */
    public function setWishlistID(int $wishlistID): void
    {
        $this->wishlistID = $wishlistID;
    }


    /**
     * @return int|string
     */
    public function getSavedCartID(): int|string
    {
        return $this->savedCartID;
    }

    /**
     * @param int|string $savedCartID
     */
    public function setSavedCartID(int|string $savedCartID): void
    {
        $this->savedCartID = $savedCartID;
    }


}