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
        /* SAVE */
        function save()
        {
            $GLOBALS['DB']->query("INSERT INTO stylists (name) VALUES ('{$this->name}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        /* GET ALL STYLISTS */
        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist)
            {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }
        /* DELETE ALL STYLISTS */
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists");
        }
        /* FIND STYLIST */
        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist)
            {
                $stylist_id = $stylist->getId();
                if($stylist_id == $search_id){
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }
        /* DELETE SINGLE CLIENT*/
        /*****FIX ME*****/
        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE ")
        // }


    }
 ?>
