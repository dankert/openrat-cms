<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="srcelement" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="srcelement" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=(isset($elements)); if($if1) {  ?>
          <div class="line">
            <div class="label">
              <input type="radio" name="type" disabled="" value="addelement" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
              <select name="elementid" size="1">
                <?php foreach($elements as $_key=>$_value) {  ?>
                  <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$elementid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
         <?php } ?>
        <?php $if1=(isset($writable_elements)); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
            </div>
          </fieldset>
          <div class="line">
            <div class="label">
              <input type="radio" name="type" disabled="" value="addicon" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ICON'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
              <select name="writable_elementid" size="1">
                <?php foreach($writable_elements as $_key=>$_value) {  ?>
                  <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$writable_elementid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
          <div class="line">
            <div class="label">
              <input type="radio" name="type" disabled="" value="addifempty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_SRC_IFEMPTY'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
            </div>
          </div>
          <div class="line">
            <div class="label">
              <input type="radio" name="type" disabled="" value="addifnotempty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_SRC_IFNOTEMPTY'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
            </div>
          </div>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>