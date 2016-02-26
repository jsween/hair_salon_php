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
        /* SAVE */
        function save()
        {
            $GLOBALS['DB']->query("INSERT INTO clients (name, stylist_id) VALUES ('{$this->name}', {$this->stylist_id})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        /* GET ALL CLIENTS */
        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients");
            $clients = array();
            foreach($returned_clients as $client)
            {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
        /* DELETE ALL CLIENTS */
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients");
        }
        /* FIND */
        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client)
            {
                $client_id = $client->getId();
                if($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }
        /* UPDATE */
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()}");
            $this->setName($new_name);
        }
    }
 ?>
