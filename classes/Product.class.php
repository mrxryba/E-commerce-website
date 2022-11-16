<?php

class Product
{

    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    /**
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


    public function addToCart(Cart $cart, /*Product $product,*/ int $quantity)
    {

        return $cart->addProduct($this, $quantity);
//        $items = $cart->getItems();
//        if (array_key_exists($this->getId(), $items)) {
//            $CartItem = $items[$this->getId()];
//            $CartItem->increaseQuantity();
//        } else {
//            $CartItem = new CartItem($product, 0);
//            $items[$this->getId()] = $CartItem;
//            $CartItem->increaseQuantity();
//            $cart->setItems($items);
//        }
    }

    public function removeFromCart(Cart $cart)
    {
        $items = $cart->getItems();
        unset($items[$this->getId()]);
        $cart->setItems($items);
    }


}