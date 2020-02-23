<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_NAME'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
            </div>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
          </div>
        </fieldset>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('file_extension'))) ?>
            </span>
          </div>
          <div class="input">
            <a target="_self" data-type="view" data-action="" data-method="extension" data-id="" data-extra="[]" href="/#//">
              <div class="inputholder">
                <span><?php echo encodeHtml(htmlentities(@$extension)) ?>
                </span>
              </div>
            </a>
            <div class="clickable">
              <a target="_self" data-type="view" data-action="" data-method="extension" data-id="" data-extra="[]" href="/#//" class="action">
                <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('file_mimetype'))) ?>
            </span>
          </div>
          <div class="input">
            <a target="_self" data-action="template" data-method="extension" data-id="" data-extra="[]" href="/#/template/">
              <div class="inputholder">
                <span><?php echo encodeHtml(htmlentities(@$mime_type)) ?>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>