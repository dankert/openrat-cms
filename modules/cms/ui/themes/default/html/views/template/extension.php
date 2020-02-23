<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="extension" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="extension" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php foreach($extension as $list_key=>$list_value) { extract($list_value); ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@$name)) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <?php  { $$name= $extension; ?>
               <?php } ?>
              <label class="or-form-row or-form-input">
                <span class="or-form-label">template_extension
                </span>
                <input name="<?php echo encodeHtml(htmlentities(@$name)) ?>" required="required" type="text" maxlength="10" value="<?php echo encodeHtml(htmlentities(@$${name)) ?>}" />
              </label>
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