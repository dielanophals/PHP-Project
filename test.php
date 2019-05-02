<?php
    require_once("bootstrap.php");
    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }

	if(!empty($_GET['search'])){
		$search = $_GET['search'];
	}

	//Properly redirect to previous page.
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
    	$previous = $_SERVER['HTTP_REFERER'];
	}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>InstaPet - Search</title>
    <style>

      a.post-image {
        text-decoration: none;
      }

      .hide {
        display: none;
      }

      .searchPost {
        margin-bottom: 20px;
      }

      .likes {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
      }

      span.like-btn {
        cursor: pointer;
        padding: 10px;
        font-size: 2em;
        color: red;
      }

      span.likes-count {
        text-decoration: none;
        color: #333;
      }

      .edit__options {
        visibility: hidden;
      }

      .edit__options,
      .fa-ellipsis-h,
      .option--delete,
      .option--edit {
        color: black;
        font-size: 1em;
        text-decoration: none;
      }

      .edit__options form {
        margin: 5px 0 10px;
      }

      .form--delete,
      .form--edit {
        display: none;
      }
    </style>
</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>

    <?php
$api_key = "e2d2e2e24294fe4b91a4ed0d521d2539";
$freegeoipjson = file_get_contents("http://api.ipstack.com/193.191.150.3?access_key=e2d2e2e24294fe4b91a4ed0d521d2539");

$jsondata = json_decode($freegeoipjson);

$countryfromip = $jsondata->country_name;
$cityfromip = $jsondata->city;

echo "City: ". $cityfromip ."";
echo "<br/>";
echo "Country: ". $countryfromip ."";
?>
	<!--If there is a search for color X, show posts with the same color. -->
    <?php if(!empty($_GET['color'])): ?>
		<?php $posts = Color::searchPostsByColor($_GET['color']); ?>
		<?php foreach($posts as $post): ?>
			<?php $result = Post::getPostById($post["posts_id"]);?>
			<?php foreach($result as $r):?>
				<a href="?image=<?php echo $r["id"]; ?>">
                    <div id="<?php echo $r["id"]; ?>" class="post">
                		<img class="post__img" src="<?php echo $r["image"]; ?>">
					</div>
                </a>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<!--Pop up sceen-->
	<?php if(!empty($_GET['image'])): ?>
		<?php $post = new Post(); $post->showImage($_GET['image']);?>
		<?php foreach($post->showImage($_GET['image']) as $p): ?>
			<div class="popup">
				<div class="post">
          <?php
            $information = User::getUserInfo($p['user_id']);
            $name = $information['firstname'] . ' ' . $information ['lastname'];
          ?>
          <a class="popup_name" href="friend.php?id=<?php echo $p['user_id'] ?>"><?php echo $name; ?></a>
					<img src="<?php echo $p['image']; ?>">
					<!--Show the colors of the image. -->
					<div class="color">
						<?php $c = Color::getColors($p['id']); ?>
                        <!--Loop through all colors to display them from highest value to lowest.-->
                        <?php foreach($c as $key => $value): ?>
                            <!--Only show found colors.-->
                            <?php if($value != 0): ?>
                                <a href="search.php?search=0&color=<?php echo $key?>">
                                    <div class="color__item color__item--<?php echo $key; ?>"></div>
                                </a>
                            <?php endif; ?>
						<?php endforeach; ?>
					</div>
					<p><?php echo $p['description']; ?></p>
				</div>
				<a href="<?php echo $previous; ?>" class="close">X</a>';
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script src="js/like.js"></script>
<script src="js/edit.js"></script>
</body>
</html>
