

<?php 
	require 'src/boot.php'; 
	require 'header.php';
?>

	<?php

		if (!empty($_SESSION['id_user'])) {
			require 'home.php';
		} else {
			require 'login.php';
		}

	?>

<?php 
	require 'footer.html'; 
?>