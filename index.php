
<!doctype html>
<?php require 'src/boot.php'; ?>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Diary</title>
	<meta name="description" content="A website for your diary">
	<meta name="author" content="Tom">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css">

	<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	

</head>

<body>
	<?php
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			$user = new User();
			$user->connect();
			$user->login($_POST["email"], $_POST["password"]);

		}
	?>
	<div class="container">
		<form class="form-group" id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="email" required />

			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="password" required />
			
			<input type="checkbox"  class="form-check" id="remember" name="remember" />
			<label for="remember">Remember password?</label>
			
			<button id="loginBtn" class="btn btn-primary" type="submit" name="login">Log in</button>
		</form>
		<a href="register.php">Register</a>
	</div>
</body>
</html>


