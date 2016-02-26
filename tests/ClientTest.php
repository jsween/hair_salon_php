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
		// protected function tearDown()
		// {
		// 	Client::deleteAll();
		// }
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

    }
