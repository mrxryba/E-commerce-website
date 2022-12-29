<?php

class Wishlist extends Dbh
{

    private int $wishlistID;
    private array $items = [];
    private string $name;

    /**
     * @param $wishlistID
     */
    public function __construct($wishlistID)
    {
        $this->wishlistID = $wishlistID;
        $data = $this->getWishlistData();
        $this->name = (string)$data['wishlist_name'];
        $this->initWishlistItems();
    }

    /**
     * This gets data about Wishlist from Db
     * @return false|mixed
     */
    public function getWishlistData()
    {
        $stmt = $this->connect()->prepare(" SELECT * FROM `wishlist_info` WHERE wishlist_id =?");
        $stmt->execute([$this->wishlistID]);
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
            $stmt->execute([$this->wishlistID]);
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
        } else {
            echo "produkt juz dodany";
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
        $stmt->execute([$product->getId(), $this->wishlistID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            $stmt = $this->connect()->prepare("INSERT INTO wishlist_items VALUES (NULL,?,?)");
            $stmt->execute([$this->wishlistID, $product->getId()]);
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
        $stmt->execute([$product->getId(), $this->wishlistID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            throw new Exception("Wishlist_item doesn't exists in DB");
        } else {
            $stmt = $this->connect()->prepare("DELETE FROM wishlist_items WHERE wishlist_item_id =?");
            $stmt->execute([$results[0]['wishlist_item_id']]);
        }
        $this->initWishlistItems();

    }

    /**
     * This checks if Wishlist contains selected Product
     * @param $productId
     * @return mixed|null
     */
    public function findWishlistItem($productId)
    {
        return $this->items[$productId] ?? null;
    }

    /**
     * @return int
     */
    public function getWishlistID(): int
    {
        return $this->wishlistID;
    }

    /**
     * @param int $wishListID
     */
    public function setWishlistID(int $wishlistID): void
    {
        $this->wishlistID = $wishlistID;
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


}