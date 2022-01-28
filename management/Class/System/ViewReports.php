<?php
	class ViewReports extends TempLog{
	
		public static function Success($Message)
		{
			return '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$Message.'</div>';
		}
		public static function Error($Message)
		{
			return '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$Message.'</div>';
		}
		public static function ErrorGrants()
		{
			return '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Yetkiniz Olmayan Yere Giriş Yapamazsınız.!!!</div>';
		}
		public static function SuccessAjax($Message)
		{
			return '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$Message.'</div>';
		}
		public static function ErrorAjax($Message)
		{
			return '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$Message.'</div>';
		}
		public static function MessageInfo($Message)
		{
			return '<div class="alert alert-info"><strong>'.$Message.'</strong></div>';	
		}
	}
	
?>