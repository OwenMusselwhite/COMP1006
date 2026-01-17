<?php

 //Car class represents a vehicle with make, model, and year properties.
 
class Car {
    // Public properties for the car's make, model, and year
    public $make;
    public $model;
    public $year;

    /**
     * Constructor to initialize the car with make, model, and year.
     * @param string $make The make of the car
     * @param string $model The model of the car
     * @param int $year The year of the car
     */

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    /**
     * Method to return the car's information as a formatted string.
     * @return string The car's make, model, and year
     */
    public function getCarInfo() {
        return "Make: " . $this->make . ", Model: " . $this->model . ", Year: " . $this->year;
    }
}

// Example:
$myCar = new Car("Toyota", "Corolla", 2020); //making new car object
echo $myCar->getCarInfo(); // Outputs: Make: Toyota, Model: Corolla, Year: 2020
