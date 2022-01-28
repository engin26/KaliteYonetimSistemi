<?php

	class Url extends Defined{
	
		public static function GET($val)
		{
                    if(is_numeric($_GET[$val]))
                    {
                        $resultA = intval($_GET[$val]);
                    }
                    else
                    {
                        $resultA = strip_tags($_GET[$val]);
                    }
                    return $resultA;
		}
		public static function POST($val)
		{
                    if(is_numeric($_POST[$val]))
                    {
                        $resultA = intval($_POST[$val]);
                    }
                    else
                    {
                        $resultA = ($_POST[$val]);
                    }
                    return $resultA;
		}	
	}
?>