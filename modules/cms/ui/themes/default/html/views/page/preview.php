<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="page" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="preview" />
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
      <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('PREVIEW'))) ?>
        <img />
        <div class="arrow arrow-right on-closed">
        </div>
        <div class="arrow arrow-down on-open">
        </div>
      </legend>
      <div class="closable">
        <div class="toolbar-icon clickable">
          <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" data-type="popup" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="action">
            <i class="image-icon image-icon--menu-open_in_new">
            </i>
            <span><?php echo encodeHtml(htmlentities(@lang('link_open_in_new_window'))) ?>
            </span>
          </a>
        </div>
        <iframe name="preview" src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>">
        </iframe>
      </div>
    </fieldset>
 <?php } ?>