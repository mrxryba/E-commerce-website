<?php

class Address extends Dbh {

    private int $id;
    private int $streetNumber;
    private string $addressLine;
    private string $postalCode;
    private string $city;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $data = $this->getAddressData();
        $this->streetNumber = $data['street_number'];
        $this->addressLine = $data['address_line'];
        $this->postalCode = $data['postal_code'];
        $this->city = $data['city'];
    }

    public function getAddressData() {
        $stmt = $this->connect()->prepare("SELECT * FROM address WHERE address_id=?");
        $stmt->execute([$this->id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return end($result);

    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    /**
     * @param int $streetNumber
     */
    public function setStreetNumber(int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string
     */
    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    /**
     * @param string $addressLine
     */
    public function setAddressLine(string $addressLine): void
    {
        $this->addressLine = $addressLine;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }



}
