<?php

class Customer {
    private string $first_name;
    private string $last_name;
    private array $addresses = [];

    // Constructor function that sets the first and last name when a new Customer is created
    function __construct(string $first_name, string $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Method to add an address to the customer's address array
     * @param Address $address address to be added to the customer
     */
    function addAddress(Address $address) {
        array_push($this->addresses, $address);
    }

    /**
     * Method to return the customer's full name as a string
     * @return string full name of the customer
     */
    function getName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Method to return the array of the customer's addresses
     * @return array array of strings with the addresses related to the customer
     */
    function getAddresses() {
        return $this->addresses;
    }
}

?>
