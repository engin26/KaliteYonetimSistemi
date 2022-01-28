<?php
	class TempLog extends Session{
				public $TableID;
				
				public function TempLogInsert($TableID, $Status, $String)
				{
				   $this->TableID = $TableID;
                   
				   $data = array(
                       "UserID"     =>  Session::getSession('userID'),
                       "TableID"    =>  $TableID,
                       "String"     =>  $String,
                       "Status"     =>  $Status,
                       "IP"         =>  $_SERVER['REMOTE_ADDR'],
                       "USER_AGENT" =>  $_SERVER['HTTP_USER_AGENT']
                   );
                   
				   DB::insert("TempLog", $data);
				   
				   TempLog::TempLogDelete();
                }
                public function TempLogDelete()
                {
					$result = $this->connect->prepare("DELETE FROM TempLog WHERE UserID = ? AND TableID = ?");
					$result->execute(array(Session::getSession('userID'), $this->TableID));					
				}
	}
?>