<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Car.php";

  session_start();
  $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/porsche.jpg");
  $ford = new Car("2011 Ford F450", 55995, 14241, "/img/ford.jpg");
  $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "/img/lexus.jpg");
  $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "/img/cls550.jpg");
  if(empty($_SESSION['car_list'])) {
    $_SESSION['car_list'] = array($porsche, $ford, $lexus, $mercedes);
  }

  $app = new Silex\Application();
  $app['debug'] = true;

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('carsearch.html.twig');
  });

  $app->get("/cars", function() use ($app) {
    $cars = $_SESSION['car_list'];
    $cars_matching_search = array();

    foreach($cars as $car) {
      $price = $car->getPrice();
      $mileage = $car->getMiles();
      if (($price<=$_GET["user_price"]) && ($mileage<=$_GET["user_miles"])) {
        array_push ($cars_matching_search, $car);
      }
    }

    return $app['twig']->render('carlist.html.twig', array('car_list' => $cars_matching_search));
  });

  return $app;
?>
