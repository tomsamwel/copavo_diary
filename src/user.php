<?php
ini_set('display_errors', 'On');
class User{

	private $email;
	private $firstName;
	private $suffix;
	private $lastName;
	private $db;
	private $errors = [];
	private $logged_in;
	private $userinfo;

	// function __construct( $db=NULL, $table_wildcard = '%t' ){
	// 	if( $db == NULL ) 	echo "DB connection failed";
	// 	$this->db = &$db;
	// 	$this->table_wildcard = $table_wildcard;
	// }

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

	function login( $email = '', $password = '', $remember_me = false )
	{


		if(empty($email) || empty($password)) {
		    $errors[] = "email/Password can't be empty";
		} else {
			$conn = $this->connect();
			$stmt = $conn->prepare("SELECT email, wachtwoord FROM gebruikers WHERE email = :email ");
			$stmt->execute(array(':email' => $_POST["email"]));
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			var_dump($result);
			if($stmt->rowCount() >= 1) {
			//	if(password_verify ( string $password , string $wachtwoord )){

			//	}
			    $_SESSION['email'] = $email;
			    $_SESSION['time_start_login'] = time();
			    //hooray! The user is valid!
				$this->logged_in = true;
				echo "logged in succesfully";
				//finally set up the session
				$this->userinfo 		= $userinfo;
				$_SESSION['userid'] 	= $userinfo->id;
				$this->logout_hash 		= md5( $userinfo->id . $userinfo->username . $userinfo->password );
				return TRUE;
			} else {
			        $errors[] = "Email/Password is wrong";
			        echo "Email/Password is wrong";
			}
		}
	}
	function register($email, $firstname, $suffix, $lastname, $password)
	{
		
		$conn = $this->connect();
		
		$hashedPass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);
		
		$sql = 'INSERT INTO gebruikers (email, voornaam, tussenvoegsels, achternaam, wachtwoord) VALUES (:email, :firstname, :suffix, :lastname, :password)';
		
		$stmt = $conn->prepare($sql);
		
		$stmt->execute(array(':email' => $email,':firstname' => $firstname,':suffix' => $suffix,':lastname' => $lastname,':password' => $password));
		
		$conn = null;
		return true;
	}
	
}
