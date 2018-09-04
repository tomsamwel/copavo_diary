<?php

ini_set('display_errors', 'on');

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_POST['email'], $_POST['firstname'], $_POST['suffix'], $_POST['lastname'], $_POST['password'], $_POST['password_verify'])) {
		if ($_POST['password'] === $_POST['password_verify']) {

			require "../src/user.php";

			$user = new User();
			$register = $user->register($_POST['email'], $_POST['firstname'], $_POST['suffix'], $_POST['lastname'], $_POST['password']);
			if($register){

				header('Location: ../index.php');
				
			}else{
				header('Location: ../404.php');
				
			}
		}else{
			echo "your passwords are not the same";
		}

		
	}else {
	
	}
}else{
	header('Location: ../register.php');
}
