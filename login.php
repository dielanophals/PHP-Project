<?php
    require_once("bootstrap.php");

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $u = new User();
        $isLogged = $u->login($email, $password);
        if($isLogged){
            Session::create();
            header("Location: index.php");
        }
        else{
            $err = true;
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
        <?php if(isset($err)): ?>
            <div>
                <p>The email address and/or password you entered is invalid.</p>
            </div>
        <?php endif; ?>
        <label for="email">Email</label>
        <input type="text" name="email">

        <label for="password">Password</label>
        <input type="password" name="password">

        <input type="submit" value="Sign in">
        <input type="checkbox"><label for="rememberMe">Remember me</label>
    </form>
</body>
</html>