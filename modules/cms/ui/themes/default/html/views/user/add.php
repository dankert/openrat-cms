<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="add" data-action="user" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="user" />
        <input type="hidden" name="subaction" value="add" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          <div class="line">
            <div class="label">
              <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
              </label>
            </div>
            <div class="input">
              <div class="inputholder">
                <input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus" />
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