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
             $name = "Restaurant #1";
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

         function test_getCuisineId()
         {
             //Arrange
             $name = "Restaurant #1";
             $id = null;
             $test_cuisine = new Cuisine ($name, $id);
             $test_cuisine->save();
             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant = new Restaurant($description, $id, $cuisine_id);
             $test_restaurant->save();
             //Act
             $result = $test_restaurant->getCuisineId();
             //Assert
             $this->assertEquals(true, is_numeric($result));
         }

         function test_save()
         {
             //Arrange
             $name = "Restaurant #1";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();

             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant = new Restaurant($description, $id, $cuisine_id);
             //Act
             $test_restaurant->save();
             //Assert
             $result = Restaurant::getAll();
             $this->assertEquals($test_restaurant, $result[0]);
         }

         function test_getAll()
         {
             //Arrange
             $name = "Restaurant #1";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();

             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant = new Restaurant($description, $id, $cuisine_id);
             $test_restaurant->save();

             $description2 = "B grade";
             $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id);
             $test_restaurant2->save();

             //Act
             $result = Restaurant::getAll();

             //Assert
             $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
         }
         function test_deleteAll()
         {
             //Arrange
             $name = "Restaurant #1";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();

             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant = new Restaurant($description, $id, $cuisine_id);
             $test_restaurant->save();

             $description2 = "B grade";
             $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id);
             $test_restaurant2->save();
             //Act
             Restaurant::deleteAll();
             //Assert
             $result = Restaurant::getAll();
             $this->assertEquals([], $result);
         }

         function test_find()
         {
             //Arrange
             $name = "Resturant #1";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();

             $description = "A grade";
             $cuisine_id = $test_cuisine->getId();
             $test_restaurant = new Restaurant($description, $id, $cuisine_id);
             $test_restaurant->save();

             $description2 = "B grade";
             $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id);
             $test_restaurant2->save();
             //Act
             $result = Restaurant::find($test_restaurant->getId());
             //Assert
             $this->assertEquals($test_restaurant, $result);

         }

     }












 ?>
