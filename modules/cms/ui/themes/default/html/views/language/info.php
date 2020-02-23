<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="language" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form language">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="language" />
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
            <span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
            </span>
          </div>
          <div class="input clickable">
            <span><?php echo encodeHtml(htmlentities(@$isocode)) ?>
            </span>
          </div>
        </div>
        <div class="line">
          <div class="label">
          </div>
          <div class="input clickable">
            <a target="_self" data-type="edit" data-action="language" data-method="prop" data-id="" data-extra="[]" href="/#/language/" class="or-link-btn">
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