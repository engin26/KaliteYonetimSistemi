<?php
	class Users extends Library{
	
		public $UserID;
		public $CityID;
		public $UserTypeID;
		public $UserCode;
		public $UserName;
		public $SurName;
		public $Email;
		public $Password;
		public $AgainPassword;
		public $Institution;
		public $ExpertiseStartDate;
		public $UseName;
		public $Gender;
		public $DOB;
		public $Level;
		public $LastLogin;
		public $Status;
		public $Online;
		public $UsersApproval;
		public $Archive;
		public $CreatedDate;
		public $Time;
		
		public $Rand;
		public $OutPutMessageError;
		public $OutPutMessageSuccess;

		function AutoLogin($UserID, $Password) // Session->UserID ve Session->Password Çıktısıyla kontrol yapar.
		{
			$this->UserID = $UserID;
			$this->Password = $Password;			
			
			if(!empty($this->UserID) && (!empty($this->Password)))
			{
				$result = $this->connect->prepare("SELECT ID, UserCode, UserTypeID,  UserName, SurName, Email, Password, Level, LastLogin, Status, Online, UsersApproval, Time FROM users WHERE ID = ? AND Password = ?  AND ISDELETED = 0 LIMIT 0,1;");
				$result->execute(array($this->UserID, $this->Password));
				$line = $result->fetch(PDO::FETCH_OBJ);
				
				if(count($line) != 0)
				{
						if($line->ID == $this->UserID && $line->Password == $this->Password)
						{
							if($line->Status == 1)
							{
								if($line->UsersApproval == 1)
								{
									$_SESSION['userID'] = $line->ID;
									$_SESSION['loggedin'] = $line->UserName;
									$_SESSION['userTypeID'] = $line->UserTypeID;
                                    
									$this->UserID 	= $line->ID;
									$this->UserCode = $line->UserCode;
									
									$this->String = "Giriş Yaptı";
				
									//TempLog::TempLogInsert("19", "1", $this->String);
                                    
									$this->UsersSetLastLogin();
								}
								else
								{
									print "Yönetici Tarafından Onay Bekleniyor...";
									exit();
								}
							}
							else
							{
								print "Şuanda Pasif Durumdasınız.!!!";
								exit();
							}
						}
						else
						{
							print "Böyle Bir Kullanıcı Yoktur.!!!";
							exit();
						}
				}
				else
				{
					print "Böyle Bir Kullanıcı Yoktur.!!!";
					exit();
				}
			}
			else
			{
				print "Boş Bırakmayınız";
				exit();
			}
		}

		function LoginControl($Email, $Password)
		{
			$this->Email = DB::CLEAN_DATA($Email);
			$this->Password = md5($Password);			
			
			if(!empty($this->Email) && (!empty($this->Password)))
			{
				$result = $this->connect->prepare("SELECT ID, UserCode, UserTypeID,  UserName, SurName, Email, Password, Level, LastLogin, Status, Online, UsersApproval, Time FROM users WHERE Email = ? AND Password = ?  AND ISDELETED = 0 LIMIT 0,1;");
				$result->execute(array($this->Email, $this->Password));
				$line = $result->fetch(PDO::FETCH_OBJ);
				
				if(count($line) != 0)
				{
						if($line->Email == $this->Email && $line->Password == $this->Password) 
						{
							if($line->Status == 1)
							{
								if($line->UsersApproval == 1)
								{
									$_SESSION['userID'] = $line->ID;
									$_SESSION['loggedin'] = $line->UserName;
									$_SESSION['userTypeID'] = $line->UserTypeID;
                                    
									$this->UserID 	= $line->ID;
									$this->UserCode = $line->UserCode;
									
									$this->String = "Giriş Yaptı";
				
									//TempLog::TempLogInsert("19", "1", $this->String);
                                    
									$this->UsersSetLastLogin();
								}
								else
								{
									print "Yönetici Tarafından Onay Bekleniyor...";
									exit();
								}
							}
							else
							{
								print "Şuanda Pasif Durumdasınız.!!!";
								exit();
							}
						}
						else
						{
							print "Böyle Bir Kullanıcı Yoktur.!!!";
							exit();
						}
				}
				else
				{
					print "Böyle Bir Kullanıcı Yoktur.!!!";
					exit();
				}
			}
			else
			{
				print "Boş Bırakmayınız";
				exit();
			}
		}
		public function UsersSetLastLogin()
		{
			// Kullanıcının En Son Girdiği Time() $_SESSION['userID']'den gelerek güncellenecek.
          
            $this->connect->query("UPDATE users SET LastLogin = '".time()."' WHERE ID = '".$this->UserID."'");
		}
		public function UsersList()
		{
			$result = $this->connect->query("SELECT Users.ID, City.Name AS CityName, UserType.ID AS UserTypeID, UserType.Name AS UserTypeName, Users.UserCode, Users.UserName, Users.SurName, Users.Email, Users.Institution, Users.ExpertiseStartDate, Users.UseName, Users.Gender, Users.DOB, Users.Level, Users.LastLogin, Users.Status, Users.UsersApproval, Users.CreatedDate FROM users INNER JOIN UserType ON UserType.ID = Users.UserTypeID LEFT JOIN City ON City.ID = Users.CityID WHERE Users.ISDELETED = '0' ORDER BY Users.CreatedDate DESC");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function UserTypeList()
		{
			$result = $this->connect->query("SELECT ID, Name FROM userType WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function UsersFindID($ID)
		{
			$result = $this->connect->prepare("SELECT Users.ID, City.Name AS CityName, UserType.ID AS UserTypeID, Users.UserCode, Users.UserName, Users.SurName, Users.Email, Users.Institution, Users.ExpertiseStartDate, Users.UseName, Users.Gender, Users.DOB, Users.Level, Users.LastLogin, Users.Status, Users.UsersApproval, Users.CreatedDate FROM users INNER JOIN UserType ON UserType.ID = Users.UserTypeID LEFT JOIN City ON City.ID = Users.CityID WHERE Users.ISDELETED = '0' AND Users.ID = ?");
			$result->execute(array($ID));
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function UsersDetails($ID)
		{
			$result = $this->connect->prepare("SELECT Users.ID, City.ID AS CityID, City.Name AS CityName, UserType.ID AS UserTypeID, UserType.Name AS UserTypeName, Users.UserCode, Users.UserName, Users.SurName, Users.Email, Users.Institution, Users.ExpertiseStartDate, Users.UseName, Users.Gender, Users.DOB, Users.Level, Users.LastLogin, Users.Status, Users.UsersApproval, Users.CreatedDate FROM users INNER JOIN UserType ON UserType.ID = Users.UserTypeID LEFT JOIN City ON City.ID = Users.CityID WHERE Users.ISDELETED = '0' AND Users.ID = ?");
			$result->execute(array($ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function UsersDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM Users WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE users SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage =  ViewReports::Success("Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata");
			}
		}
		public function EmailCounts($Email)
		{
			$result = $this->connect->prepare("SELECT COUNT(Email) AS Counts FROM users WHERE Email = :Email");

			$parameter = array(":Email"	=> $Email);

			$result->execute($parameter);

			$line = $result->fetch(PDO::FETCH_OBJ);

			return $line->Counts;
		}
		public function UseNameCounts($UseName)
		{
			$result = $this->connect->prepare("SELECT COUNT(UseName) AS Counts FROM users WHERE UseName = :UseName");

			$parameter = array(":UseName"	=> $UseName);

			$result->execute($parameter);

			$line = $result->fetch(PDO::FETCH_OBJ);

			return $line->Counts;
		}
		public function UsersAdd()
		{
			$EmailCounts = $this->EmailCounts($this->Email);
			$UseNameCounts = $this->UseNameCounts($this->UseName);

			if($EmailCounts != 0)
			{
				$this->OutPutMessageError[] =  ViewReports::Error("Girdiğiniz E-mail Adresi Daha Önce Kaydedilmiş.");
			}
			if($UseNameCounts != 0)
			{
				$this->OutPutMessageError[] =  ViewReports::Error("Girdiğiniz Kullanıcı Adı Daha Önce Kaydedilmiş.");
			}
			
			
			if(count($this->OutPutMessageError) == 0)
			{
				$data = array(
						"UserTypeID"		=> $this->UserTypeID,
						"CityID"			=> $this->CityID,
						"UserName"			=> $this->UserName,
						"SurName"			=> $this->SurName,
						"Email"				=> $this->Email,
						"Password"			=> md5($this->Password),
						"Institution"		=> $this->Institution,
						"ExpertiseStartDate"=> $this->ExpertiseStartDate,
						"UseName"			=> $this->UseName,
						"UsersApproval"		=> $this->UsersApproval,
						"Status"			=> $this->Status,
						"CreatedDate"		=> date("Y-m-d H:i:s"),
				);

				$result = $this->insert("Users", $data, "ID=".$ID);
			
				if($result)
				{
					$this->OutPutMessageSuccess[] =  ViewReports::Success("Kullanıcı Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessageError[] =  ViewReports::Error("Düzenlemede Hata Oluştu");
				}
			}
		}
		public function UsersEdit($ID)
		{
			$ID = intval($ID);
			
			$data = array(
				"UserTypeID"		=> $this->UserTypeID,
				"CityID"			=> $this->CityID,
				"UserName"			=> $this->UserName,
				"SurName"			=> $this->SurName,
				"Email"				=> $this->Email,
				"Institution"		=> $this->Institution,
				"ExpertiseStartDate"=> $this->ExpertiseStartDate,
				"UseName"			=> $this->UseName,
				"UsersApproval"		=> $this->UsersApproval,
				"Status"			=> $this->Status,
			);

			if($this->Password != '')
			{
				if(strlen($this->Password) > 6)
				{
					if($this->Password == $this->AgainPassword)
					{
						$data['Password'] = md5($this->Password);
					}
					else
					{
						$this->OutPutMessageError[] =  ViewReports::Error("Şifreler Uyuşmuyor");
					}
				}
				else
				{
					$this->OutPutMessageError[] =  ViewReports::Error("Lütfen Minimum 6 Haneli Giriniz");
				}
			}

			$result = $this->update("Users", $data, "ID=".$ID);
			
			if($result)
			{
				$this->OutPutMessageSuccess[] =  ViewReports::Success("Kullanıcı Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessageError[] =  ViewReports::Error("Düzenlemede Hata Oluştu");
			}
		}
		public function UsersApproval($Status, $ID)
		{
			$ID = intval($ID);
			$Status = intval($Status);
			$lineUsers = $this->UsersFindID($ID);

			$System =$this->Settings(1);

			$result = $this->connect->prepare("UPDATE Users SET UsersApproval = ? WHERE ID = ?");
			$result = $result->execute(array($Status, $ID));
			

			if($result)
			{
				$SendMail = $lineUsers->Email;
				$Title = 'Üyeliğiniz Onaylandı - '.$System->Title;
				$Content = 'Merhaba '.$lineUsers->UserName." ". $lineUsers->SurName.'<br><br>'.$this->ucwords_tr($System->Title). '\'na yapmış oluğunuz site üyelik başvurunuz onaylanmıştır.';

				$this->SendMail($lineUsers->Email, $Title, $Content);
				$this->OutPutMessage =  ViewReports::Success("Üye Onaylandı");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata");
			}
		}
		public function CityList()
		{
			$result = $this->connect->query("SELECT ID, Code, Name FROM City ORDER BY Code ASC");
			$line = $result->fetchAll(PDO::FETCH_OBJ);

			return $line;
		}
	}
?>