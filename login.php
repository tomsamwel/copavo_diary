<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$user->connect();
	$user->login($_POST["email"], $_POST["password"]);
	if (!empty($_SESSION['id_user'])) {
		header('Location: index.php');
	} else {
		echo $user->get_error();
	}
}
?>
</br>
<div class="row">
	<div class="container col-sm-4">
		<form class="form-group" id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="email" required />

			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="password" required />
			</br>
			<button id="loginBtn" class="btn btn-primary" type="submit" name="login">Log in</button>
		</form>
		<a href="register.php">Register</a>
	</div>
</div>