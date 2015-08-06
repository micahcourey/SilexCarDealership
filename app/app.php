<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Car.php";

  session_start();
  $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/porsche.jpg");
  $ford = new Car("2011 Ford F450", 55995, 14241, "/img/ford.jpg");
  $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "/img/lexus.jpg");
  $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "/img/cls550.jpg");
  $_SESSION['car_list'] = array($porsche, $ford, $lexus, $mercedes);

  if(empty($_SESSION['car_list'])) {
    $_SESSION['car_list'] = array();
  }

  $app = new Silex\Application();
  
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('carlist.html.twig');
});

  $app->get("/cars", function() {
    $user_price = $_GET["user_price"];
    $user_miles = $_GET["user_miles"];

    $output = "";
    $counter = 0;
    foreach ($cars as $specific_car) {
      if ($specific_car->certainSpecs($user_price, $user_miles)) {
        $counter++;

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

    return $app['twig']->render('carlist.html.twig');
  });



  return $app;
?>
