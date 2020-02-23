<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="uncompress" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form image">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="image" />
      <input type="hidden" name="subaction" value="uncompress" />
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
          </div>
        </fieldset>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <?php  { $replace= '1'; ?>
             <?php } ?>
            <input type="radio" name="replace" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('replace'))) ?>
              </span>
            </label>
            <br />
            <input type="radio" name="replace" disabled="" value="0" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
              </span>
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