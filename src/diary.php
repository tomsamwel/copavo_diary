<?php

ini_set('display_errors', 'on');
class Diary extends User{
	
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

   	public function diaryPost($id_diary, $diaryPost){
   		$conn = $this->connect();
		$sql = 'INSERT INTO posts (post, datum) VALUES (:diaryPost, :postDateTime)';
		$stmt = $conn->prepare($sql);
		$postDateTime = date("Y-m-d h:i:sa");
		$stmt->execute(array(':diaryPost' => $diaryPost, ':postDateTime' => $postDateTime));
		//get post ID
		$this->id_post = $conn->lastInsertId();
		//insert id_user and id_diary in to DB
		$sql = 'INSERT INTO dagboeken_posts (id_dagboek, id_post) VALUES (:id_diary, :id_post)';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':id_diary' => $id_diary, ':id_post' => $this->id_post));
   	}

   	public function getDiaries($id_user){
   		$conn = $this->connect();
   		$sql = 'SELECT dagboeken.id_dagboek, dagboeken.naam
				FROM `gebruikers_dagboeken`
				INNER JOIN dagboeken ON gebruikers_dagboeken.id_dagboek = dagboeken.id_dagboek
				WHERE gebruikers_dagboeken.id_gebruiker = (:id_user)';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array('id_user' => $id_user));
		$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($diaries);
		return $diaries;
   	}
   	public function getDiaryName($id_diary){
   		$conn = $this->connect();
   		$sql = 'SELECT dagboeken.naam
				FROM `dagboeken`
				WHERE id_dagboek = (:id_diary)';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array('id_diary' => $id_diary));
		$diaryName = $stmt->fetch(PDO::FETCH_ASSOC);
		return $diaryName;
   	}

   	public function getPosts($id_diary){
   		$conn = $this->connect();
   		$sql = 'SELECT posts.id_post, posts.datum, posts.post
				FROM `posts`
				INNER JOIN dagboeken_posts ON dagboeken_posts.id_post = posts.id_post
				WHERE dagboeken_posts.id_dagboek = (:id_diary)';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array('id_diary' => $id_diary));
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $posts;
   	}

   	public function deletePost($id_post){
   		$conn = $this->connect();
		$sql = 'DELETE FROM posts 			WHERE id_post = :id_post;
				DELETE FROM dagboeken_posts WHERE id_post = :id_post';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':id_post' => $id_post));
		return true;
   	}

   	public function deleteDiary($id_diary){
   		$posts = $this->getPosts($id_diary);
   		foreach ($posts as $post) {
   			$this->deletePost($post['id_post']);
   		}

   		$conn = $this->connect();
   		$sql = 'DELETE FROM dagboeken 				WHERE id_dagboek = :id_diary;
   				DELETE FROM gebruikers_dagboeken 	WHERE id_dagboek = :id_diary;
				DELETE FROM dagboeken_posts 		WHERE id_dagboek = :id_diary';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':id_diary' => $id_diary));
		unset($_SESSION['id_diary']);
		return true;
   	}

}