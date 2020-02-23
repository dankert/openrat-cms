<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="page" />
      <input type="hidden" name="subaction" value="changetemplateselectelements" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="newtemplateid" value="<?php echo encodeHtml(htmlentities(@$newtemplateid)) ?>" />
        <?php foreach($elements as $list_key=>$list_value) { extract($list_value); ?>
          <div class="line">
            <div class="label">
              <span><?php echo encodeHtml(htmlentities(@$name)) ?>
              </span>
            </div>
            <div class="input">
              <select name="<?php echo encodeHtml(htmlentities(@$newElementsName)) ?>" size="1">
                <?php foreach($newElementsList as $_key=>$_value) {  ?>
                  <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$${newElementsName}){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('MENU_CHANGETEMPLATE'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>