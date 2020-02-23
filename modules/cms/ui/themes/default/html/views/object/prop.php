<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('global_prop'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <label class="or-form-row or-form-input">
              <span class="or-form-label">global_filename
              </span>
              <input name="filename" autofocus="autofocus" type="text" maxlength="150" value="<?php echo encodeHtml(htmlentities(@$filename)) ?>" class="filename" />
            </label>
            <label class="or-form-row or-form-input">
              <span class="or-form-label">alias
              </span>
              <input name="alias_filename" type="text" maxlength="150" value="<?php echo encodeHtml(htmlentities(@$alias_filename)) ?>" class="filename" />
            </label>
            <label class="or-form-row or-form-input">
              <span class="or-form-label">folder
              </span>
              <select name="alias_folderid" size="1">
                <?php foreach($folders as $_key=>$_value) {  ?>
                  <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$alias_folderid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                  </option>
                 <?php } ?>
              </select>
            </label>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('global_save'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>