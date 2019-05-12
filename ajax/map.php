<?php
	require('../bootstrap.php');

	if(!empty($_GET)){
    //geen search => toon alles
    //wel search => toon correcte search
		try{
			//looking for certain result depending on search
            $posts = Posts::getSearchPosts($search);

            $result = [
                "status" => "success",
                "result" => $posts
            ];
        }
        catch(Throwable $t){
            $result = [
                "status" => "error",
                "result" => "Something went wrong."
            ];
        }
        
        echo json_encode($result);
	}