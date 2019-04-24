<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

    //check if there is an update
	if(!empty($_POST))
	{
		try {
            //make a new comment
            $comment = new Comment();
            //set the text of the comment
            $comment->setText($_POST['comment']);
            //save the comment
			var_dump($comment->Save());
            
            //prog.enhancement
            //graceful.degradation
            
		} catch (\Throwable $th) {
			//throw $th;
		}
	}
	
	//always get last activity updates
	$comments = Comment::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <title>InstaPet - Feed</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>

    <input type="text" placeholder="Write a comment" id="comment" name="comment" />
	<input id="btnSubmit" type="submit" value="Add comment" />
		
		<ul id="listupdates">
        <?php 
            // making a list of comments
			foreach($comments as $c) {
					echo "<li>". $c->getText() ."</li>";
			}

		?>
		</ul>

</body>
</html>