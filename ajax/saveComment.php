<?php
require_once("../bootstrap.php");
Session::check();

$connect = Db::getInstance();

$error = '';
$comment_name = '';
$comment_content = '';

//get the userID
$user_id = User::getUserID();
echo($user_id);

//check if there is content
if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

//if there's no errors then:
if($error == '')
{
 $query = "
 INSERT INTO comments 
 (parent_comment_id, comment, user_id)
 VALUES (:parent_comment_id, :comment, :user_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':user_id' => $user_id
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>