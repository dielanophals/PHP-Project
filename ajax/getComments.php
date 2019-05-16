<?php
require_once("../bootstrap.php");
Session::check();

$connect = Db::getInstance();

$query = "
SELECT comments.id, parent_comment_id, comments.user_id, users.username, comments.comment, comments.date 
FROM comments 
INNER JOIN users 
ON comments.user_id = users.id
WHERE parent_comment_id = '0' 
ORDER BY comments.id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT comments.id, parent_comment_id, comments.user_id, users.username, comments.comment, comments.date 
 FROM comments 
 INNER JOIN users 
 ON comments.user_id = users.id
 WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["id"], $marginleft);
  }
 }
 return $output;
}

?>
