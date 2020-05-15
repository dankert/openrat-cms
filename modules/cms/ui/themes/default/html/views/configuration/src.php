<?php if (defined('OR_TITLE')) {  ?>
  <textarea name="<?php echo escapeHtml('source') ?>" data-extension="<?php echo escapeHtml('') ?>" data-mimetype="<?php echo escapeHtml('') ?>" data-mode="<?php echo escapeHtml('yaml') ?>" class="<?php echo escapeHtml('editor code-editor') ?>"><?php echo escapeHtml(''.@$source.'') ?>
  </textarea>
 <?php } ?>