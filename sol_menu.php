<div class="col-lg-3 justify-content-end" >

			<div class="row">
			  <div class="col text-center">
			  
				<button type="button" class="btn btn-primary" style="width:75%; margin-top:10px; margin-bottom: 10px; background:#00695C; color:#c0c0c0; font-family: 'Roboto', sans-serif;border-bottom: 3px solid #FD5025;" onclick="location='../en/index.php'">
					English
				</button>
			  </div>
               <!--
			  <div class="col text-center"s>
				<button type="button" class="btn btn-primary" style="width:75%; margin-top:10px; margin-bottom: 10px; background:#00695C; color:#c0c0c0; font-family: 'Roboto', sans-serif;border-bottom: 3px solid #FD5025;" onclick="location='bizeyazin.php'">
					Bize Yazın
				</button>
			  </div>
			</div>		
		
-->
	

   <ul id="respMenu" class="ace-responsive-menu col-12" data-menu-style="accordion" style="display:block">
   <!--<a href="javascript:void(0)">-->
       <li><i  aria-hidden="true"></i><span class="title" style="font-family:Roboto ;color:#FFF;size:30px" ><b><center>Analiz/Test ve Kalibrasyon Hizmetleri</center></b></span></a> 
          </li>
      <?php 
        $result = $db->query("SELECT ID, Header, Images, Link FROM flatpages WHERE `Index`=1 AND ISDELETED=0");
        $line = $result->fetchAll(PDO::FETCH_OBJ);
        foreach($line as $line)
        {
          $link="";
          if($line->Link != "")
          {
            $link = $line->Link;
            $target = "blank";
          }
          else
          {
            $link = "icerik.php?ID=".$line->ID;
            $target = "_self";
          }

      ?>
          <li><a href="<?php print $link ?>" target="<?php print $target ?>"><i class="<?php print $line->Images; ?>" aria-hidden="true"></i><span class="title"><?php print $line->Header; ?></span></a> 
          </li>
      <?php
        }
      ?>
  </ul>
   <ul id="respMenu" class="ace-responsive-menu col-12" data-menu-style="accordion" style="display:block; margin-top: 20px;">
        <?php 
          $result = $db->query("SELECT ID, Header, Images, Link FROM flatpages WHERE `Index`=2 AND ISDELETED=0");
          $line = $result->fetchAll(PDO::FETCH_OBJ);
          foreach($line as $line)
          {
            $link="";
            if($line->Link != "")
            {
              $link = $line->Link;
              $target = "blank";
            }
            else
            {
              $link = "icerik.php?ID=".$line->ID;
              $target = "_self";
            }
        ?>
            <li><a href="<?php print $link ?>" target="<?php print $target ?>"><i class="<?php print $line->Images; ?>" aria-hidden="true"></i><span class="title"><?php print $line->Header; ?></span></a> 
            </li>
        <?php
          }
        ?>
    </ul>
   
</div>