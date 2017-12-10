<?php


	/**
	* 
	*/
	class Cleaner
	{
		
		public static function Clean($conn,$input){
			$input = filter_var($input,FILTER_SANITIZE_SPECIAL_CHARS);
			return $conn->real_escape_string($input);
		}
	}

?>