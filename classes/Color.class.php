<?php
	Abstract class Color{
		/*
		*	Use the color detection library to search for all the color values based on the url of the image.
		*	Return them back to the page.
		*/
		public static function getColors($id){
			$findColors = Self::findColorsInDb($id);
			return $findColors;
		}

		/*
		* 	Search all the colors of the image url and return the found colors in an array.
		*	Return result.
		*/
		public static function findColors($url){
			$colorDetection = new ColorDetection();
			$c = $colorDetection->detectColors($url);
			return $c;
		}

		/* 
		*	Find the colors on the post image which was inserted when the post was uploaded.
		*	Return the found row. 
		*/

		public static function findColorsInDb($id){
			try{
				$conn = Db::getInstance();
				//Select only the colors.
				$statement = $conn->prepare("SELECT `red`,`orange`,`yellow`,`green`,`turquoise`,`blue`,`purple`,`pink`,`white`,`gray`,`black`,`brown`
				FROM `posts_color` WHERE posts_id = :id");
				$statement->bindParam(":id", $id);
				$statement->execute();
				$result = $statement->fetch(PDO::FETCH_ASSOC);
				return $result;
			}
			catch(Throwable $t){
				return false;
			}
		}

		/*
		*	Search in the database all posts which match the given color.
		*/

		public static function searchPostsByColor($color){
			try{
				$conn = Db::getInstance();
				$statement = $conn->prepare("SELECT posts_id FROM `posts_color` where not $color = 0 ORDER BY $color desc");
				$statement->execute();
				$result = $statement->fetchAll();
				return $result;
			}
			catch(Throwable $t){
				return false;
			}
		}

		/*
		*	Insert into the database the colors of the previously inserted post and its image.
		*/

		public static function insertIntoDB($id, $colorArr){
			try{
				$conn = Db::getInstance();
				$statement = $conn->prepare(
					"INSERT INTO `posts_color`(`posts_id`, `red`, `orange`, `yellow`, `green`, `turquoise`, `blue`, `purple`, `pink`, `white`, `gray`, `black`, `brown`, `active`)
					VALUES ($id, :red, :orange, :yellow, :green, :turquoise, :blue, :purple, :pink, :white, :gray, :black, :brown, 1)");
				foreach($colorArr as $key => &$value){
					$key = ":{$key}";
					$statement->bindParam($key, intval($value));
				}
				$statement->execute();
			}
			catch(Throwable $t){
				return false;
			}
		}
	}