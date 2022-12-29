<?php

class Product extends Dbh
{

    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;
    private string $image;

    /**
     * Product constructor
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $data = $this->getProductData();
        $this->title = $data['name'];
        $this->price = $data['price'];
        $this->availableQuantity = $data['quantity'];
        $this->image = $data['image'];
    }


    /**
     * Returns array with Product data form DB.
     * @return false|mixed
     */
    public function getProductData()
    {
        $stmt = $this->connect()->prepare(" SELECT * FROM `products` WHERE product_id =?");
        $stmt->execute([$this->id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($results);
    }


    /**
     * @return int ID of Product
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    /**
     * @param int $availableQuantity
     */
    public function setAvailableQuantity(int $availableQuantity): void
    {
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * @return mixed|string
     */
    public function getImage(): mixed
    {
        return $this->image;
    }

    /**
     * @param mixed|string $image
     */
    public function setImage(mixed $image): void
    {
        $this->image = $image;
    }



    /**
     *  Adds Product $product into cart. If product already exists in the cart it increases quantity of added product.
     * This must create CartItem
     * @param Cart $cart
     * @param $qty
     * @return void
     * @throws Exception
     */
    public function addToCart(Cart $cart, $qty)
    {
        return $cart->addProduct($this, $qty);

    }

    /**
     * Remove product from the cart
     * @param Cart $cart
     * @return void
     */
    public function removeFromCart(Cart $cart)
    {
        $items = $cart->getItems();
        unset($items[$this->getId()]);
        $cart->setItems($items);
        return;
    }


}