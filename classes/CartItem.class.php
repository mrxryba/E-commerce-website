<?php

class CartItem
{
    private Product $product;
    private int $quantity;

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


    public function increaseQuantity()
    {



//        $this->getProduct();
        if (($this->product->getAvailableQuantity() - 1) >= 0) {
            $this->quantity++;
            $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - 1);

        } else {
            echo "Product out of stock";
        }


    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->product->setAvailableQuantity($this->product->getAvailableQuantity() + 1);
        } else {
            echo "Remove product. Product quantity can't be less than zero ";
        }


    }

}