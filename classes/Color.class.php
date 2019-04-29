<?php
	Abstract class Color{
		/*
		*	Use the color detection library to search for all the color values based on the url of the image.
		*	Return them back to the page.
		*/
		public static function getColors($url){
			$findColors = Self::findColors($url);
			$filteredColors = Self::filterColors($findColors);
			return $filteredColors;
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
		*	Sort the colors in descending order.
		*	Remove values of 0.
		*	Return result.
		*/
		public static function filterColors($c){
			arsort($c); //sort value in descending order
			$arr = array_filter($c); //remove all colours which are not found i.e. 0
			return $arr;
		}

		public static function searchPostsByColor($color){
			//search it in database
		}

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