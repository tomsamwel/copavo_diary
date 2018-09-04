

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
  <div class="container">
    <form class="form-group" id="register" method="POST" action="forms/registerhandler.php">

      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="email" required />

      <label for="firstname">First name:</label>
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" />

      <label for="suffix">Suffix:</label>
      <input type="suffix" class="form-control" id="suffix" name="suffix" placeholder="Suffix" />

      <label for="lastname">Last name:</label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" />

      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="password" required/>

      <label for="password_verify">Password:</label>
      <input type="password" class="form-control" id="password_verify" name="password_verify" placeholder="password verification" required/>

      <input id="registerBtn" class="btn btn-primary" type="submit" name="register" value="register">
    </form>
  </div>
</body>
</html>


