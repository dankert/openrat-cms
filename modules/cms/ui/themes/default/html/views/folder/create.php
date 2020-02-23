<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-linklist">
      <?php $if1=($mayCreateFolder); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createfolder'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreatePage); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createpage'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreateFile); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createfile'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreateImage); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createimage'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreateText); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createtext'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreateUrl); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createurl'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($mayCreateLink); if($if1) {  ?>
        <div class="clickable or-linklist-line or-round-corners or-hover-effect">
          <a target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="/#//">
            <span><?php echo encodeHtml(htmlentities(@lang('menu_createlink'))) ?>
            </span>
          </a>
        </div>
       <?php } ?>
    </div>
 <?php } ?>