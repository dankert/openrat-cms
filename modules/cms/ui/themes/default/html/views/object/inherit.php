<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="inherit" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="inherit" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=($type=='folder'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <?php  { $inherit= '1'; ?>
                   <?php } ?>
                  <input type="checkbox" name="inherit" value="1" <?php if(@$inherit){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('inherit_rights'))) ?>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>