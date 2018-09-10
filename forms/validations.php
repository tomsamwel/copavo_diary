<?php

ini_set('display_errors', 'on');

/*
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
*/

$errors = [];
$validations = [
    'required',
    'email',
    'name',
    'min',
    'max',
    'confirmed',
];
foreach($variables as $key => $checks) {
    foreach($checks as $check) {
        $checkExploded = explode(':', $check);
        if(count($checkExploded) > 1) {
            // wel een :
            $checkFunction = 'is'.ucfirst($checkExploded[0]);
            if($error = $checkFunction($_POST[$key], $checkExploded[1], $key, $checks)) {
                if(array_key_exists($key, $errors)) {
                    array_push($errors[$key], $error);
                }
                else {
                    $errors[$key] = [$error];
                }
            }
        }
        else {
            // geen :
            $checkFunction = 'is'.ucfirst($check);
            if($error = $checkFunction($_POST[$key], $key, $checks)) {
                if(array_key_exists($key, $errors)) {
                    array_push($errors[$key], $error);
                }
                else {
                    $errors[$key] = [$error];
                }
            }
        }
    }
}
function isRequired($value, $key, $checks)
{
    if(! $value) {
        return 'You did not enter anything';
    }
}
function isEmail($value, $key, $checks)
{
    if($value && ! preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i', $value)) {
        return 'You did not enter a valid e-mail address';
    }
}
function isName($value, $key, $checks)
{
    if($value && ! preg_match('/^[\p{L}\s\'.-]+$/', $value)) {
        return 'You did not enter a valid name';
    }
}
function isConfirmed($value, $key, $checks)
{
    if($value && $_POST[$key] != $_POST[$key.'_confirmed']) {
        return 'The passwords are not the same';
    }
}
function isMin($value, $amount, $key, $checks)
{
    if($value && strlen($value) < $amount) {
        return 'Your input is too short'.$amount;
    }
}
function isMax($value, $amount, $key, $checks)
{
    if($value && strlen($value) > $amount) {
        return 'You exceeded the maximal characters'.$amount;
    }
}
?>