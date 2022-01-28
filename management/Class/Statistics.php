<?php 
	class Statistics extends DB{
		// Users
		public $OutPut_Users_MembersCount;
		public $OutPut_Users_ApprovalCount;
		public $OutPut_Users_Gender_Male_Count;
		public $OutPut_Users_Gender_Female_Count;
		public $OutPut_Users_DOB_AVG;
		
		
		// Orders
		public $OutPut_Orders_OrdersCount;
		public $OutPut_Orders_TotalPrice;
		public $OutPut_Orders_TotalCount;
		public $OutPut_Orders_StockNumberCount;
		public $OutPut_Orders_CargoMoneyFixedCount;
		public $OutPut_Orders_CargoMoneyPaidCount;
		public $OutPut_Orders_BankSaleCount;
		public $OutPut_Orders_BankCommissionCount;
		public $OutPut_Orders_CargoMoneySale;
		public $OutPut_Orders_OrdersSaleCount;
		
		//Products
		public $OutPut_Products_TotalProducts;
		public $OutPut_Products_TotalProductsReturn;
		
		//Categories
		public $OutPut_Categories_TotalCategories;
		
		// Payment Notification
		public $OutPut_PaymentNotification_Total;
		
		// Inbox
		public $OutPut_Inbox_Total;
		
		function StatisticsUsers()
		{
			DB::select("COUNT(ID) AS Counts");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1'"));
			$line = DB::get();
			
			$this->OutPut_Users_MembersCount = $line->Counts;
			
			DB::select("COUNT(Approval) AS Counts");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1' AND Approval != '1'"));
			$line = DB::get();
			
			$this->OutPut_Users_NoApprovalCount = $line->Counts;
			
			DB::select("COUNT(Approval) AS Counts");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1' AND Approval = '1'"));
			$line = DB::get();
			
			$this->OutPut_Users_ApprovalCount = $line->Counts;
			
			DB::select("COUNT(Gender) AS Counts");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1' AND Gender = 'Bay'"));
			$line = DB::get();
			
			$this->OutPut_Users_Gender_Male_Count = $line->Counts;
			
			DB::select("COUNT(Gender) AS Counts");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1' AND Gender = 'Bayan'"));
			$line = DB::get();
			
			$this->OutPut_Users_Gender_Female_Count = $line->Counts;
			
			DB::select("UserName, YEAR(NOW()) AS NOW_YEAR, (SELECT FROM_UNIXTIME(DOB,'%Y')) AS DOB_YEAR, (SELECT NOW_YEAR - DOB_YEAR) AS BIRTHDAY");
			DB::table("Users");
			DB::where_array(array("WHERE"	=>	"UserTypeID != '1'"));
			
			$lineBirthday = DB::getAll();
			$Counts = (count($lineBirthday));
			foreach($lineBirthday as $lineBirthday)
			{
				$Birthday += $lineBirthday->BIRTHDAY;
			}
			
			$this->OutPut_Users_DOB_AVG = ceil($Birthday / $Counts);
			
		}
		function StatisticsOrders()
		{
			DB::select("COUNT(ID) AS OrdersCount");
			DB::table("Orders");
			$line = DB::get();
			
			$this->OutPut_Orders_OrdersCount = $line->OrdersCount;

			DB::select("COUNT(ID) AS OrdersSaleCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"OrdersStatusID = '2'"));
			$line = DB::get();
			
			$this->OutPut_Orders_OrdersSaleCount = $line->OrdersSaleCount;
			
			DB::select("SUM((SELECT(Price + KDV) * StockNumber)) AS TotalPrice");
			DB::table("Orders");
			$line = DB::get();
			
			$this->OutPut_Orders_TotalPrice = Library::TRMoney($line->TotalPrice);
			
			DB::select("COUNT(ID) AS TotalCount");
			DB::table("Orders");
			$line = DB::get();
			
			$this->OutPut_Orders_TotalCount = $line->TotalCount;
			
			DB::select("COUNT(StockNumber) AS StockNumberCount");
			DB::table("Orders");
			$line = DB::get();
			
			$this->OutPut_Orders_StockNumberCount = $line->StockNumberCount;
			
			DB::select("SUM(CargoMoney) AS CargoMoneyFixedCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"FreeCargo = '2'"));
			$line = DB::get();
			
			$this->OutPut_Orders_CargoMoneyFixedCount = $line->CargoMoneyFixedCount;
			
			DB::select("SUM(CargoMoney) AS CargoMoneyPaidCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"FreeCargo = '1'"));
			$line = DB::get();
			
			$this->OutPut_Orders_CargoMoneyPaidCount = $line->CargoMoneyPaidCount;
			
			DB::select("SUM(CargoMoney) AS CargoMoneyPaidCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"FreeCargo = '0'"));
			$line = DB::get();
			
			$this->OutPut_Orders_CargoMoneyFreeCount = $line->CargoMoneyFreeCount;
			
			DB::select("COUNT(BankName) AS BankSaleCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"BankName != ''"));
			$line = DB::get();
			
			$this->OutPut_Orders_BankSaleCount = $line->BankSaleCount;
			
			DB::select("SUM(BankCommission) AS BankCommissionCount");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"BankName != ''"));
			$line = DB::get();
			
			$this->OutPut_Orders_BankCommissionCount = $line->BankCommissionCount;
			
			DB::select("SUM(CargoMoney) AS CargoMoneySale");
			DB::table("Orders");
			DB::where_array(array("WHERE"	=>	"FreeCargo = '1' OR FreeCargo = '2'"));
			$line = DB::get();
			
			$this->OutPut_Orders_CargoMoneySale = $line->CargoMoneySale;
		}
		
		function StatisticsProducts()
		{
			DB::select("COUNT(ID) AS TotalProducts");
			DB::table("Products");
			$line = DB::get();
			
			$this->OutPut_Products_TotalProducts = $line->TotalProducts;
			
			DB::select("COUNT(ID) AS Total");
			DB::table("ProductsReturn");
			$line = DB::get();
			
			$this->OutPut_Products_TotalProductsReturn = $line->Total;
		}
		
		function StatisticsCategories()
		{
			DB::select("COUNT(ID) AS TotalCategories");
			DB::table("Categories");
			$line = DB::get();
			
			$this->OutPut_Categories_TotalCategories = $line->TotalCategories;
		}
		function StatisticsPaymentNotification()
		{
			DB::select("COUNT(ID) AS Total");
			DB::table("PaymentNotification");
			$line = DB::get();
			
			$this->OutPut_PaymentNotification_Total = $line->Total;
		}
		
		function StatisticsInbox()
		{
			DB::select("COUNT(ID) AS Total");
			DB::table("Inbox");
			$line = DB::get();
			
			$this->OutPut_Inbox_Total = $line->Total;
		}
	}
?>