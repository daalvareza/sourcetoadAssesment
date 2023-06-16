<?php
class Cart {
    private Customer $customer;
    private array $items = [];
    private Address $shippingAddress;
    private float $taxRate = 0.07; // A tax rate of 7%

    // Constructor function that sets the customer when a new Cart is created
    function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    /**
     * Method to add an item to the cart
     * @param Item $item item to be added
     */
    function addItem(Item $item) {
        array_push($this->items, $item);
    }

    /**
     * Method to set the shipping address for the cart
     * @param Address $address address to be setted
     */
    function setShippingAddress(Address $address) {
        $this->shippingAddress = $address;
    }

    /**
     * Method to get the shipping address for the cart
     * @return string full shipping address
     */
    function getShippingAddress() {
        return $this->shippingAddress->getAddress();
    }

    /**
     * Method to get the customer of the cart
     * @return Customer customer of the cart
     */
    function getCustomer() {
        return $this->customer;
    }

    /**
     * Method to get the items in the cart
     * @return array<Item> array of items in the cart
     */
    function getItems() {
        return $this->items;
    }

    /**
     * Method to calculate and return the subtotal for the cart
     * @return float subtotal for the cart
     */
    function getSubtotal() {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item->getTotalPrice();
        }
        return $subtotal;
    }

    /**
     * Method to calculate and return the total cost for the cart (including tax and shipping)
     * @return float total cost for the cart
     */
    function getTotal() {
        $subtotal = $this->getSubtotal();
        $shippingCost = $this->getShippingCost(); // This method is assumed to exist
        $total = $subtotal + $subtotal * $this->taxRate + $shippingCost;
        return $total;
    }
}
?>