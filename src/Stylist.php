<?php
    class Stylist
    {
        private $name;
        private $id;

        /* CONSTRUCTOR */
        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }
        /* SETTERS */
        function setName($name)
        {
            $this->name = $name;
        }
        /* GETTERS */
        function getName()
        {
            return  $this->name;
        }

        function getId()
        {
            return $this->id;
        }
    }


 ?>
