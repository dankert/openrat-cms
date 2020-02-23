<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="link" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form link">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="link" />
      <input type="hidden" name="subaction" value="edit" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('link_target'))) ?>
                </span>
              </div>
              <div class="input">
                
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>