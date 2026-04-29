<?php

class Inventory {
    private int $inventoryID;
    private string $itemCategory;
    private string $itemBarcode;
    private int $itemQuantity;
    private int $itemReorderLevel;
    private string $itemExpirationDate;
    private float $itemCostPrice;
    private float $itemSellingPrice;

    public function __construct(string $itemCategory, string $itemBarcode, int $itemQuantity, int $itemReorderLevel, string $itemExpirationDate,
    float $itemCostPrice, float $itemSellingPrice)
    {
        $this->itemCategory = $itemCategory;
        $this->itemBarcode = $itemBarcode;
        $this->itemQuantity = $itemQuantity;
        $this->itemReorderLevel = $itemReorderLevel;
        $this->itemExpirationDate = $itemExpirationDate;
        $this->itemCostPrice = $itemCostPrice;
        $this->itemSellingPrice = $itemSellingPrice;
    }

    //getters
    public function getItemCategory () {
        return $this->itemCategory;
    }

    public function getItemBarcode () {
        return $this->itemBarcode;
    }

    public function getItemQuantity () {
        return $this->itemQuantity;
    }

    public function getReorderLevel () {
        return $this->itemReorderLevel;
    }

    public function getItemExpirationDate () {
        return $this->itemExpirationDate;
    }

    public function getItemCostPrice () {
        return $this->itemCostPrice;
    }

    public function getSellingPrice () {
        return $this->sellingPrice;
    }

    //setters
    public function setItemCategory (string $itemCategory) {
        $this->itemCategory = $itemCategory;
    }

    public function setItemBarcode (string $itemBarcode) {
        $this->itemBarcode = $itemBarcode;
    }

    public function setItemQuantity (int $itemQuantity) {
        $this->itemQuantity = $itemQuantity;
    }

    public function setItemReorderLevel (int $itemReorderLevel) {
        $this->itemReorderLevel = $itemReorderLevel;
    }

    public function setItemExpirationDate (string $itemExpirationDate) {
        $this->itemExpirationDate = $itemExpirationDate;
    }

    public function setItemCostPrice (float $itemCostPrice) {
        $this->itemCostPrice = $itemCostPrice;
    }

    public function setItemSellingPrice (float $itemSellingPrice) {
        $this->itemSellingPrice = $itemSellingPrice;
    }
}

?>