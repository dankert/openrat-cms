<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="add" data-action="projectlist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form projectlist">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="projectlist" />
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
              <input name="name" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus" />
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
              </div>
              <div class="input">
                <input type="radio" name="type" disabled="" value="empty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('empty'))) ?>
                  </span>
                </label>
                <br />
                <input type="radio" name="type" disabled="" value="copy" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
                  </span>
                </label>
                <select name="projectid" size="1">
                  <?php foreach($projects as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$projectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
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