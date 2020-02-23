<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="project" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_NAME'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="name" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_HOSTNAME'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="url" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$url)) ?>" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('PUBLISH'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_TARGET_DIR'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="target_dir" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$target_dir)) ?>" class="filename" />
                </div>
              </div>
            </div>
            <?php $if1=(config('publish','project','override_system_command')); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CMD_AFTER_PUBLISH'))) ?>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="cmd_after_publish" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$cmd_after_publish)) ?>" class="filename" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="publishFileExtension" value="1" <?php if(@$publishFileExtension){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_publish_File_Extension'))) ?>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="publishPageExtension" value="1" <?php if(@$publishPageExtension){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_publish_page_Extension'))) ?>
                </label>
              </div>
            </div>
            <label class="or-form-row or-form-radio">
              <span class="or-form-label">LINKS_RELATIVE
              </span>
              <input type="radio" name="linksAbsolute" disabled="" value="0" checked="<?php echo encodeHtml(htmlentities(@$linksAbsolute)) ?>" />
            </label>
            <label class="or-form-row or-form-radio">
              <span class="or-form-label">LINKS_ABSOLUTE
              </span>
              <input type="radio" name="linksAbsolute" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$linksAbsolute)) ?>" />
            </label>
          </div>
        </fieldset>
        <?php $if1=('config:publish/ftp/enable'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('project_FTP'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                  <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_FTP_URL'))) ?>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="ftp_url" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$ftp_url)) ?>" class="filename" />
                  </div>
                  <br />
                  <input type="checkbox" name="ftp_passive" value="1" <?php if(@$ftp_passive){ ?>checked="1"<?php } ?> />
                  <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_FTP_PASSIVE'))) ?>
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
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
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="content_negotiation" value="1" <?php if(@$content_negotiation){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CONTENT_NEGOTIATION'))) ?>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="cut_index" value="1" <?php if(@$cut_index){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CUT_INDEX'))) ?>
                </label>
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