<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="src" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="src" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" />
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('source'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <textarea name="source" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor"><?php echo encodeHtml(htmlentities(@$source)) ?>
            </textarea>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('APPLY'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--apply" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>