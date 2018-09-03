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

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

</head>

<body>
	
	

	<div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign up</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <label for="lastname" class="sr-only">First name</label>
        <input type="text" id="inputFirstname" class="form-control" placeholder="First name" required>

        <label for="suffix" class="sr-only">Suffix</label>
        <input type="text" id="inputSuffix" class="form-control" placeholder="Suffix" >

        <label for="lastname" class="sr-only">Last name</label>
        <input type="text" id="inputLastname" class="form-control" placeholder="Last name" required>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Repeat password" required>
       
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
      </form>

    </div> <!-- /container -->

  	<script src=""></script>
</body>
</html>


