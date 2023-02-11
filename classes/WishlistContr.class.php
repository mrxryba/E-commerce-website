<?php

class WishlistContr extends Dbh
{
    use Whitespace;
    use HtmlEntitiesConvert;

    /**
     * This shows the Wishlist that the user has created
     * @param $userId
     * @return array|false
     */
    public function getWishlist($userId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists JOIN wishlist_info ON wishlists.wishlist_id = wishlist_info.wishlist_id WHERE user_id =?");
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getWishlistByNumber($wishlistNumber)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists JOIN wishlist_info ON wishlists.wishlist_id = wishlist_info.wishlist_id WHERE wishlist_number =?");
        $stmt->execute([$wishlistNumber]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($result);
    }

    public function getWishlistById($wishlistId){
        $stmt = $this->connect()->prepare("SELECT * FROM wishlists JOIN wishlist_info ON wishlists.wishlist_id = wishlist_info.wishlist_id WHERE wishlists.wishlist_id =?");
        $stmt->execute([$wishlistId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($result);

    }
    /**
     * This creates Wishlist in DB with inserted wishlistName
     * @param $userId
     * @param $wishlistName
     * @return string|void
     */
    public function createWishlist($userId, string $wishlistName)
    {
        $wishlistNumber = $this->createWishlistNumber();
        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO wishlists VALUES (NULL,?,?)");
        $stmt->execute([$userId, $wishlistNumber]);
        $wishlistId = $db->lastInsertId();
        $stmt = $this->connect()->prepare("INSERT INTO wishlist_info VALUES (?,?)");
        $stmt->execute([$wishlistId, $wishlistName]);
        return $this->getWishlistById($wishlistId);

    }


    public function updateWishlistName($wishlistName, $wishlistId)
    {
        $stmt = $this->connect()->prepare("UPDATE wishlist_info SET wishlist_name =? WHERE wishlist_id =?");
        $stmt->execute([$wishlistName, $wishlistId]);

    }

    /**
     * This deletes selected Wishlist
     * @param $wishlistId
     * @return void
     * @throws Exception
     */
    public function deleteWishlist($wishlistId)
    {
        $this->deleteWishlistItems($wishlistId);
        $this->deleteWishlistInfo($wishlistId);
        $this->deleteRelationUserWishlist($wishlistId);
    }

    public function deleteWishlistInfo($wishlistId)
    {
        $stmt = $this->connect()->prepare("DELETE FROM wishlist_info WHERE wishlist_id =?");
        $stmt->execute([$wishlistId]);
    }

    public function deleteRelationUserWishlist($wishlistId)
    {
        $stmt = $this->connect()->prepare("DELETE FROM wishlists WHERE wishlist_id =?");
        $stmt->execute([$wishlistId]);
    }

    public function deleteWishlistItems($wishlistId)
    {
        $stmt = $this->connect()->prepare("DELETE FROM wishlist_items WHERE wishlist_id =?");
        $stmt->execute([$wishlistId]);
    }

    public function checkIfWishlistExists($userId)
    {
        return (bool)$this->getWishlist($userId);
    }

    public function createWishlistNumber()
    {
        return uniqid(time());
    }


}