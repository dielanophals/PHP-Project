<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

    $id = $_SESSION['userID'];
    $list = Friend::getListOfFriendsIds($id);
    
    $limit = 20;
    if(empty($list)){
        $err_posts = false;
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
    <title>InstaPet - Feed</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <main class="grid">
        <?php if(isset($err_posts)): ?>
            <p>No posts to display of your friends.</p>
        <?php endif; ?>
        <!--in id the id of the post is displayed, in case of detail page that needs to be shown.-->
        <?php foreach($list as $key => $value): ?>
            <?php
                $posts = Show::getFriendsPosts($value, $limit);
                foreach($posts as $k => $v):
            ?>
                <img src="<?php echo $v["image"]; ?>">
            <?php endforeach; ?>
        <?php endforeach; ?>
    </main>
    <footer>
        <div class="btnFeedback">
            <button class="feedback">Load more</button>
        </div>
    </footer>
</body>
</html>