<?php
    class Client
    {
        private $name;
        private $stylist_id;
        private $id;
        /* CONSTRUCTOR */
        function __construct($name, $stylist_id, $id = null)
        {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }
        /* SETTERS */
        function setName($name)
        {
            $this->name = $name;
        }

        function setStylistId($stylist_id)
        {
            $this->stylist_id = $stylist_id;
        }
        /* GETTERS */
        function getName()
        {
            return  $this->name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function getId()
        {
            return $this->id;
        }



    }
 ?>
