<?php

require_once("bootstrap.php");
// check if all fields have input

if(!empty($_POST)) {

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    if ( !empty($_POST['fName']) && !empty($_POST['lName']) && !empty($_POST['username']) ) {

        if ( !empty($_POST['password']) && !empty($_POST['password_confirmation']) ) {

            if ( $password == $passwordConfirmation ) {
                $user = new User();
                
                $user->setFirstname($fName);
                $user->setLastname($lName);
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($password);

                if ( $user->register() ) {
                    $x = $_SESSION['userID'] = $user->getUserID();
                    header("Location: index.php");
                } else {
                    $errLogin = "Login failed.";
                }
            } else {
                $feedback = "Password is incorrect.";
            }
        } else {
            $feedback = "Password cannot be empty.";
        }
    } else {
        $feedback = "Personal details cannot be empty.";
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <title>InstaPet - Register</title>
</head>
<body>
    <form action="" method="post">
        <h2 form__title>Sign up for an account</h2>
        <?php if ( isset($feedback) ): ?>
            <div class="form__error">
                <p><?php echo $feedback; ?></p>
            </div>
        <?php endif; ?>
        <div class="form__field">
            <label for="fName">First name</label>
            <input type="text" id="fName" name="fName">
        </div>
        <div class="form__field">
            <label for="lName">Last name</label>
            <input type="text" id="lName" name="lName">
        </div>
        <div class="form__field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
        </div>
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