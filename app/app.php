<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/car.php";

  $app = new Silex\Application();

  $app->get("/", function() {
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
        $car_price = $specific_car->getPrice();
        $car_make = $specific_car->getMake();
        $car_miles = $specific_car->getMiles();
        $car_picture = $specific_car->getPicture();
        $output = $output .
            "<div><img src='$car_picture'</div>
            <p>$car_make</p>
            <p>$car_miles miles</p>
            <p>$$car_price</p>
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
