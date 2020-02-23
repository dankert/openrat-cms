<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="model" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form model">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="model" />
      <input type="hidden" name="subaction" value="info" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
        </span>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
            </span>
          </div>
          <div class="input clickable">
            <span><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
            <a target="_self" data-type="edit" data-action="model" data-method="prop" data-id="" data-extra="[]" href="/#/model/" class="or-link-btn">
              <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
      </div>
    </form>
 <?php } ?>