<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Diary</title>
	<meta name="description" content="A website for your diary">
	<meta name="author" content="Tom">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css">
	<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
	  	<a class="navbar-brand" href="index.php">Diary online</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls=	"navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarText">
	    	<ul class="navbar-nav mr-auto">
	      		<li class="nav-item active">
	        		<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
	     		 </li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="#">Features</a>
	      		</li>
	     		<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          	Account
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          	<a class="dropdown-item" href="#">My Diaries</a>
			          	<a class="dropdown-item" href="accountsettings.php">Settings</a>
			          	<div class="dropdown-divider"></div>
			          	<?php 
			          		if (! empty($_SESSION['id_user']))
								{
								    ?>

								    <a class="dropdown-item" href="src/logout.php">Log out</a>

								    <?php
								}
								else
								{
									?>
								    <a class="dropdown-item" href="index.php">Log in</a>
								    <?php
								}
			          	?>
			          	
			        </div>
			    </li>
	    	</ul>
	    	<span class="navbar-text">
	      		A beautiful day to log memories in your diary
	    	</span>
	  	</div>
	</nav>