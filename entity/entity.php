
<?php

//require_once __DIR__."/../config/dbcon.php";

/**
	This file is made with OOP concepts. Entity Super class (model) for accessing DB
*/


class Entity
{
	//private $conn=null; // works only in this class
	public $conn=null; // public: to be worked in child classes
	function __construct()
	{
		//require_once __DIR__."/../config/dbcon.php";
		require __DIR__."/../config/dbcon.php"; //require_once not working

		# code...
		$conn=new mysqli($host, $user, $pass, $db); //working

		if($conn->connect_error){
			echo __CLASS__." : ".__FUNCTION__." error<br/>";
			echo $conn->connect_error;
		}
		$this->conn=$conn;
		//print_r( $this->conn ); // working

	}
}



?>