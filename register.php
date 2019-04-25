<?php
require_once("classes/User.class.php");
require_once("bootstrap.php");

// check if all fields have input
if(!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['password_confirmation'];

    //Both email and password empty.
    if(empty($email) && empty($password)){
        $errEmail = true;
        $errPassword = true;
    }
    //Only email is empty.
    else if(empty($email)){
        $errEmail = true;
    }
    //Only password is empty.
    else if(empty($password)){
        $errPassword = true;
    }
    //Only c_password is empty
    else if(empty($c_password)){
        $errCPassword = true;
    }
    //Password and confirm password aren't the same
    else if($password != $c_password){
        $errPassws = true;
    }
    //Everything is filled in.
    else{
        $user = new User();
    
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setPasswordConfirmation($_POST['password_confirmation']);
    
        $result = $user->preregister();
        //var_dump($result);
        //if bool true >> go to homepage
        if($result === true){
            header("Location: index.php");
        } 
        else {
            $err = true;
        }
    }
}


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
    <form action="" method="post" class="register">
        <h2>Sign up for an account</h2>
        <?php if(isset($errEmail) && isset($errPassword)): ?>
            <div>
                <p>Both fields can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errEmail) && !isset($errPassword)): ?>
            <div>
                <p>The email address you gave can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errPassword) && !isset($errEmail)): ?>
            <div>
                <p>The password you gave can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errCPassword) && !isset($errEmail) && !isset($errPassword)): ?>
            <div>
                <p>The confirming password you gave can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errPassws) && !isset($errEmail) && !isset($errPassword) && !isset($errCPassword) ): ?>
            <div>
                <p>The passwords you gave aren't the same.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($err)): ?>
            <div>
                <p>The email address and/or password you entered is invalid.</p>
            </div>
        <?php endif; ?>

            
                <label for="email">Email</label>
                <input type="text" id="email" name="email"><br>
         
                <label for="password">Password</label>
                <input type="password" id="password" name="password"><br>
         
                <label for="password_confirmation">Confirm your password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"><br>
          
                <input type="submit" value="Sign me up!" class="btn btn--primary">  
          
    </form>




</body>
</html>
