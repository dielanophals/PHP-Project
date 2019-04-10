<?php
require_once("classes/User.class.php");

// check if all fields have input
if(!empty($_POST)) {
    $user = new User();

    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setPasswordConfirmation($_POST['password_confirmation']);
    
    $result = $user->register();
    var_dump($result);
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InstaPet - Register</title>
</head>
<body>
    <form action="" method="post">
        <h2 form__title>Sign up for an account</h2>

                <p>
                    Some error here.
                </p>

            <div class="form__field">
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="form__field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form__field">
                <label for="password_confirmation">Confirm your password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form__field">
                <input type="submit" value="Sign me up!" class="btn btn--primary">  
            </div>
    </form>




</body>
</html>
