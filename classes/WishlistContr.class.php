<?php

/**
 *
 */
class WishlistContr extends Dbh
{
    /**
     * This creates Wishlist in DB with inserted wishlistName
     * @param $userId
     * @param $wishlistName
     * @return void
     */
    public function setWishlist($userId, $wishlistName)
    {
        $stmt = $this->connect()->prepare("INSERT INTO wishlists VALUES (NULL,?)");
        $stmt->execute([$userId]);
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists WHERE user_id =? ORDER BY wishlist_id DESC LIMIT 1");
        $stmt->execute([$userId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->connect()->prepare("INSERT INTO wishlist_info VALUES (?,?)");
        $stmt->execute([$results[0]['wishlist_id'], $wishlistName]);

    }

    /**
     * This shows the Wishlists that the user has created
     * @param $userId
     * @return void
     */
    public function showWishlists($userId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists INNER JOIN wishlist_info ON wishlists.wishlist_id = wishlist_info.wishlist_id WHERE user_id =?");
        $stmt->execute([$userId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Twoje wishlisty: " . '<br>';
        foreach ($results as $result) {
        echo "nr id ".$result['wishlist_id']. " " ;
        echo "name: " .$result['wishlist_name']. '<br>';

        }
    }

    /**
     * This deletes selected Wishlist
     * @param $wishlistId
     * @return void
     * @throws Exception
     */
    public function deleteWishlist($wishlistId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists WHERE wishlist_id =?");
        $stmt->execute([$wishlistId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            throw new Exception("Wishlist doesn't exists in DB");
        } else {
            $stmt = $this->connect()->prepare("DELETE FROM wishlists WHERE wishlist_id =?");
            $stmt->execute([$wishlistId]);
        }
    }

}