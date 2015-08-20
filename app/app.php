<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'

    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app){
        return $app ['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/restaurants", function() use ($app){
        $description = $_POST['description'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($description, $id = null, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });
    $app->get("/cuisines/{id}/edit", function($id) use ($app){
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app){
    $name = $_POST['name'];
    $cuisine = Cuisine::find($id);
    $category->update($name);
    return $app['twig']->render ('cuisine.html.twig', array('cuisine'=> $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app){
    $cuisine = Cuisine::find($id);
    return $app['twig']->render ('cuisine.html.twig', array('cuisine'=> $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/restaurants/{id}/edit", function($id) use ($app){
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
    });

    $app->patch("/restaurants/{id}", function($id) use ($app){
        $description = $_POST['description'];
        $restaurant = Restaurant::find($id);
        $restaurant->update($description);
        return $app['twig']->render ('restaurant.html.twig', array('restaurant'=> $restaurant, 'cuisines' => $restaurant->getCuisines()));
    });
    $app->post("/cuisines", function() use ($app){
        $cuisine = new Cuisine($_POST['name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });
    $app->post("/delete_cuisines", function() use ($app){
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    $app->post("/delete_restaurants", function() use ($app){
        Restaurant::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    $app->delete("/cuisines/{id}", function($id) use ($app) {
    $cuisine = Cuisine::find($id);
    $cuisine->delete();
    return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
});

    return $app;
 ?>
