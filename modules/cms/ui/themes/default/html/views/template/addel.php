<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="addel" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="template" />
      <input type="hidden" name="subaction" value="addel" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('global_name'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" required="required" autofocus="autofocus" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('element_type'))) ?>
            </span>
          </div>
          <div class="input">
            <?php  { $text= 'text'; ?>
             <?php } ?>
            <select name="typeid" size="1">
              <?php foreach($types as $_key=>$_value) {  ?>
                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$typeid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
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
            <label class="label">
              <input type="checkbox" name="addtotemplate" value="1" checked="1" />
              <span><?php echo encodeHtml(htmlentities(@lang('menu_template_srcelement'))) ?>
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