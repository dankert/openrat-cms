<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="createfolder" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="folder" />
      <input type="hidden" name="subaction" value="createfolder" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" />
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('global_FOLDER'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="256" value="" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('global_DESCRIPTION'))) ?>
            </span>
          </div>
          <div class="input">
            <textarea name="description" disabled="" maxlength="0" class="inputarea">
            </textarea>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('add'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>