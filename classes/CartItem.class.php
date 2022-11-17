<?php

class CartItem
{
    private Product $product;
    private int $quantity;

    /**
     * CartItem constructor
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     *
     * @return \Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Returns quantity of CartItem
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


    /**
     * This increases quantity of CartItem which has been added to the cart and decreases quantity of available Product
     * @return void
     * @throws Exception
     */
    public function increaseQuantity()
    {

        if (!$this->product->getAvailableQuantity()) {
            throw new Exception("Product out of stock");
        }
        $this->quantity++;
        $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - 1);
    }


    /**
     * This decreases quantity of CartItem which has been added to the cart and increases quantity of available Product
     * @return void
     * @throws Exception
     */
    public function decreaseQuantity()
    {
        if ($this->quantity === 1) {
            throw new Exception ("Remove product. Product quantity can't be less than one ");
        }
        $this->quantity--;
        $this->product->setAvailableQuantity($this->product->getAvailableQuantity() + 1);
    }

}