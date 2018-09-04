<?php
class DB
{

	public function Connect(){

		$servername = "localhost";
		$username = "root";
		$password = "admin";

		try {
		    $db = new PDO("mysql:host=$servername;dbname=dagboek_b2", $username, $password);
		    // set the PDO error mode to exception
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $db;
	    }
		catch(PDOException $e){
	    	echo "DB Connection failed: " . $e->getMessage();
	    }

   	}
	
}