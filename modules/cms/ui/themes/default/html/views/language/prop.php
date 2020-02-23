<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="language" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form language">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="language" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="isocode" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$isocode)) ?>" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <input type="checkbox" name="is_default" disabled="disabled" value="1" <?php if(@$is_default){ ?>checked="1"<?php } ?> />
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
            </label>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>