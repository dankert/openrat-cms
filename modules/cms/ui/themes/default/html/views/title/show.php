<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-menu-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon toggle-nav-open-close') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </i>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon toggle-nav-small') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-minimize') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </i>
      </div>
      <?php $if1=(isset($dbname)); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-database') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <span class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </span>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span title="<?php echo \template_engine\Output::escapeHtml(''.@$dbid.'') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$dbname.'') ?>
              </span>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_new_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('add') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </i>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-image on-action-text on-action-pageelement on-action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_pub_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pub') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </i>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-file') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <span class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('file').'') ?>
          </span>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_new_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('add') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_new').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','method','add').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfolder_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfolder') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfolder').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createpage_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createpage') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createpage').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfile_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfile') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfile').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createimage_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createimage') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createimage').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createtext_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createtext') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createtext').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createlink_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createlink') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createlink').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createurl_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createurl') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createurl').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_compress_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('compress') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'compress\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-compress') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_compress').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_decompress_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('decompress') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'decompress\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-decompress') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_decompress').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_extract_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('extract') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extract\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-extract') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_extract').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('logout') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"login","subaction":"logout","id":"","token":"'.@$_token.'","none":"0"}') ?>" class="<?php echo \template_engine\Output::escapeHtml('entry') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGOUT').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-edit') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <span class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit').'') ?>
          </span>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-user on-action-project on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file on-action-url on-action-image on-action-text on-action-language on-action-model') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_prop_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('prop') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-prop') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_prop').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','method','prop').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-link on-action-folder on-action-page on-action-file on-action-text on-action-url on-action-image') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_settings_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('settings') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'settings\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-settings') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_settings').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-page on-action-file on-action-folder on-action-text on-action-image on-action-pageelement on-action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_pub_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pub') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_pub').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','method','pub').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_archive_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('archive') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'archive\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>" class="<?php echo \template_engine\Output::escapeHtml('entry') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-archive') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_archive').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','method','archive').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file on-action-image on-action-text on-action-url') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_rights_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('rights') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'rights\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-rights') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_rights').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','method','rights').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_history_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('history') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'history\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-history') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_history').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-url on-action-image on-action-text on-action-link on-action-language on-action-model on-action-user on-action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_delete_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('remove') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'remove\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-delete') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_delete').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_preview_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('preview') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'preview\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-preview') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_preview').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-extra') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <span class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('extras').'') ?>
          </span>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_password_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pw') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pw\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-password') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_password').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-user on-action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_memberships_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('memberships') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'memberships\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-membership') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_memberships').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder on-action-element on-action-file on-action-image on-action-text on-action-pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_advanced_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('advanced') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'advanced\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-advanced') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_advanced').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-page') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_changetemplate_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('changetemplate') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'changetemplate\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-changetemplate') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_changetemplate').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-template on-action-configuration on-action-page') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_src_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('src') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'src\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-code') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_src').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_extension_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('extension') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extension\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-extension') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_extension').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-text') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_value_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('value') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'value\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-value') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_value').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_order_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('order') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'order\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-order') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_order').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-image') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_size_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('size') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'size\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-size') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_size').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable filtered on-action-project') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_maintenance_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('maintenance') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'maintenance\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-maintenance') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_maintenance').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-menu-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon user menu') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </i>
        <span class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$userfullname.'') ?>
        </span>
        <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <?php $if1=($isLoggedIn); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_PROFILE_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'edit\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/profile/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_profile').'') ?>
                </span>
                <span class="<?php echo \template_engine\Output::escapeHtml('keystroke') ?>"><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('ui','keybinding','action','profile').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_password_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pw') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/profile/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-password') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_password').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_mail_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('mail') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'mail\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/profile/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-mail') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_mail').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_license_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('license') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'license\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/login/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-info') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_info').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_history_desc').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('history') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'history\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/profile/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-history') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_history').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('divide') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a data-after-success="<?php echo \template_engine\Output::escapeHtml('reloadAll') ?>" title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('logout') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"login","subaction":"logout","id":"","token":"'.@$_token.'","none":"0"}') ?>" class="<?php echo \template_engine\Output::escapeHtml('entry') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGOUT').'') ?>
                </span>
              </a>
            </div>
           <?php } ?>
          <?php if(!$if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('entry clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGIN_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'login\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/login/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_LOGIN').'') ?>
                </span>
              </a>
            </div>
           <?php } ?>
        </div>
      </div>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon menu search') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-search') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <input name="<?php echo \template_engine\Output::escapeHtml('text') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('search').'') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml('') ?>
            </span>
          </div>
        </div>
       <?php } ?>
    </div>
  </div>