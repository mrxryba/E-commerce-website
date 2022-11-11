<?php

class Cart
{

    private $items = [];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }



public function addToCart (Product $product, int $quantity) {


}

}