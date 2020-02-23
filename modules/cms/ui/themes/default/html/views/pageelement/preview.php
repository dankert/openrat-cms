<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="preview">
      <fieldset class="or-group toggle-open-close open show">
        <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('page_preview'))) ?>
          <img />
          <div class="arrow arrow-right on-closed">
          </div>
          <div class="arrow arrow-down on-open">
          </div>
        </legend>
        <div class="closable">
          <span><?php echo @$preview ?>
          </span>
        </div>
      </fieldset>
    </div>
 <?php } ?>