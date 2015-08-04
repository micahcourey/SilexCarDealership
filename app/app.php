<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/car.php";

  $app = new Silex\Application();

  $app->get("/", function() {
    return "
    <!DOCTYPE html>
    <html>
      <head>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
  <title>Search for a car!</title>
</head>

<body>
  <div class='container'>
    <h1>Car Search</h1>
    <p>Enter the price and mileage in a car that you are looking for.</p>
    <form action='/cars'>
      <div class='form-group'>
        <label for='user_price'>Enter a price:</label>
        <input id='user_price' name='user_price' class='form-control' type='number'>
      </div>
      <div class='form-group'>
        <label for='user_miles'>Enter a mileage:</label>
        <input id='user_miles' name='user_miles' class='form-control' type='number'>
      </div>
      <button type='submit' class='btn-success'>Search</button>
    </form>
</body>
<html>";
});


  $app->get("/cars", function() {
    $user_price = $_GET["user_price"];
    $user_miles = $_GET["user_miles"];
    $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/porsche.jpg");
    $ford = new Car("2011 Ford F450", 55995, 14241, "/img/ford.jpg");
    $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "/img/lexus.jpg");
    $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "/img/cls550.jpg");
    $cars = array($porsche, $ford, $lexus, $mercedes);

    $output = "";
    $counter = 0;
    foreach ($cars as $specific_car) {
      if ($specific_car->certainSpecs($user_price, $user_miles)) {
        $counter++;
        // $car_price = $specific_car->getPrice();
        // $car_make = $specific_car->getMake();
        // $car_miles = $specific_car->getMiles();
        // $car_picture = $specific_car->getPicture();
        $output = $output .
            "<div><img src='" . $specific_car->getPicture() . "'</div>
            <p>" . $specific_car->getMake() . "</p>
            <p>". $specific_car->getMiles() ." miles</p>
            <p>$" . $specific_car->getPrice() . "</p>
            ";
      }
    }
    if ($counter == 0) {
        $output = $output .
        "<p>Your search matched zero results</p>";
    }

    return $output;
  });



  return $app;
?>
