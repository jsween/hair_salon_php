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

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function test_get_name()
        {
            //Arrange
			$name = "Vidal Sassoon";
            $test_Stylist = new Stylist($name);

            //Act
            $result = $test_Stylist->getName();

            //Assert
            $this->assertEquals("Vidal Sasson", $result);
        }
    }

 ?>
