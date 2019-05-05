<?php
	require('../bootstrap.php');

	if(!empty($_GET)){
		//Check of er op iets gezocht moet worden
			//=> waarschijnlijk posts klasse gebruiken om alle posts te krijgen
			//=> waarschijnlijk eerder zoekfunctie gebruiken om door de resultaten te loppen
		//Zo niet toon alles

		try{
			//looking for certain result depending on search

            $result = [
                "status" => "success",
                "result" => $search
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