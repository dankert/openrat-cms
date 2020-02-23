<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="group" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="group" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
              </span>
            </label>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="100" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name focus" />
            </div>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>