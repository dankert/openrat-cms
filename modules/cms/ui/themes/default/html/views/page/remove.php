<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="remove" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <label class="or-form-row">
          <span class="or-form-input">
          </span>
          <span class="or-form-label">message:GLOBAL_NAME
          </span>
        </label>
        <label class="or-form-row or-form-checkbox">
          <span class="or-form-label">GLOBAL_DELETE
          </span>
          <input type="checkbox" name="delete" value="1" <?php if(@$delete){ ?>checked="1"<?php } ?> />
        </label>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>