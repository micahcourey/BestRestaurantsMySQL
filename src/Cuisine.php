<?php

    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null){
            $this->name = $name;
        }

        function getName(){
            return $this->name;
        }

        function getId(){
            return $this->id;
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }


        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }



    }

?>
