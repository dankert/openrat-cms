<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="toolbar-icon">
      <i class="image-icon image-icon--menu-refresh">
      </i>
    </div>
    <iframe name="preview" src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>">
    </iframe>
 <?php } ?>