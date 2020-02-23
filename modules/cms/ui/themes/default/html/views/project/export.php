<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="export" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="project" />
      <input type="hidden" name="subaction" value="export" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DATABASE'))) ?>
            </span>
          </div>
          <div class="input">
            <select name="dbid" size="1">
              <?php foreach($dbids as $_key=>$_value) {  ?>
                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key=='actdbid'){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>