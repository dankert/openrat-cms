<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('project') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form project') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('project') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('NAME').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_NAME').'') ?>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('name') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$name.'') ?>" class="<?php echo escapeHtml('name') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_HOSTNAME').'') ?>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('url') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$url.'') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('PUBLISH').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_TARGET_DIR').'') ?>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('target_dir') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$target_dir.'') ?>" class="<?php echo escapeHtml('filename') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
            <?php $if1=(config('publish','project','override_system_command')); if($if1) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_CMD_AFTER_PUBLISH').'') ?>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                    <input name="<?php echo escapeHtml('cmd_after_publish') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$cmd_after_publish.'') ?>" class="<?php echo escapeHtml('filename') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                </div>
              </div>
             <?php } ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('publishFileExtension') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$publishFileExtension){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_publish_File_Extension').'') ?>
                </label>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('publishPageExtension') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$publishPageExtension){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_publish_page_Extension').'') ?>
                </label>
              </div>
            </div>
            <label class="<?php echo escapeHtml('or-form-row or-form-radio') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('LINKS_RELATIVE') ?>
              </span>
              <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('linksAbsolute') ?>" value="<?php echo escapeHtml('') ?>" checked="<?php echo escapeHtml(''.@$linksAbsolute.'') ?>" /><?php echo escapeHtml('') ?>
            </label>
            <label class="<?php echo escapeHtml('or-form-row or-form-radio') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('LINKS_ABSOLUTE') ?>
              </span>
              <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('linksAbsolute') ?>" value="<?php echo escapeHtml('1') ?>" checked="<?php echo escapeHtml(''.@$linksAbsolute.'') ?>" /><?php echo escapeHtml('') ?>
            </label>
          </div>
        </fieldset>
        <?php $if1=(config('publish','ftp','enable')); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('project_FTP').'') ?>
              <img /><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_FTP_URL').'') ?>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                    <input name="<?php echo escapeHtml('ftp_url') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$ftp_url.'') ?>" class="<?php echo escapeHtml('filename') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                  <br /><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('ftp_passive') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$ftp_passive){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_FTP_PASSIVE').'') ?>
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('content_negotiation') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$content_negotiation){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_CONTENT_NEGOTIATION').'') ?>
                </label>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('cut_index') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$cut_index){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('PROJECT_CUT_INDEX').'') ?>
                </label>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>