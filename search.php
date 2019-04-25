<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }
    $search = $_GET['search'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <title>InstaPet - Search</title>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>

    <main class="search">
      <div class="container searched">
        <?php
        if(!empty($search)){
          $searchPosts = new Post();
          foreach($searchPosts->getSearchPosts($search) as $s):
            ?>

            <a href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>">
            <div class="searchPost" style="background:url('<?php echo $s['image']; ?>'); background-size: cover; background-position: center;">
            </div>
            </a>
            <?php
          endforeach;
        }
        ?>
      </div>
    </main>

    <?php
    if(!empty($_GET['image'])){
      $post = new Post();
      $post->showImage($_GET['image']);

      foreach($post->showImage($_GET['image']) as $p){
        echo '<div class="popup">';
        echo '<div class="post">';
        echo '<img src="' . $p['image'] . '">';
        echo '<p>' . $p['description'] . '</p>';
        echo '</div>';
        echo '<a href="search.php?search=' . $search . '" class="close">X</a>';
        echo '</div>';
      }
    }
     ?>
</body>
</html>
