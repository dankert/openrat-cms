<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="copy" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="copy" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <input type="hidden" name="sourceid" value="<?php echo encodeHtml(htmlentities(@$sourceId)) ?>" />
          </div>
          <div class="input">
            <span><?php echo encodeHtml(htmlentities(@$source['name'])) ?>
            </span>
          </div>
        </div>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <select name="type" size="1">
              <?php foreach($types as $_key=>$_value) {  ?>
                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$type){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <input type="hidden" name="targetid" value="<?php echo encodeHtml(htmlentities(@$targetId)) ?>" />
          </div>
          <div class="input">
            <span><?php echo encodeHtml(htmlentities(@$target['name'])) ?>
            </span>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>