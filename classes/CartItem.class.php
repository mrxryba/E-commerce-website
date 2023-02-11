<?php

class CartItem extends Dbh
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
     * This checks if product exists in user's saved Cart in DB.
     * If not exists it creates new row with a product added to the Cart.
     * If exists it updates the row with a new quantity of added product.
     * @param $savedCartID
     * @param $product
     * @param $quantity
     * @return void
     */
    public function saveCartItem($savedCartID, $product, $quantity)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM cart_items WHERE product_id = ? AND saved_cart_id =?");
        $stmt->execute([$product->getId(), $savedCartID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            $stmt = $this->connect()->prepare("INSERT INTO cart_items VALUES (NULL,?,?,?)");
            $stmt->execute([$savedCartID, $product->getId(), $quantity]);
        } else {
            $savedCartQuantity = $results[0]['quantity'];
            $quantity += $savedCartQuantity;
            $stmt = $this->connect()->prepare("UPDATE cart_items SET quantity = ? WHERE saved_cart_id =? AND product_id =?");
            $stmt->execute([$quantity, $savedCartID, $product->getId()]);
        }
    }

    public function changeCartItem($savedCartID, $product, $quantity)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM cart_items WHERE product_id = ? AND saved_cart_id =?");
        $stmt->execute([$product->getId(), $savedCartID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            $stmt = $this->connect()->prepare("INSERT INTO cart_items VALUES (NULL,?,?,?)");
            $stmt->execute([$savedCartID, $product->getId(), $quantity]);
        } else {
            $stmt = $this->connect()->prepare("UPDATE cart_items SET quantity = ? WHERE saved_cart_id =? AND product_id =?");
            $stmt->execute([$quantity, $savedCartID, $product->getId()]);
        }
    }


    /**
     * Checks if CartItem exists in user's saved Cart in DB.
     * If exists it deletes this CartItem.
     * If not exists it throws an Exception.
     * @param Product $product
     * @param $savedCartID
     * @return void
     * @throws Exception
     */
    public function removeCartItem(Product $product, $savedCartID)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM cart_items WHERE product_id = ? AND saved_cart_id =?");
        $stmt->execute([$product->getId(), $savedCartID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            throw new Exception("Product doesn't exists in DB");
        } else {
            $stmt = $this->connect()->prepare("DELETE FROM cart_items  WHERE cart_item_id =?");
            $stmt->execute([$results[0]['cart_item_id']]);
        }
    }


    /**
     * Changes the AvailableQuantity of product that user can add to the Cart.
     * Decreases the AvailableQuantity of product by the quantity of product added to the cart.
     * @return void
     */
    public function changeAvailableQuantity()
    {
        $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - $this->quantity);
    }

    /**
     * Checks if the quantity has been set then
     * checks if product is available,
     * checks if that amount of product quantity is available.
     * Next it decreases the AvailableQuantity of product by the quantity of product added to the cart.
     * @param $qty
     * @return void
     * @throws Exception
     */
    public function checkQuantity($qty = 0)
    {
        if (!$qty) {
            if (!$this->product->getAvailableQuantity()) {
                throw new Exception("Product out of stock");
            }
            if ($this->quantity > $this->product->getAvailableQuantity()) {
                throw new Exception ("Sorry there is not enough amount of product in stock. Available quantity is " . $this->product->getAvailableQuantity() . " pieces");
            }
            $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - $this->quantity);
        }
        if ($qty) {
            if (!$this->product->getAvailableQuantity()) {
                throw new Exception("Product out of stock");
            }
            if ($qty > $this->product->getAvailableQuantity()) {
                throw new Exception ("Sorry there is not enough amount of product in stock. Available quantity is " . $this->product->getAvailableQuantity() . " pieces");
            }
            $this->quantity += $qty;
//            $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - $this->quantity);
        }
    }

    public function changeQuantity($qty)
    {
//        if ($qty) {
//            if (!$this->product->getAvailableQuantity()) {
//                throw new Exception("Product out of stock");
//            }
//            if ($qty > $this->product->getAvailableQuantity()) {
//                throw new Exception ("Sorry there is not enough amount of product in stock. Available quantity is " . $this->product->getAvailableQuantity() . " pieces");
//            }
            $this->quantity = $qty;
//            $this->product->setAvailableQuantity($this->product->getAvailableQuantity() - $this->quantity);
//        }
    }


    /**
     * This decreases quantity of CartItem which has been added to the cart and increases quantity of available Product
     * @return void
     * @throws Exception
     */
    public
    function decreaseQuantity()
    {
        if ($this->quantity === 1) {
            throw new Exception ("Remove product. Product quantity can't be less than one ");
        }
        $this->quantity--;
        $this->product->setAvailableQuantity($this->product->getAvailableQuantity() + 1);
    }

}