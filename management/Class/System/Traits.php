<?php
	class Traits extends Defined{
	
		public static function load_traits($file)
		{
			include '../Traits/'.$file.'.php';
		}
	}
?>