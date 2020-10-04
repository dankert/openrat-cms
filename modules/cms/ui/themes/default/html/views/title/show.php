<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-menu') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-menu-group') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('toolbar-icon or-act-nav-open-close or--visible-on-mobile') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--menu-menu') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </div>
      <div class="<?php echo O::escapeHtml('toolbar-icon or-act-nav-toggle-small or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--menu-menu') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </div>
      <?php $if1=(isset($dbname)); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--action-database') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
          </span>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('entry') ?>"><?php echo O::escapeHtml('') ?>
              <span title="<?php echo O::escapeHtml(''.@$dbid.'') ?>"><?php echo O::escapeHtml(''.@$dbname.'') ?>
              </span>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo O::escapeHtml('') ?>
          <a title="<?php echo O::escapeHtml(''.@O::lang('menu_new_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('add') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-image on-action-text on-action-pageelement on-action-template') ?>"><?php echo O::escapeHtml('') ?>
          <a title="<?php echo O::escapeHtml(''.@O::lang('menu_pub_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('pub') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('pub') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </a>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon menu') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--action-file') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('file').'') ?>
          </span>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_new_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('add') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_new').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','method','add').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createfolder_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createfolder') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createfolder') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createfolder').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createpage_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createpage') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createpage') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createpage').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createfile_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createfile') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createfile') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createfile').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createimage_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createimage') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createimage') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createimage').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createtext_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createtext') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createtext') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createtext').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createlink_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createlink') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createlink') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createlink').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_createurl_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createurl') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createurl') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_createurl').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_compress_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('compress') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('compress') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'compress\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-compress') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_compress').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_decompress_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('decompress') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('decompress') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'decompress\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-decompress') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_decompress').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_extract_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('extract') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('extract') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extract\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-extract') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_extract').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('logout') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"login","subaction":"logout","id":"","token":"'.@$_token.'","none":"0"}') ?>" class="<?php echo O::escapeHtml('entry') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon menu') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--menu-edit') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('edit').'') ?>
          </span>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-user on-action-project on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file on-action-url on-action-image on-action-text on-action-language on-action-model') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_prop_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('prop') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-prop') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_prop').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','method','prop').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-link on-action-folder on-action-page on-action-file on-action-text on-action-url on-action-image') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_settings_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('settings') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('settings') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'settings\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-settings') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_settings').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-page on-action-file on-action-folder on-action-text on-action-image on-action-pageelement on-action-template') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_pub_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('pub') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('pub') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_pub').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','method','pub').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-pageelement') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_archive_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('archive') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('archive') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'archive\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>" class="<?php echo O::escapeHtml('entry') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-archive') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_archive').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','method','archive').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file on-action-image on-action-text on-action-url') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_rights_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('rights') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('rights') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'rights\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-rights') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_rights').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','method','rights').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_history_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('history') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('history') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'history\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-history') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_history').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-url on-action-image on-action-text on-action-link on-action-language on-action-model on-action-user on-action-group') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_delete_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('remove') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('remove') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'remove\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-delete') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_delete').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_preview_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('preview') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('preview') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'preview\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-preview') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_preview').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon menu') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--menu-extra') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('extras').'') ?>
          </span>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-user') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_password_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('pw') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pw\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-password') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_password').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-user on-action-group') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_memberships_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('memberships') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('memberships') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'memberships\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-membership') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_memberships').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder on-action-element on-action-file on-action-image on-action-text on-action-pageelement') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_advanced_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('advanced') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('advanced') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'advanced\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-advanced') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_advanced').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-page') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_changetemplate_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('changetemplate') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('changetemplate') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'changetemplate\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-changetemplate') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_changetemplate').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-template on-action-configuration on-action-page') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_src_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('src') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('src') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'src\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-code') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_src').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-template') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_extension_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('extension') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('extension') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extension\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-extension') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_extension').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-text') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_value_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('value') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'value\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-value') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_value').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_order_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('order') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('order') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'order\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-order') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_order').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-image') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_size_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('size') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('size') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'size\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-size') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_size').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable filtered on-action-project') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_maintenance_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('maintenance') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('maintenance') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'maintenance\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-maintenance') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_maintenance').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-menu-group') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('toolbar-icon user menu') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@$userfullname.'') ?>
        </span>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if1=($isLoggedIn); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_PROFILE_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('profile') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('edit') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'edit\'}') ?>" href="<?php echo O::escapeHtml('/#/profile/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_profile').'') ?>
                </span>
                <span class="<?php echo O::escapeHtml('keystroke') ?>"><?php echo O::escapeHtml(''.O::config('ui','keybinding','action','profile').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_password_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('profile') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('pw') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo O::escapeHtml('/#/profile/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-password') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_password').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_mail_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('mail') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('profile') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('mail') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'mail\'}') ?>" href="<?php echo O::escapeHtml('/#/profile/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-mail') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_mail').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_license_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('license') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('login') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('license') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'license\'}') ?>" href="<?php echo O::escapeHtml('/#/login/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-info') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_info').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('menu_history_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('history') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('profile') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('history') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'history\'}') ?>" href="<?php echo O::escapeHtml('/#/profile/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-history') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('menu_history').'') ?>
                </span>
              </a>
            </div>
            <div class="<?php echo O::escapeHtml('divide') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a data-after-success="<?php echo O::escapeHtml('reloadAll') ?>" title="<?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('logout') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"login","subaction":"logout","id":"","token":"'.@$_token.'","none":"0"}') ?>" class="<?php echo O::escapeHtml('entry') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT').'') ?>
                </span>
              </a>
            </div>
           <?php } ?>
          <?php if(!$if1) {  ?>
            <div class="<?php echo O::escapeHtml('entry clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('USER_LOGIN_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('login') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('login') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('login') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'login\'}') ?>" href="<?php echo O::escapeHtml('/#/login/') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--method-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_LOGIN').'') ?>
                </span>
              </a>
            </div>
           <?php } ?>
        </div>
      </div>
      <?php $if1=($isLoggedIn); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('toolbar-icon menu search') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--method-search') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <input name="<?php echo O::escapeHtml('text') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('search').'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--dropdown') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
            </span>
          </div>
        </div>
       <?php } ?>
    </div>
  </div>