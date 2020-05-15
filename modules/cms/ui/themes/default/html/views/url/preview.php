<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('toolbar-icon') ?>"><?php echo escapeHtml('') ?>
      <i class="<?php echo escapeHtml('image-icon image-icon--menu-refresh') ?>"><?php echo escapeHtml('') ?>
      </i>
    </div>
    <iframe name="<?php echo escapeHtml('preview') ?>" src="<?php echo escapeHtml(''.@$preview_url.'') ?>"><?php echo escapeHtml('') ?>
    </iframe>
 <?php } ?>