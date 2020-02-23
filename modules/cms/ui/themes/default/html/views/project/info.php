<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="project" />
      <input type="hidden" name="subaction" value="info" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php foreach($info as $list_key=>$list_value) {  ?>
          <label class="or-form-row">
            <span class="or-form-input">
            </span>
            <span class="or-form-label">message:<?php echo encodeHtml(htmlentities(@$list_key)) ?>
            </span>
          </label>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
      </div>
    </form>
 <?php } ?>