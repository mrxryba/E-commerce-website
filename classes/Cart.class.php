<?php

class Cart
{
    private $items = [];

    public function addProduct(Product $product, int $quantity)
    {
        if (array_key_exists($product->getId(), $this->items)) {
            $CartItem = $this->findCartItem($product->getId());
            $CartItem->increaseQuantity();

        } else {
            $CartItem = new CartItem($product, 0);
            $this->items[$product->getId()] = $CartItem;
            $CartItem->increaseQuantity();
        }
        return $CartItem;


    }

    public function CartItemDecreaseQ($product)
    {
        $CartItem1 = $this->findCartItem($product->getId());
//        var_dump($CartItem1);
        $CartItem1->decreaseQuantity();
    }

    public function CartItemIncrease($product)
    {
        $CartItem1 = $this->findCartItem($product->getId());
//        var_dump($CartItem1);
        $CartItem1->increaseQuantity();
    }


    public
    function removeProduct(Product $product)
    {
        unset($this->items[$product->getId()]);
    }

    private
    function findCartItem(int $productId)
    {
        return $this->items[$productId] ?? null;
    }

    public
    function getTotalQuantity()
    {
        $Total = 0;
        foreach ($this->items as $key => $item) {
            var_dump( $CartItem = $item);
            $Total += $CartItem->getQuantity();
        }
        echo $Total;
    }

    public
    function getTotalSum(): float
    {
        $Total = 0;
        foreach ($this->items as $key => $item) {
            $CartItem = $item;
            $Total += $CartItem->getQuantity() * $CartItem->getProduct()->getPrice();
        }
        return $Total;
    }


    /**
     * @return array
     */
    public
    function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public
    function setItems(array $items): void
    {
        $this->items = $items;
    }


}