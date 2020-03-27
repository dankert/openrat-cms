<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="createtext" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="folder" />
      <input type="hidden" name="subaction" value="createtext" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('global_FILE'))) ?>
              </span>
            </label>
          </div>
          <div class="input">
            <input multiple="multiple" id="req0_file" name="file" size="40" maxlength="<?php echo encodeHtml(htmlentities(@$maxlength)) ?>" class="upload" />
          </div>
        </div>
        <div class="line or-dropzone-upload">
          <div class="label">
          </div>
          <div class="input">
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span class="help"><?php echo encodeHtml(htmlentities(@lang('file_max_size'))) ?>
            </span>
          </div>
          <div class="input">
            <span><?php echo encodeHtml(htmlentities(@$max_size)) ?>
            </span>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('HTTP_URL'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="url" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$url)) ?>" />
            </div>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
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
            <span><?php echo encodeHtml(htmlentities(@lang('global_NAME'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('global_DESCRIPTION'))) ?>
            </span>
          </div>
          <div class="input">
            <textarea name="description" maxlength="0" class="inputarea">
            </textarea>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
    
 <?php } ?>