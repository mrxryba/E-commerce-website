<?php

interface ViewableProduct{
    public function getProduct($thing);
}

class CategoryProductViewer extends Dbh implements ViewableProduct {

    public function getProduct($thing)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM products WHERE category=?");
        $stmt->execute([$thing]);
         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $results;
    }


}