<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="add" data-action="templatelist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form templatelist">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="templatelist" />
      <input type="hidden" name="subaction" value="add" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
            </div>
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
            <div class="line">
              <div class="label">
                <input type="radio" name="type" disabled="" value="empty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              </div>
              <div class="input">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('empty'))) ?>
                  </span>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
                  </span>
                </label>
                <input type="radio" name="type" disabled="" value="copy" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              </div>
              <div class="input">
                <select name="templateid" size="1">
                  <?php foreach($templates as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$templateid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('example'))) ?>
                  </span>
                </label>
                <input type="radio" name="type" disabled="" value="example" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              </div>
              <div class="input">
                <select name="example" size="1">
                  <?php foreach($examples as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$example){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
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