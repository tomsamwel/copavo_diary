<?php

ini_set('display_errors', 'on');
require '../src/boot.php'; 

if (isset($_POST['deleteAcc'])) {
	$user->delete($_SESSION['id_user']);
}else {
	$user->update($_SESSION['id_user']);
	header('Location: ../accountsettings.php');
}
