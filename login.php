<?php
    require_once("bootstrap.php");

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

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
        //Everything is filled in.
        else{
            $u = new User();
            $isLogged = $u->login($email, $password);

            //Check if user can log in.
            if($isLogged){
                Session::create();
                $_SESSION['userID'] = $u->userID();
                header("Location: index.php");
            }
            //Unable to log in.
            else{
                $err = true;
            }
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
    <title>InstaPet - Login</title>
</head>
<body>
    <form action="" method="post" class="login">
        <h2>Sign in</h2>
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
        <?php if(isset($err)): ?>
            <div>
                <p>The email address and/or password you entered is invalid.</p>
            </div>
        <?php endif; ?>
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" value="Sign in"><br>
        <input type="checkbox"><label for="rememberMe" id="submit">Remember me</label>
    </form>
</body>
</html>
