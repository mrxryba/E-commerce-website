<?php

class Wishlist extends Dbh
{

    private int $wishlistId;
    private array $items = [];
    private string $name;
    private string $wishlistNumber;

    /**
     * @param $wishlistID
     */
    public function __construct($wishlistID)
    {
        $this->wishlistId = $wishlistID;
        $data = $this->getWishlistData();
        $this->name = (string)$data['wishlist_name'];
        $this->wishlistNumber = (string)$data['wishlist_number'];
        $this->initWishlistItems();
    }

    /**
     * This gets data about Wishlist from Db
     * @return false|mixed
     */
    public function getWishlistData()
    {
        $stmt = $this->connect()->prepare("SELECT wishlist_info.*, wishlists.wishlist_number FROM wishlist_info LEFT JOIN wishlists ON wishlist_info.`wishlist_id` = wishlists.`wishlist_id` WHERE wishlist_info.`wishlist_id` = ?");
        $stmt->execute([$this->wishlistId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($results);
    }

    /**
     * This checks if Wishlist contain products
     * If the Wishlist contains products, it creates a new Product and then adds it to the array $items.
     * @return void
     */
    public function initWishlistItems()
    {
        {
            $stmt = $this->connect()->prepare("SELECT * FROM wishlist_items WHERE wishlist_id = ?");
            $stmt->execute([$this->wishlistId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                $WishlistItem = new Product($result['product_id']);

                $this->items[$result['product_id']] = $WishlistItem;
            }
        }
    }


    /**
     * This adds selected product into the Wishlist
     * @param Product $product
     * @return void
     */
    public function addProductToWishlist(Product $product)
    {
        $WishlistItem = $this->findWishlistItem($product->getId());
        if (!$WishlistItem) {
            $this->items[$product->getId()] = $product;
        }else{
            return;
        }
        $this->saveWishList($product);
        $this->initWishlistItems();
    }

    /**
     * This saves Wishlist with it's Product into DB
     * @param Product $product
     * @return void
     */
    public function saveWishList(Product $product)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlist_items WHERE product_id = ? AND wishlist_id =?");
        $stmt->execute([$product->getId(), $this->wishlistId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            $stmt = $this->connect()->prepare("INSERT INTO wishlist_items VALUES (NULL,?,?)");
            $stmt->execute([$this->wishlistId, $product->getId()]);
        }
    }

    /**
     * This removes selected Product from the Wishlist in DB
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function removeProductFromWishlist(Product $product)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlist_items WHERE product_id = ? AND wishlist_id =?");
        $stmt->execute([$product->getId(), $this->wishlistId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            throw new Exception("Wishlist_item doesn't exists in DB");
        } else {
            $stmt = $this->connect()->prepare("DELETE FROM wishlist_items WHERE wishlist_item_id =?");
            $stmt->execute([$results[0]['wishlist_item_id']]);
        }
        unset($this->items[$product->getId()]);
        $this->initWishlistItems();

    }

    /**
     * This checks if Wishlist contains selected Product
     * @param $productId
     * @return mixed|null
     */
    public function findWishlistItem($productId)
    {
        return $this->items[$productId] ?? false;
    }

    /**
     * This returns total price of products added to the Wishlist
     * @return float
     */
    public function getTotalSum(): float
    {
        $total = 0;
        foreach ($this->items as $key => $item) {
            $product = $item;
            $total += $product->getPrice();
        }
        return $total;
    }

    public function getTotalProducts() :int {
        $total = 0;
        foreach ($this->getItems() as $item){
            $total += 1;
        }
        return $total;
    }
    /**
     * @return int
     */
    public function getWishlistId(): int
    {
        return $this->wishlistId;
    }

    /**
     * @param int $wishListId
     */
    public function setWishlistId(int $wishlistID): void
    {
        $this->wishlistId = $wishlistID;
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


    /**
     * @return string
     */
    public
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public
    function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getWishlistNumber(): string
    {
        return $this->wishlistNumber;
    }

    /**
     * @param string $wishlistNumber
     */
    public function setWishlistNumber(string $wishlistNumber): void
    {
        $this->wishlistNumber = $wishlistNumber;
    }


}