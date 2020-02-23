<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="changetemplateselectelements" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="templateid" value="<?php echo encodeHtml(htmlentities(@$templateid)) ?>" />
        <input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" />
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('page_template_old'))) ?>
            </span>
          </div>
          <div class="input">
            <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$template_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
              <img src="./modules/cms/ui/themes/default/images/icon_template.png" />
              <span><?php echo encodeHtml(htmlentities(@$template_name)) ?>
              </span>
            </a>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('page_template_new'))) ?>
            </span>
          </div>
          <div class="input">
            <select name="newtemplateid" size="1">
              <?php foreach($templates as $_key=>$_value) {  ?>
                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$newtemplateid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('BUTTON_NEXT'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>