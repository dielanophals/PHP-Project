<?php
require_once("bootstrap.php");

// check if all fields have input
if(!empty($_POST)) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['password_confirmation'];


    if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) ) {

        if ( !empty($_POST['password']) && !empty($_POST['password_confirmation']) ) {

            if ( $password == $c_password ) {
                
                $user = new User();
                $u = $user->isAccountAvailable($email);
                
                if ($u == 0) {
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
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
                $feedback = "You already have an account.";
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
        <?php if(isset($feedback)): ?>
            <div>
                <p><?php echo $feedback; ?></p>
            </div>
        <?php endif; ?>
        <?php if(isset($errLogin)): ?>
            <div>
                <p><?php echo $errLogin; ?></p>
            </div>
        <?php endif; ?>


                <label for="first_name">Firstname</label>
                <input type="text" id="firstname" name="firstname"><br>
            
                <label for="last_name">Lastname</label>
                <input type="text" id="lastname" name="lastname"><br>

                <label for="user_name">Username</label>
                <input type="text" id="username" name="username"><br>

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
