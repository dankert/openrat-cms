<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="settings" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="settings" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('validity'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('from'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="valid_from_date" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_from_date)) ?>" />
                </div>
                <div class="inputholder">
                  <input name="valid_from_time" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_from_time)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('until'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="valid_until_date" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_until_date)) ?>" />
                </div>
                <div class="inputholder">
                  <input name="valid_until_time" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_until_time)) ?>" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('settings'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('SETTINGS'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <textarea name="settings" data-extension="" data-mimetype="" data-mode="yaml" class="editor code-editor"><?php echo encodeHtml(htmlentities(@$settings)) ?>
                </textarea>
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