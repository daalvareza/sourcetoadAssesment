<?php
class Address {
    private string $line_1;
    private string $line_2;
    private string $city;
    private string $state;
    private string $zip;

    // Constructor function that sets the address parts when a new Address is created
    function __construct(string $line_1, string $line_2, string $city, string $state, string $zip) {
        $this->line_1 = $line_1;
        $this->line_2 = $line_2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    /**
     * Method to return the full address
     * @return string full address separated by commas
     */
    function getAddress() {
        return $this->line_1 . ', ' . $this->line_2 . ', ' . $this->city . ', ' . $this->state . ', ' . $this->zip;
    }
}

?>