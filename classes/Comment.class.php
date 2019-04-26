<?php
class Comment
{
    //string
    private $text;

    //get previous comments
	public static function getAll(){
        $conn = Db::getInstance();
        $result = $conn->query("select * from comments order by id asc");

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    //save the new comment
    public function Save(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into comments (post_id, user_id, text) values (:post_id, :user_id, :text)");
        // add post id
        $statement->bindValue(":post_id", 1);
        // add user id
        $statement->bindValue(":user_id", 1);
        // add string input, the comment itself
        $statement->bindValue(":text", $this->getText());
        return $statement->execute();        
    }

    //get function; $text is private
    public function getText()
    {
        return $this->text;
    }

    //set function; $text is private
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}