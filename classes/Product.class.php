<?php

class Product
{

    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    /**
     * Product constructor
     * @param int $id
     * @param string $title
     * @param float $price
     * @param int $availableQuantity
     */
    public function __construct(int $id, string $title, float $price, int $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
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
     * @return string Product title
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
     * Adds Product $product into cart. If product already exists in the cart it increases quantity of added product.
     * This must create CartItem and return CartItem from method
     * @param Cart $cart
     * @return CartItem|null
     * @throws Exception
     */
    public function addToCart(Cart $cart)
    {
        return $cart->addProduct($this);

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