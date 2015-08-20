<?php
    class Restaurant
    {
        private $description;
        private $cuisine_id;
        private $id;

        function __construct($description, $id = null, $cuisine_id)
        {
            $this->description = $description;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
        }

        function setDescription($new_description)
        {
            $this->description = $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getRestaurants(){
           $GLOBALS['DB']->query("SELECT * FROM cuisines WHERE id = {$this->getCuisineId()};");
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (description, cuisine_id) VALUES ('{$this->getDescription()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
        }

        function update($new_description)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET description = '{$new_description}' WHERE id = {$this->getId()};");
            $this->setDescription($new_description);
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $description = $restaurant['description'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($description, $id, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }
        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }
        static function find($search_id)
        {
            $found_restaurants = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                  $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
    }

 ?>
