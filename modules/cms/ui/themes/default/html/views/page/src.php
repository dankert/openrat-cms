<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="self" action="./" data-method="src" data-action="page" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="src" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <select name="languageid" size="1">
          <?php foreach($languages as $_key=>$_value) {  ?>
            <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==''.@$languageid.''){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
            </option>
           <?php } ?>
        </select>
        <select name="modelid" size="1">
          <?php foreach($models as $_key=>$_value) {  ?>
            <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==''.@$modelid.''){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
            </option>
           <?php } ?>
        </select>
      </div>
      <div class="or-form-actionbar">
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
    <fieldset class="or-group toggle-open-close open show">
      <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('SOURCE'))) ?>
        <img />
        <div class="arrow arrow-right on-closed">
        </div>
        <div class="arrow arrow-down on-open">
        </div>
      </legend>
      <div class="closable">
        <textarea name="src" data-extension="" data-mimetype="" data-mode="html" class="editor code-editor"><?php echo encodeHtml(htmlentities(@$src)) ?>
        </textarea>
      </div>
    </fieldset>
 <?php } ?>