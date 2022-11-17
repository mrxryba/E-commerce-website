<?php

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];


    /**
     * Adds Product $product into cart. If product already exists in the cart it increases quantity of added product.
     * This must create CartItem and return CartItem from method
     * @param Product $product
     * @return CartItem|null
     * @throws Exception
     */
    public function addProduct(Product $product)
    {
        $cartItem = $this->findCartItem($product->getId());
        if (!$cartItem) {
            $cartItem = new CartItem($product, 0);
            $this->items[$product->getId()] = $cartItem;
        }
        $cartItem->increaseQuantity();
        return $cartItem;
    }

    /**
     * Remove product from the cart
     * @param Product $product
     * @return void
     */
    public function removeProduct(Product $product)
    {
        unset($this->items[$product->getId()]);
        return;
    }

    /**
     * This checks if product is added to the cart
     * @param int $productId
     * @return CartItem|null
     */
    private function findCartItem(int $productId)
    {
        return $this->items[$productId] ?? null;
    }

    /**
     * This returns total number of products added to the cart
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $total = 0;
        foreach ($this->items as $key => $item) {
            $cartItem = $item;
            $total += $cartItem->getQuantity();
        }
        return $total;

    }

    /**
     * This returns total price of products added to the cart
     * @return float
     */
    public function getTotalSum(): float
    {
        $total = 0;
        foreach ($this->items as $key => $item) {
            $cartItem = $item;
            $total += $cartItem->getQuantity() * $cartItem->getProduct()->getPrice();
        }
        return $total;
    }


    /**
     * @return  \CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     *
     * @param \CartItem[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }


}