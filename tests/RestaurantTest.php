<?php

     /**
     * @backupGlobals disabled
     * @backupStaticAttributes disabled
     */
     require_once "src/Restaurant.php";
     require_once "src/Cuisine.php";
     $server = 'mysql:host=localhost;dbname=best_restaurants_test';
     $username = 'root';
     $password = 'root';
     $DB = new PDO($server, $username, $password);

     class RestaurantTest extends PHPUnit_Framework_TestCase
     {
         protected function tearDown()
         {
             Cuisine::deleteAll();
             Restaurant::deleteAll();
         }

         function test_getId()
         {
             //Arrange
             $name = "Resturant #1";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();
             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant= new Restaurant($description, $id, $cuisine_id);
             $test_restaurant->save();
             //Act
             $result = $test_restaurant->getId();
             //Assert
             $this->assertEquals(true, is_numeric($result));
         }

     }












 ?>
