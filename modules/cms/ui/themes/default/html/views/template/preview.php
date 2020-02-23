<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="template" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="preview" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
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
      <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('preview'))) ?>
        <img />
        <div class="arrow arrow-right on-closed">
        </div>
        <div class="arrow arrow-down on-open">
        </div>
      </legend>
      <div class="closable">
        <iframe src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>">
        </iframe>
        <a target="_self" data-action="file" data-method="edit" data-id="" data-extra="[]" href="/#/file/" class="action">
          <img src="./modules/cms/ui/themes/default/images/icon/icon/edit.png" />
          <span><?php echo encodeHtml(htmlentities(@lang('menu_file_edit'))) ?>
          </span>
        </a>
        <a target="_self" data-action="file" data-method="editvalue" data-id="" data-extra="[]" href="/#/file/" class="action">
          <img src="./modules/cms/ui/themes/default/images/icon/icon/editvalue.png" />
          <span><?php echo encodeHtml(htmlentities(@lang('menu_file_editvalue'))) ?>
          </span>
        </a>
      </div>
    </fieldset>
 <?php } ?>