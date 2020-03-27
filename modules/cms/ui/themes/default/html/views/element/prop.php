<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="element" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('LABEL'))) ?>
                </span>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="label" required="required" autofocus="autofocus" type="text" maxlength="100" value="<?php echo encodeHtml(htmlentities(@$label)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
                </span>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="name" required="required" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DESCRIPTION'))) ?>
                </span>
              </div>
              <div class="input">
                <textarea name="description" maxlength="255" class="inputarea"><?php echo encodeHtml(htmlentities(@$description)) ?>
                </textarea>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_TYPE'))) ?>
                </span>
              </div>
              <div class="input">
                <select name="typeid" size="1">
                  <?php foreach($types as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$typeid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>