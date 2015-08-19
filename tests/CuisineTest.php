<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class CuisineTest extends PHPUnit_FrameWork_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
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
        function test_getAll()
        {
            //Arrange
            $name = "Cuisine #1";
            $name2 = "Cuisine #2";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $name = "Cuisine #1";
            $name2 = "Cuisine #2";
            $test_Cuisine = new Cuisine ($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine ($name2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
        function test_find()
        {
            //Arrange
            $name = "Cuisine #1";
            $name2 = "Cuisine #2";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

    }
?>
