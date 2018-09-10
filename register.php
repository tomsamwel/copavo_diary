<?php 
require 'src/boot.php'; 
require 'header.php';

//function to prevent dumping input fields
function value($key)
{
    return @$_POST[$key];
}


$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //validations can be configured here
    $variables = [
        'email' => ['required', 'email', 'min:7', 'max:155'],
        'password' => ['required', 'min:8', 'max:100', 'confirmed'],
        'firstname' => ['required', 'name', 'min:2', 'max:50'],
        'suffix' => ['min:1', 'max:15', 'name'],
        'lastname' => ['required', 'name', 'min:2', 'max:50'],
    ];
    //validation handling
    require 'forms/validations.php';
    //check for errors
    if(count($errors) == 0) {
        //register new user
        $register = $user->register($_POST['email'], $_POST['firstname'], $_POST['suffix'], $_POST['lastname'], $_POST['password']);
        if ($register) {
            header('Location: index.php');
        }
    }
}   
?>
</br>
<div class="row">
    <div class="container col-sm-4">
    <?php if(@$errors || $user->get_error()) { //check if there are any errors, display them ?>
        <div class="alert alert-danger">
            Oops, not everything is filled in correctly!
            </br>
            <?php echo $user->get_error(); ?>
        </div>
    <?php } ?>
        <form class="form-group" id="register" method="POST">

            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo value('email'); ?>" required />
            <?php echo (@$errors['email']) ? '<p class="text-danger">'.$errors['email'][0].'</p>' : ''; ?>

            <label for="firstname">First name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?php echo value('firstname'); ?>" />
            <?php echo (@$errors['firstname']) ? '<p class="text-danger">'.$errors['firstname'][0].'</p>' : ''; ?>

            <label for="suffix">Suffix:</label>
            <input type="suffix" class="form-control" id="suffix" name="suffix" placeholder="Suffix" value="<?php echo value('suffix'); ?>" />
            <?php echo (@$errors['suffix']) ? '<p class="text-danger">'.$errors['suffix'][0].'</p>' : ''; ?>

            <label for="lastname">Last name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?php echo value('lastname'); ?>" />
            <?php echo (@$errors['lastname']) ? '<p class="text-danger">'.$errors['lastname'][0].'</p>' : ''; ?>

            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password" value="" required/>
            <?php echo (@$errors['password']) ? '<p class="text-danger">'.$errors['password'][0].'</p>' : ''; ?>

            <label for="password_verify">Verify password:</label>
            <input type="password" class="form-control" id="password_confirmed" name="password_confirmed" placeholder="password verification" value="" required/>
            <?php echo (@$errors['password_confirmed']) ? '<p class="text-danger">'.$errors['password_confirmed'][0].'</p>' : ''; ?>
            </br>
            <input id="registerBtn" class="btn btn-primary" type="submit" name="register" value="register">
        </form>
    </div>
</div>

<?php 
require 'footer.html'; 
?>
