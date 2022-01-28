<?php
	class DB extends Config
	{
		public $connect;

		public $SelectColumn;
		public $Name;
		public $Table;
		public $WhereColumn;
		public $WhereOperator;
		public $WhereNumber;
		public $WhereAnd;
		public $WhereAndColumn;
		public $WhereAndOperator;
		public $WhereAndNumber;
		public $OrderColumn;
		public $OrderAS;
		public $Where;
		public $InWhere;
		public $InID;
		public $Limit;
		public $Result;
		public $sql;

		public function __construct()
		{
			parent::__construct();

			$this->connect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}

		function SQL_INJECTION_SLASHES($str)
		{
			$str = str_replace('SELECT', '', $str);
			$str = str_replace('select', '', $str);
			$str = str_replace('LIMIT', '', $str);
			$str = str_replace('limit', '', $str);
			$str = str_replace('DELETE', '', $str);
			$str = str_replace('delete', '', $str);
			$str = str_replace('from', '', $str);
			$str = str_replace('FROM', '', $str);
			$str = str_replace(' OR ', '', $str);
			$str = str_replace(' AND ', '', $str);
			$str = str_replace(' or ', '', $str);
			$str = str_replace(' and ', '', $str);
			$str = str_replace(' OR ', '', $str);
			$str = str_replace(' UPDATE ', '', $str);
			$str = str_replace(' update', '', $str);
			$str = str_replace('"', '', $str);
			return addslashes($str);
		}
		function SQL_INJECTION($str)
		{
			$str = str_replace('SELECT', '', $str);
			$str = str_replace('select', '', $str);
			$str = str_replace('LIMIT', '', $str);
			$str = str_replace('limit', '', $str);
			$str = str_replace('DELETE', '', $str);
			$str = str_replace('delete', '', $str);
			$str = str_replace('from', '', $str);
			$str = str_replace('FROM', '', $str);
			$str = str_replace(' OR ', '', $str);
			$str = str_replace(' AND ', '', $str);
			$str = str_replace(' or ', '', $str);
			$str = str_replace(' and ', '', $str);
			$str = str_replace(' OR ', '', $str);
			$str = str_replace(' UPDATE ', '', $str);
			$str = str_replace(' update', '', $str);
			return ($str);
		}
		function XSS_CLEAN($str)
		{
			if(is_array($str))
			{
				foreach($str as $row)
				{
					$return[] = strip_tags($row);
				}
			   return $return;
			}
			else
			{
				return strip_tags($str);
			}
		}
		function HTML_CLEAN($str)
		{
			if(is_array($str))
			{
				foreach($str as $row)
				{
					$return[] = htmlentities($str);
				}
			}
			else
			{
				return htmlentities($str);
			}
		}
		function SPACE_CLEAN($str)
		{
			if(is_array($str))
			{
				foreach($str as $row)
				{
					$return[] = trim($str);
				}
			}
			else
			{
				return trim($str);
			}
		}
		function CLEAN_DATA($str)
		{
			return DB::SPACE_CLEAN(DB::SQL_INJECTION((DB::XSS_CLEAN($str))));
		}
		public function insert($table, $array)
		{

			$columns = implode(", ", array_keys($array));
			$values  = array_values($array);
			$valCount = count($values);
			$str = '?';
			$str .= str_repeat(", ?", $valCount-1);

			$sql = "INSERT INTO ".$table."(".$columns.") VALUES (".$str.")";
			$results = $this->connect->prepare($sql);

			try {


				if (!$results->execute($values)) {
					print_r($results->errorInfo());exit;
				}
				return $this->connect->lastInsertId($table);

			} catch(PDOException $e) {

				return "Error : " . $e->getMessage() . "</br>";
			}
		}
		public function update_numeric($table, $array, $Maths=false, $Where)
		{
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			if($Maths == false)
			{
				for($i=0;$i<count($columns);$i++)
				{
					if($i==count($columns)-1)
					{
						$sqlString .= $columns[$i]." = '".$values[$i]."' ";
					}
					else
					{
						$sqlString .= $columns[$i]." = '".$values[$i]."', ";
					}
				}
			}
			else
			{
				for($i=0;$i<count($columns);$i++)
				{
					$sqlString .= $columns[$i]." = ".$values[$i]."";
				}
			}

			$sql = "UPDATE ".$table." SET ".$sqlString." WHERE ".$Where;

			try{
				$result = $this->connect->query($sql);
				if($result)
					return 1;
			} catch(PDOException $e){
					return 0;
			}
		}
		function update($tablo, $veriler, $where="")
		{
			$sonuc = "";
			$alan = "";
			foreach ($veriler as $anahtar => $deger) $alan .= $anahtar . "= :".$anahtar.",";
			$alan = substr($alan,0,strlen($alan)-1);
			if($where!="") $where = " WHERE ".$where;

			$query = $this->connect->prepare("UPDATE ".$tablo." SET ".$alan.$where);
			$update = $query->execute($veriler);
			if(!$update){
print_r($query->errorInfo());
				exit;
			}
			return $update;
		}
		function delete($Table, $Where)
		{
			$result = $this->connect->query("DELETE FROM ".$Table." WHERE ".$Where);
			if($result)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		public  function select($SelectColumn)
		{
			$this->SelectColumn = $SelectColumn;
			$this->SelectColumn = "SELECT ".$SelectColumn." FROM";

		}
		public function table($Table)
		{
			$this->Table = $Table;
			$this->Table = $this->Table;
		}
		public function view($view)
		{
			$this->Table = 'vw_'.$view;
		}
		public  function where($WhereColumn, $WhereOperator, $WhereNumber)
		{
			$this->WhereColumn = $WhereColumn;
			$this->WhereOperator = $WhereOperator;
			$this->WhereNumber = $WhereNumber;
			$this->Where = "WHERE ".$this->WhereColumn." ".$this->WhereOperator." ". "'".$this->SQL_INJECTION($this->WhereNumber)."'";
		}
		public  function where_and($WhereAndColumn, $WhereAndOperator, $WhereAndNumber)
		{
			$this->WhereAndColumn = $WhereAndColumn;
			$this->WhereAndOperator = $WhereAndOperator;
			$this->WhereAndNumber = $WhereAndNumber;
			$this->WhereAnd = "AND ".$this->WhereAndColumn." ".$this->WhereAndOperator." ". "'".$this->SQL_INJECTION($this->WhereAndNumber)."'";
		}
		public  function in($InID, $InWhere)
		{
			$this->InWhere = $InWhere;
			$this->InID = $InID;

			$this->InWhereColumn = "WHERE ".$InID." IN(".$InWhere.")";
		}
		public function update_in($table, $InWhereColumn, $data)
		{
			$sql = "UPDATE ".$table." SET ".$data." ".$InWhereColumn;
			$result = $this->connect->query($sql);
		}

		public  function where_array($WHERE)
		{
			extract($WHERE);
			$this->Where = " WHERE ".$WHERE;
		}
		public  function order_by($OrderColumn, $OrderAS)
		{
			$this->OrderColumn = "ORDER BY ".$OrderColumn;
			$this->OrderAS = $OrderAS;
		}
		public  function limit($Start, $Stop)
		{
			$this->Limit = " LIMIT ".$Start.", ".$Stop;
		}
		public  function rowCounts()
		{
			$result = $this->connect->query($sql);

			$count = ($result->rowCount());

			return $count;
		}
		public function query($sql)
		{
			$this->sql = $sql;

			$this->connect->query($this->sql);
			return $this->connect->lastInsertId($table);
		}
		public  function getIn()
		{
			/* tablodan eşleşen kayıttan sadece bir tanesini döndürür */
			$line = array();
			if($this->InWhereColumn != '')
			{
				$this->sql = $this->SelectColumn." ".$this->Table." ".$this->InWhereColumn." ".$this->WhereAnd;

				$result = $this->connect->query($this->sql);
				while($lineArray = $result->fetch(PDO::FETCH_OBJ))
				{
					$line[] = $lineArray;
				}
				return $line;

			}
		}
		public function get()
		{
			/* tablodan eşleşen kayıttan sadece bir tanesini döndürür */
			$sql = $this->SelectColumn." ".$this->Table." ".$this->Where." ". $this->OrderColumn." ".$this->OrderAS." ". $this->Limit;

			$result = $this->connect->query($sql);
			if($result->rowCount() != 0)
			{
				$line = $result->fetch(PDO::FETCH_OBJ);
			}
			else
			{
				$line = 0;
			}

			$this->SelectColumn = '';
			$this->Table = '';
			$this->Where = '';
			$this->OrderColumn = '';
			$this->OrderAS = '';
			$this->Limit = '';

			return $line;
		}

		public function getAll()
		{
			/* tablodan eşlesen kayıtlardan hepsini döndürür */
			$line = array();
			$sql = $this->SelectColumn." ".$this->Table." ".$this->Where." ". $this->OrderColumn." ".$this->OrderAS." ". $this->Limit;

			$result = $this->connect->query($sql);
			while($lineArray = $result->fetch(PDO::FETCH_OBJ))
			{
				$line[] = $lineArray;
			}
			$this->SelectColumn = '';
			$this->Table = '';
			$this->Where = '';
			$this->OrderColumn = '';
			$this->OrderAS = '';
			$this->Limit = '';
			return $line;
		}
		public function procedure($ProcedureName)
		{
			/* tablodan eşleşen kayıttan hepsini döndürür */

			$line = array();
			/* tablodan eşleşen kayıttan hepsini döndürür */
			$this->sql = "CALL ". $ProcedureName;
			$result = $this->connect->query($this->sql);
			while($lineArray = $result->fetch(PDO::FETCH_OBJ))
			{
				$line[] = $lineArray;
			}
			return $line;
		}
		function __destruct()
		{
			$this->connect = null;
		}
	}
?>
