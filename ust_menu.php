<div class="container" style="margin-top:10px;">
  <div class="row">
    <div class="col-sm">

<ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal" style="display:block ">

    <?php
      $result = $db->query("SELECT * FROM MainMenu WHERE SupID=0 AND ISDELETED=0");
      $line = $result->fetchAll(PDO::FETCH_OBJ);
      foreach($line as $line)
      {
    ?>
        <li><a href="<?php print $line->URL; ?>"><i class="<?php print $line->Images; ?>" aria-hidden="true"></i><span class="title"><?php print $line->Name; ?></span></a>
          <?php
          $result0 = $db->prepare("SELECT * FROM MainMenu WHERE SupID  = ?");
          $result0->execute(array($line->ID));
          if($result0->rowCount() > 0)
          {
            $line0 = $result0->fetchAll(PDO::FETCH_OBJ);
          ?>
            <ul>
              <?php

                foreach($line0 as $line0)
                {
              ?>
                  <li><a href="<?php print $line0->URL ?>"><?php print $line0->Name; ?></a></li>
              <?php
                }
          ?>
            </ul>
            <?php
          }
            ?>
        </li>

    <?php
      }
    ?>
</ul>
</div>
</div>
</div>
</div>
