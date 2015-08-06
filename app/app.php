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
    return $app['twig']->render('carsearch.html.twig', array('car_list' => Car::getAll()));
  });

  $app->post("/cars", function() use ($app) {
    // $car = new Car($_POST['car_list'])
    // $user_price = $_GET["user_price"];
    // $user_miles = $_GET["user_miles"];
    return $app['twig']->render('carlist.html.twig');
  });

  return $app;
?>
