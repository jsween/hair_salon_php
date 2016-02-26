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
		protected function tearDown()
		{
			Stylist::deleteAll();
		}
        function test_get_name()
        {
            //Arrange
			$stylist_name = "Vidal Sassoon";
            $test_Stylist = new Stylist($stylist_name);
            //Act
            $result = $test_Stylist->getName();
            //Assert
            $this->assertEquals("Vidal Sassoon", $result);
        }
		function test_save()
		{
			//Arrange
			$stylist_name = "Vidal Sassoon";
			$new_stylist = new Stylist($stylist_name);
			$new_stylist->save();
			//Act
			$result = Stylist::getAll();
			//Assert
			$this->assertEquals($new_stylist, $result[0]);
		}
		function test_find()
		{
			//Arrange
			$stylist_name = "stylist name";
			$new_stylist = new Stylist($stylist_name);
			$new_stylist->save();
			//Act
			$result = Stylist::find($new_stylist->getId());
			//Assert
			$this->assertEquals($new_stylist, $result);
		}
		// function test_delete()
		// {
		// 	//Arrange
		// 	$stylist_name1 = "Stylist 1";
		// 	$new_stylist1 = new Stylist($stylist_name1);
		// 	$new_stylist1->save();
		//
		// 	$stylist_name2 = "Stylist 2";
		// 	$new_stylist2 = new Stylist($stylist_name2);
		// 	$new_stylist2->save();
		// 	//Act
		// 	$new_stylist1->delete();
		// 	$result = Stylist::getAll();
		// 	//Assert
		// 	$this->assertEquals([ $new_stylist2], $result);
		// }
		function test_getAll()
		{
			//Arrange
			$stylist_name1 = "Stylist 1";
			$new_stylist1 = new Stylist($stylist_name1);
			$new_stylist1->save();

			$stylist_name2 = "Stylist 2";
			$new_stylist2 = new Stylist($stylist_name2);
			$new_stylist2->save();
			//Act
			$result = Stylist::getAll();
			//Assert
			$this->assertEquals([$new_stylist1, $new_stylist2], $result);
		}

    }

 ?>
