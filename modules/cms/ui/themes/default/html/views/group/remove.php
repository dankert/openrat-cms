<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="group" />
      <input type="hidden" name="subaction" value="remove" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
            </label>
          </div>
          <div class="input">
            <span><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
          </div>
        </fieldset>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <input type="checkbox" name="confirm" value="1" <?php if(@$confirm){ ?>checked="1"<?php } ?> required="required" />
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('GROUP_DELETE'))) ?>
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