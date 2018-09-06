<?php 
	require 'src/boot.php'; 
	require 'header.php';
	ini_set('display_errors', 'On');
?>

<?php
	if (empty($_SESSION['id_user'])) {
		header('Location: index.php');
	} else {
		$user->get_user_info($_SESSION['id_user']);
	}
?>
</br>
<div class="row">
	<div class="container col-sm-4 updateArea">
	  	<form class="form-group" id="updateEmail" method="POST" action="forms/updatehandler.php">
		    <label for="email">Email:</label>
		    <input type="email" class="form-control" id="email" name="email" value="<?php echo ($user->get_email()); ?>"  />
			</br>
		    <input id="updateBtn" class="btn btn-primary" type="submit" name="updateEmail" value="Change email">
	  	</form>
	</div>
</div>
</br>
<div class="row">
	<div class="container col-sm-4 updateArea">
		<form class="form-group" id="updateName" method="POST" action="forms/updatehandler.php">
			<label for="firstname">First name:</label>
		    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo ($user->get_firstname()); ?>" />

		    <label for="suffix">Suffix:</label>
		    <input type="test" class="form-control" id="suffix" name="suffix" value="<?php echo ($user->get_suffix()); ?>" />

		    <label for="lastname">Last name:</label>
		    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo ($user->get_lastname()); ?>" />
		    </br>
		    <input id="updateBtn" class="btn btn-primary" type="submit" name="updateName" value="Change name">
		</form>
	</div>
</div>
</br>
<div class="row">
	<div class="container col-sm-4 updateArea">
		<form class="form-group" id="updatePassword" method="POST" action="forms/updatehandler.php">
			<label for="password">Password:</label>
		    <input type="test" class="form-control" id="password" name="password" placeholder="password" />

		    <label for="password_verify">Verify password:</label>
		    <input type="test" class="form-control" id="password_verify" name="password_verify" placeholder="password verification" required/>
		    </br>
		    <input id="updateBtn" class="btn btn-primary" type="submit" name="updatePassword" value="Change password">
		</form>
	</div>
</div>
</br>
<div class="row">
	<div class="container col-sm-4 ">
		<form class="form-group" id="deleteForm" method="POST" action="forms/updatehandler.php">
			<input id="deleteBtn" class="btn btn-danger" type="submit" name="deleteAcc" value="Permanently delete account">
		</form>
	</div>
</div>
<?php 
	require 'footer.html'; 
?>