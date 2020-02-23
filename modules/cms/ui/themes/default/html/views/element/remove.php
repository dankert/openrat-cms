<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="element" />
      <input type="hidden" name="subaction" value="remove" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
                </span>
              </div>
              <div class="input">
                <span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
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
                <input type="checkbox" name="confirm" value="1" <?php if(@$confirm){ ?>checked="1"<?php } ?> required="required" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('CONFIRM_DELETE'))) ?>
                  </span>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <span>     
                </span>
                <input type="radio" name="type" disabled="" value="value" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_DELETE_VALUES'))) ?>
                  </span>
                </label>
                <br />
                <span>     
                </span>
                <input type="radio" name="type" disabled="" value="all" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('DELETE'))) ?>
                  </span>
                </label>
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