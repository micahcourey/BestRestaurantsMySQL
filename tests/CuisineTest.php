<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    //require_once "src/Restaurant";

    $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class CuisineTest extends PHPUnit_FrameWork_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
        //     Restaurant::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $name = "Cuisine #1";
            $test_Cuisine = new Cuisine($name);
            //Act
            $result = $test_Cuisine->getName();
            //Assert
            $this->assertEquals($name, $result);

        }
        function test_getId()
        {
            //Arrange
            $name = "Cuisine #1";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);
            //Act
            $result = $test_Cuisine->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
            //Arrange
            $name = "Cuisine #1";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            //Act
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

    }
?>
