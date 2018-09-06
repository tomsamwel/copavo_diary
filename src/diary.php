<?php

ini_set('display_errors', 'on');
class Diary{
	
	private $id_user;
	private $id_diary;
	private $diary_name;
	private $id_post;
	private $diary_post;
	private $diary_date;

	public function Connect(){

		$servername = "localhost";
		$username = "root";
		$password = "admin";

		try {
			//connect to db
		    $db = new PDO("mysql:host=$servername;dbname=dagboek_b2", $username, $password);
		    // set the PDO error mode to exception
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $db;
	    }
		catch(PDOException $e){
	    	echo "DB Connection failed: " . $e->getMessage();
	    }
	}
	public function createDiary($diary_name){

	$conn = $this->connect();
	//create new diary in db
	$sql = 'INSERT INTO dagboeken (naam) VALUES (:diary_name)';
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(':diary_name' => $diary_name));
	//get diary ID
	$this->id_diary = $conn->lastInsertId();
	//insert id_user and id_diary in to DB
	$sql = 'INSERT INTO gebruikers_dagboeken (id_gebruiker, id_dagboek) VALUES (:id_user, :id_diary)';
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(':id_user' => $_SESSION['id_user'], ':id_diary' => $this->id_diary));


   	}

}