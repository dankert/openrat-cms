<?php if (defined('OR_TITLE')) {  ?>
  
    <?php $if1=(config('security','nopublish')); if($if1) {  ?>
      <div class="message warn">
        <span class="help"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOPUBLISH_DESC'))) ?>
        </span>
      </div>
     <?php } ?>
    <form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="1" data-autosave="" class="or-form folder">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="folder" />
      <input type="hidden" name="subaction" value="pub" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=($pages); if($if1) {  ?>
          <div class="line">
            <div class="label">
            </div>
            <div class="input">
              <input type="checkbox" name="pages" value="1" <?php if(@$pages){ ?>checked="1"<?php } ?> />
              <label class="label">
                <span> 
                </span>
                <span><?php echo encodeHtml(htmlentities(@lang('global_pages'))) ?>
                </span>
              </label>
            </div>
          </div>
         <?php } ?>
        <?php $if1=($files); if($if1) {  ?>
          <div class="line">
            <div class="label">
            </div>
            <div class="input">
              <input type="checkbox" name="files" value="1" <?php if(@$files){ ?>checked="1"<?php } ?> />
              <label class="label">
                <span> 
                </span>
                <span><?php echo encodeHtml(htmlentities(@lang('global_files'))) ?>
                </span>
              </label>
            </div>
          </div>
         <?php } ?>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <?php $if1=(isset($subdirs)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="subdirs" disabled="disabled" value="1" <?php if(@$subdirs){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span> 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_PUBLISH_WITH_SUBDIRS'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($clean)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="clean" value="1" <?php if(@$clean){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span> 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('global_CLEAN_AFTER_PUBLISH'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('publish'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>