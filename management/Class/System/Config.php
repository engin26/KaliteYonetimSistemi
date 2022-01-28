


	<?php
			class Config{

				public 	$Driver = 'mysql';
				public 	$Host;
				public 	$DB;
				private $UserName;
				private $Password;

				public function  __construct()
				{
					error_reporting(0);
ini_set("display_errors",1);

						$this->Host 	= 'localhost';
						$this->UserName = 'root';
						$this->Password = '';
						$this->DB 		= 'kys';
						$this->URL 		= 'http://localhost/';
						$this->DEFAULT_DIR    = "";


					try
					{
						$this->connect = new PDO($this->Driver.":host=".$this->Host.";dbname=".$this->DB.";charset=utf8", "".$this->UserName."", "".$this->Password."");
						$this->connect->exec("set names utf8");
					}
					catch ( PDOException $e )
					{
						print $e->getMessage();
					}
				}
			}

	?>
