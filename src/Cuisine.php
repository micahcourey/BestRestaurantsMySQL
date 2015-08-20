<?php

    class Cuisine
    {

        private $name;
        private $id;

        function __construct($name, $id = null){
            $this->name = $name;
            $this->id = $id;
        }

        function getName(){
            return $this->name;
        }

        function getId(){
            return $this->id;
        }

        function setName($new_name){
            $this->name = $new_name;
        }

        function getCuisines(){
           $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE id = {$this->getId()};");
        }

        function getRestaurants(){
           $GLOBALS['DB']->query("SELECT * FROM cuisines WHERE id = {$this->getId()};");
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine){
                $name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisines = new Cuisine($name, $id);
                array_push($cuisines, $new_cuisines);
            }
            return $cuisines;
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                //var_dump($cuisine_id);

                var_dump($search_id);
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
    }

?>
