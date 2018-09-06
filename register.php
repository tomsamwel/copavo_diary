<?php 
    require 'src/boot.php'; 
    require 'header.php';
?>
</br>
<div class="row">
    <div class="container col-sm-4">
      <form class="form-group" id="register" method="POST" action="forms/registerhandler.php">

        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="email" required />

        <label for="firstname">First name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" />

        <label for="suffix">Suffix:</label>
        <input type="suffix" class="form-control" id="suffix" name="suffix" placeholder="Suffix" />

        <label for="lastname">Last name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" />

        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="password" required/>

        <label for="password_verify">Verify password:</label>
        <input type="password" class="form-control" id="password_verify" name="password_verify" placeholder="password verification" required/>
        </br>
        <input id="registerBtn" class="btn btn-primary" type="submit" name="register" value="register">
      </form>
    </div>
</div>

<?php 
    require 'footer.html'; 
?>
