<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="name" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="name" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" />
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <label class="or-form-row or-form-input">
              <span class="or-form-label">name
              </span>
              <input name="name" required="required" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
            </label>
            <label class="or-form-row or-form-checkbox">
              <span class="or-form-label">description
              </span>
              <textarea name="description" disabled="" maxlength="255" class="description"><?php echo encodeHtml(htmlentities(@$description)) ?>
              </textarea>
            </label>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('alias'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
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
            <label class="or-form-row or-form-checkbox">
              <span class="or-form-label">leave_link
              </span>
              <input type="checkbox" name="leave_link" value="1" <?php if(@$leave_link){ ?>checked="1"<?php } ?> />
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