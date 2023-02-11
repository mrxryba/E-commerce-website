<?php

class ProductContr extends Dbh
{
    use HtmlEntitiesConvert;
    use Whitespace;

    public function checkIfProductExists($productId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM products WHERE product_id=?");
        $stmt->execute([$productId]);
        return (bool)$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function createProduct($productName, $productDesc, $productCategory, $productPrice, $productQty, $productDiscountId, $productCreateTime, $productModifyTime, $productSku, $productImage)
    {
        $stmt = $this->connect()->prepare("INSERT INTO products VALUES (NULL,?,?,?,?,?,?,?,?,?,? )");
        $stmt->execute([$productName, $productDesc, $productCategory, $productPrice, $productQty, $productDiscountId, $productCreateTime, $productModifyTime, $productSku, $productImage]);

    }

    public function updateProduct($productName, $productDesc, $productCategory, $productPrice, $productQty, $productDiscountId, $productCreateTime, $productModifyTime, $productSku, $productImage, $productId)
    {
        $stmt = $this->connect()->prepare("UPDATE products VALUES (NULL,?,?,?,?,?,?,?,?,?,?) WHERE product_id=?  ");
        $stmt->execute([$productName, $productDesc, $productCategory, $productPrice, $productQty, $productDiscountId, $productCreateTime, $productModifyTime, $productSku, $productImage, $productId]);
    }


}
