<?php 
require 'src/boot.php'; 
require 'header.php';
ini_set('display_errors', 'On');

if (empty($_SESSION['id_user'])) {
	header('Location: index.php');
} else {
	$user->get_user_info($_SESSION['id_user']);
}

//function to prevent dumping input fields
function value($key)
    {
        return @$_POST[$key];
    }

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateEmail'])) {
    	$variables = [
            'email' => ['required', 'email', 'min:7', 'max:155'],
    	];
    }elseif (isset($_POST['updateName'])) {
    	$variables = [
            'firstname' => ['required', 'name', 'min:2', 'max:50'],
            'suffix' => ['min:1', 'max:15', 'name'],
            'lastname' => ['required', 'name', 'min:2', 'max:50'],
    	];
    }elseif (isset($_POST['updatePassword'])) {
    	$variables = [
            'password' => ['required', 'min:8', 'max:100', 'confirmed'],
    	];
    }
    
    require 'forms/validations.php';

    if(count($errors) == 0) {
    	if (isset($_POST['deleteAcc'])) {
			$user->delete($_SESSION['id_user']);
		}else {
			$user->update($_SESSION['id_user']);
			header('Location: ../accountsettings.php');
		}
    }
}

?>
<?php if(@$errors || $user->get_error()) { ?>
    <div class="alert alert-danger">
        Oops, not everything is filled in correctly!
        </br>
        <?php echo $user->get_error(); ?>
    </div>
<?php } ?>
</br>
<div class="row">
	<div class="container col-sm-4 updateArea">
	  	<form class="form-group" id="updateEmail" method="POST" >
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
		<form class="form-group" id="updateName" method="POST" >
			<label for="firstname">First name:</label>
		    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo ($user->get_firstname()); ?>" />

		    <label for="suffix">Suffix:</label>
		    <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo ($user->get_suffix()); ?>" />

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
		<form class="form-group" id="updatePassword" method="POST" >
			<label for="password">Password:</label>
		    <input type="password" class="form-control" id="password" name="password" placeholder="password" />

		    <label for="password_confirmed">Verify password:</label>
		    <input type="password" class="form-control" id="password_confirmed" name="password_confirmed" placeholder="password verification" required/>
		    </br>
		    <input id="updateBtn" class="btn btn-primary" type="submit" name="updatePassword" value="Change password">
		</form>
	</div>
</div>
</br>
<div class="row">
	<div class="container col-sm-4 ">
		<form class="form-group" id="deleteForm" method="POST" >
			<input id="deleteBtn" class="btn btn-danger" type="submit" name="deleteAcc" value="Permanently delete account">
		</form>
	</div>
</div>
<?php 
	require 'footer.html'; 
?>