<?php

class Item {
    private int $id;
    private string $name;
    private int $quantity;
    private float $price;

    // Constructor function that sets the item's details when a new Item is created
    function __construct(int $id, string $name, int $quantity, float $price) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * Method to return the total price for the item (quantity * unit price)
     * @return float total price
     */
    function getTotalPrice() {
        return $this->quantity * $this->price;
    }
}

?>