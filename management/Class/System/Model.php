<?php
	class Model extends Defined{
		
		public static function loadSystem($file)
		{
			include Defined::PATH_CLASS_SYSTEM.$file.'.php';
		}
		public static function load($file)
		{
			include 'Class/'.$file.'.php';
		}
	}
?>