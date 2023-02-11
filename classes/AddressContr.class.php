<?php

class AddressContr extends Dbh
{


    public function getAddress($userId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM user_address JOIN address ON user_address.address_id = address.address_id WHERE user_id=?");
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $addressId = $result[0]['address_id'];
            return new Address($addressId);
        }
        return $result;
    }

    public function createAddress($userId, $streetNumber, $addressLine, $postalCode, $city)
    {
        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO address VALUES (NULL,?,?,?,?)");
        $stmt->execute([$streetNumber, $addressLine, $postalCode, $city]);
        $addressId = $db->lastInsertId();
        $this->addRelationUserAddress($userId,$addressId);
    }

    public function addRelationUserAddress($userId,$addressId)
    {
        $stmt = $this->connect()->prepare("INSERT INTO user_address VALUES (?,?)");
        $stmt->execute([$userId, $addressId]);

    }

    public function deleteRelationUserAddress($addressId)
    {
        $stmt = $this->connect()->prepare("DELETE FROM user_address WHERE address_id=?");
        $stmt->execute([$addressId]);
    }

    public function updateAddress($streetNumber, $addressLine, $postalCode, $city, $addressId)
    {
        $stmt = $this->connect()->prepare("UPDATE address SET street_number =?, address_line =?, postal_code =?, city=? WHERE address_id =?");
        $stmt->execute([$streetNumber, $addressLine, $postalCode, $city, $addressId]);
    }

    public function deleteAddress($addressId)
    {
        $this->deleteRelationUserAddress($addressId);
        $stmt = $this->connect()->prepare("DELETE FROM address WHERE address_id=?");
        $stmt->execute([$addressId]);
    }


}