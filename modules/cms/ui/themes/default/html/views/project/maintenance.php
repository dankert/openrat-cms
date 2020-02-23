<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="maintenance" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="project" />
      <input type="hidden" name="subaction" value="maintenance" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="">
              <span>
              </span>
              <input type="radio" name="type" disabled="" value="check_limit" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('project_check_limit'))) ?>
                </span>
              </label>
            </div>
            <div class="">
              <span>
              </span>
              <input type="radio" name="type" disabled="" value="check_files" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('project_check_files'))) ?>
                </span>
              </label>
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