<?php 
require 'src/boot.php'; 
require 'header.php';
	//check if user is logged in
	if (!empty($_SESSION['id_user'])) {
		require 'home.php';
	} else {
		require 'login.php';
	}
require 'footer.html'; 
?>