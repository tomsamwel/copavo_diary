<?php
ini_set('display_errors', 'On');
class User{

	private $email;
	private $firstName;
	private $suffix;
	private $lastName;
	private $db;
	private $error;
	private $logged_in;
	private $userinfo;


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

   	

	function login( $email = '', $password = '', $remember_me = false )
	{
		//check if fields are empty
		if(empty($email) || empty($password)) {
		    $errors = "email/Password can't be empty";
		} else {
			$conn = $this->connect();
			$stmt = $conn->prepare("SELECT id_gebruiker, email, wachtwoord, voornaam, tussenvoegsels, achternaam FROM gebruikers WHERE email = :email ");
			$stmt->execute(array(':email' => $_POST["email"]));
			//turn the db result into an associative array
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			//check if email was found in the db
			if($stmt->rowCount() >= 1) {
				//verify password
				if(password_verify ($password , $result['wachtwoord'])){
					//actions after succesfully verifying password
					$_SESSION['id_user'] = $result['id_gebruiker'];
					$this->email = $result['email'];
				    $this->firstname = $result['voornaam'];
				    $this->suffix = $result['tussenvoegsels'];
				    $this->lastname = $result['achternaam'];
					$this->logged_in = true;

					//$this->logout_hash 		= md5( $result['id_gebruiker']; . $result['email']; . $$result['wachtwoord'] );
					return TRUE;
				} else {
					$error = "Invalid password";
					echo $error;
				}
			    
			} else {
		        $error = "Invalid email";
		        echo $error;
			}
		}
	}
	public function register($email, $firstname, $suffix, $lastname, $password)
	{
		$conn = $this->connect();
		$sql = 'SELECT email FROM gebruikers WHERE email = :email';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':email' => $_POST['email']));
		if($stmt->rowCount() >= 1) {
			$this->error = $_POST['email']. " is already in use";
			return false;
		}else {
			$hashedPass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);
			$sql = 'INSERT INTO gebruikers (email, voornaam, tussenvoegsels, achternaam, wachtwoord) VALUES (:email, :firstname, :suffix, :lastname, :password)';
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':email' => $email,':firstname' => $firstname,':suffix' => $suffix,':lastname' => $lastname,':password' => $hashedPass));
			$conn = null;
			return true;
		}
		
	}
	public function update($id_user) {
		$conn = $this->connect();

		//email updater
		if(isset($_POST['updateEmail'])){
			$conn = $this->connect();
			$sql = 'SELECT email FROM gebruikers WHERE email = :email';
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':email' => $_POST['email']));
			if($stmt->rowCount() >= 1) {
				echo "this email is already in use";
			}else {
				$sql	= 'UPDATE gebruikers '
						. 'SET email = :email '
						. 'WHERE id_gebruiker = :id_user';
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(
					':email' => $_POST['email'],
					':id_user' => $id_user));
			}
		//name updater
		}elseif (isset($_POST['updateName'])) {
			$sql	= 'UPDATE gebruikers '
					. 'SET voornaam = :firstname ,'
					. 'tussenvoegsels = :suffix ,'
					. 'achternaam = :lastname '
					. 'WHERE id_gebruiker = :id_user';
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(
				':firstname' => $_POST['firstname'],
				':suffix' => $_POST['suffix'],
				':lastname' => $_POST['lastname'],
				':id_user' => $id_user));
		//password updater
		}elseif (isset($_POST['updatePassword'])) {
			$hashedPass = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 8]);
			$sql = 'UPDATE gebruikers SET wachtwoord = :hashedpass WHERE id_gebruiker = :id_user';
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':hashedpass' => $hashedPass,':id_user' => $id_user));
		}

	}

	public function logout() {

		session_unset();
		session_destroy();
		$this->is_logged = false;
		echo "succesfully logged out";
		header('Location: ../index.php');
		exit();

	}

	public function delete($id_user) {
		$d = new Diary();
		$diaries = $d->getDiaries($id_user);
		foreach ($diaries as $diary) {
			$d->deleteDiary($diary['id_dagboek']);
		}

		$conn = $this->connect();
		$sql = 'DELETE FROM gebruikers WHERE id_gebruiker = :id_user';
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':id_user' => $id_user));
		$this->logout();
		exit();
	}

	// Get info about an user

	public function get_user_info($id_user) {
		$conn = $this->connect();
		$stmt = $conn->prepare('SELECT id_gebruiker, voornaam, tussenvoegsels, achternaam, email FROM gebruikers WHERE id_gebruiker = "' . $id_user . '"');
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->email = $result['email'];
	    $this->firstname = $result['voornaam'];
	    $this->suffix = $result['tussenvoegsels'];
	    $this->lastname = $result['achternaam'];
		return $result;
	}
	
	//functions to get info
   	public function get_firstname() { return $this->firstname; }
   	public function get_suffix() { return $this->suffix; }
   	public function get_lastname() { return $this->lastname; }
   	public function get_email() { return $this->email; }
   	public function get_error() { return $this->error; }
}
