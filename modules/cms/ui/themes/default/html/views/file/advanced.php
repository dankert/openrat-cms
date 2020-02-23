<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form file">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="file" />
      <input type="hidden" name="subaction" value="advanced" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <label class="or-form-row or-form-input">
          <span class="or-form-label">file_extension
          </span>
          <input name="extension" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$extension)) ?>" class="extension" />
        </label>
        <label class="or-form-row or-form-input">
          <span class="or-form-label">type
          </span>
          <select name="type" size="1">
            <?php foreach($types as $_key=>$_value) {  ?>
              <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$type){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
              </option>
             <?php } ?>
          </select>
        </label>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>