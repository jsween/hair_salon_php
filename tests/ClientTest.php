<?php
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/
	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	require_once 'src/Stylist.php';
	require_once 'src/Client.php';

    class ClientTest extends PHPUnit_Framework_TestCase
    {
		protected function tearDown()
		{
            Stylist::deleteAll();
			Client::deleteAll();
		}
        function test_get_name()
        {
            //Arrange
			$client_name = "Jimi Hendrix";
            $stylist_id = 1;
            $test_Client = new Client($client_name, $stylist_id);
            //Act
            $result = $test_Client->getName();
            //Assert
            $this->assertEquals("Jimi Hendrix", $result);
        }
        function test_get_id()
        {
            //Arrange
			$client_name = "Jimi Hendrix";
            $stylist_id = 1;
            $test_Client = new Client($client_name, $stylist_id);
            //Act
            $result = $test_Client->getStylistId();
            //Assert
            $this->assertEquals(1, $result);
        }
        function test_delete_all()
        {
            //Arrange
            $stylist_name = "Lee Stafford";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

			$client_name = "Jimi Hendrix";
            $stylist_id = 1;
            $new_client = new Client($client_name, $stylist_id);
            $new_client->save();

            $client_name2 = "Harrison Ford";
            $stylist_id2 = 13;
            $new_client2 = new Client($client_name2, $stylist_id2);
            $new_client2->save();
            //Act
            Client::deleteAll();
            $result = Client::getAll();
            //Assert
            $this->assertEquals([], $result);
        }
        function test_save()
		{
			//Arrange
			$stylist_name = "stylist";
			$new_stylist = new Stylist($stylist_name);
			$new_stylist->save();

			$client_name = "client";
			$client_stylist_id =  $new_stylist->getId();
			$new_client = new Client($client_name, $client_stylist_id);
			$new_client->save();
			//Act
			$result = Client::getAll();
			//Assert
			$this->assertEquals($new_client, $result[0]);
		}
        function test_get_all()
        {
            //Arrange
			$stylist_name = "stylist name";
			$new_stylist = new Stylist($stylist_name);
			$new_stylist->save();

			$client_name = "client name";
			$client_stylist_id =  $new_stylist->getId();
			$new_client = new Client($client_name, $client_stylist_id);
			$new_client->save();

            $client_name2 = "client name2";
			$client_stylist_id2 =  $new_stylist->getId();
			$new_client2 = new Client($client_name2, $client_stylist_id2);
			$new_client2->save();
            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals([$new_client, $new_client2], $result);
        }
    }
