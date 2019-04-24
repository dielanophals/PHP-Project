<?php

require_once("bootstrap.php");
// check if all fields have input

if(!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    if ( $password == $passwordConfirmation ) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        
        if ( $user->register() ) {
            $x = $_SESSION['userID'] = $user->getUserID();
            header("Location: index.php");
		} else {
            $errLogin = true;
        }
    } else {
        $errPwd = true;
    }

    //if bool true >> go to homepage
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
        <?php if ( isset($errPwd) ): ?>
            <div class="form__error">
                <p>Password is incorrect.</p>
            </div>
        <?php endif; ?>
        <?php if ( isset($errLogin) ): ?>
            <div class="form__error">
                <p>Login failed.</p>
            </div>
        <?php endif; ?>

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