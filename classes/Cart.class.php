<?php

class Cart extends Dbh
{
    /**
     * @var CartItem[]
     */
    private array $items = [];
    private $savedCartID;


    /**
     * @param $savedCartID
     */
    public function __construct($savedCartID)
    {
        $this->savedCartID = $savedCartID;
        $this->initCartItems();
    }


    /**
     * Checks if the user has added products to his cart which is saved in DB.
     * If the cart contains products, it creates a new CartItem (and Product) and then adds it to the cart.
     * @return void
     */
    public function initCartItems()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM cart_items WHERE saved_cart_id = ?");
        $stmt->execute([$this->savedCartID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            $cartItem = new CartItem(new Product($result['product_id']), $result['quantity']);
            $this->items[$result['product_id']] = $cartItem;
            $cartItem->changeAvailableQuantity();
        }
    }

    /**
     * Adds Product $product into cart as CartItem. If product already exists in the cart it increases quantity of added product.
     * This must create CartItem.
     * @param Product $product
     * @throws Exception
     */
    public function addProduct(Product $product, $qty)
    {
        $cartItem = $this->findCartItem($product->getId());
        if (!$cartItem) {
            $cartItem = new CartItem($product, $qty);
            $this->items[$product->getId()] = $cartItem;
            $cartItem->checkQuantity();
        } else {
            $cartItem->checkQuantity($qty);
        }
        $cartItem->saveCartItem($this->savedCartID, $product, $qty);
        $this->initCartItems();
    }

    /**
     * @throws Exception
     */
    public function changeProductQty(Product $product, $qty) {
        $cartItem = $this->findCartItem($product->getId());
        if (!$cartItem) {
            throw new Exception('Product is not in the cart');
        }else{
            $cartItem->changeQuantity($qty);
        }
        $cartItem->changeCartItem($this->savedCartID, $product, $qty);
        $this->initCartItems();
    }




    /**
     * Remove product from the cart
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function removeProduct(Product $product)
    {
        $cartItem = $this->findCartItem($product->getId());
        $cartItem->removeCartItem($product, $this->getSavedCartID());
        unset($this->items[$product->getId()]);


    }

    public function removeAllProducts()
    {

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

    /**
     * @return mixed
     */
    public function getSavedCartID()
    {
        return $this->savedCartID;
    }

    /**
     * @param mixed $savedCartID
     */
    public function setSavedCartID($savedCartID): void
    {
        $this->savedCartID = $savedCartID;
    }


}