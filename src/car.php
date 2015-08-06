<?php
class Car
{
  private $make_model;
  private $price;
  private $miles;
  private $picture;

  function __construct($make_model, $price, $miles, $picture) {
    $this->make_model = $make_model;
    $this->price = $price;
    $this->miles = $miles;
    $this->picture = $picture;
  }
  function setPrice($new_price) {
    $float_price = (float) $new_price;
    if ($float_price !=0) {
      $formatted_price = number_format($float_price, 2);
      $this->price = $formatted_price;
    }
  }
  function getPrice() {
    return $this->price;
  }
  function setMake($new_make){
    $this->make = $new_make;
  }
  function getMake() {
    return $this->make_model;
  }
  function setMiles($new_miles){
    $this->miles = $new_miles;
  }
  function getMiles() {
    return $this->miles;
  }
  function setPicture($new_picture){
    $this->picture = $new_picture;
  }
  function getPicture() {
    return $this->picture;
  }

  static function getAll()
  {
    return $_SESSION['car_list'];
  }

  
}
