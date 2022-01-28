<div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Menu</li>
                        <?php
                            if($Grants->GrantsControl('Settings') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=Settings&ID=1"><i class="glyphicon glyphicon-eye-open"></i><span> Site Ayarları</span></a></li>
                        <?php
                            }
                        ?>
                        <?php
                            if($Grants->GrantsControl('MainMenu') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=MainMenu"><i class="glyphicon glyphicon-eye-open"></i><span> Menü Yönetimi</span></a></li>
                        <?php
                            }
                        ?>


                        <?php
                            if($Grants->GrantsControl('Files') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=Files"><i class="glyphicon glyphicon-eye-open"></i><span> Dosya Yönetimi</span></a></li>
                        <?php
                            }
                        ?>

						            <?php
                          /*  if($Grants->GrantsControl('ContentCategories') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=ContentCategories"><i class="glyphicon glyphicon-eye-open"></i><span> Üst Menü Ayarları</span></a></li>
                        <?php
                      }*/
                        ?>

                        <?php
                            if($Grants->GrantsControl('Gallery') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=Gallery&GalleryMainMenuID=2&GalleryCategoriesID=4"><i class="glyphicon glyphicon-eye-open"></i><span> Ana Sayfa Resimler</span></a></li>
                        <?php
                            }
                        ?>
                        <?php
                            if($Grants->GrantsControl('Gallery') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=Gallery&GalleryMainMenuID=2&GalleryCategoriesID=5"><i class="glyphicon glyphicon-eye-open"></i><span> Ana Sayfa Slider</span></a></li>
                        <?php
                            }
                        ?>
                        <?php
                            if($Grants->GrantsControl('News') == 1)
                            {
                        ?>
                            <li><a class="ajax-link" href="<?php echo Defined::PROFILE ?>?func=News"><i class="glyphicon glyphicon-eye-open"></i><span> Duyurular</span></a></li>
                        <?php
                            }
                        ?>

</div>
