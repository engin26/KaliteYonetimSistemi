<?php
	if(empty($_SESSION['Modal'])){
		$_SESSION['Modal'] = 1;
?>
						<!-- modal nesnesi başlangıç -->
						<div id="modalNesne" class="modal fade">
							<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">KAPAT</button>

									</div>
									<div class="modal-body">

										<div class="col-md-12">
										  <center> <img src="images/dikkat.jpg" class="img-responsive" style="width:30%"></center>
									   </div>



										<div class="col-md-12">

												<?php
												  $lineNewsList = NewsList(1);
												  $sayi=0;
												  foreach($lineNewsList as $key => $value) {
													  $sayi++;
												?>
													<div class="row">
													<li class="list-group-item " style="display:inline; color:red; text-align:center"><center>Duyuru <?php  print $sayi ?> : </center><li class="list-group-item"><?php print $value->Header; ?></li></li>
													</div>
												<?php
												  }
												?>
									</div>
									</div>
								</div>
							</div>
						</div>
						<!-- // modal nesnesi bitiş -->
<?php
}
?>
