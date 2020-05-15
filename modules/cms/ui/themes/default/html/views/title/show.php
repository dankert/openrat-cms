<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-menu') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-menu-group') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('toolbar-icon toggle-nav-open-close') ?>"><?php echo escapeHtml('') ?>
          <i class="<?php echo escapeHtml('image-icon image-icon--menu-menu') ?>"><?php echo escapeHtml('') ?>
          </i>
        </div>
        <div class="<?php echo escapeHtml('toolbar-icon toggle-nav-small') ?>"><?php echo escapeHtml('') ?>
          <i class="<?php echo escapeHtml('image-icon image-icon--menu-minimize') ?>"><?php echo escapeHtml('') ?>
          </i>
        </div>
        <?php $if1=(isset($dbname)); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--action-database') ?>"><?php echo escapeHtml('') ?>
            </i>
            <span class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(' ') ?>
            </span>
            <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('entry') ?>"><?php echo escapeHtml('') ?>
                <span title="<?php echo escapeHtml(''.@$dbid.'') ?>"><?php echo escapeHtml(''.@$dbname.'') ?>
                </span>
              </div>
            </div>
          </div>
         <?php } ?>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo escapeHtml('') ?>
            <a title="<?php echo escapeHtml(''.@lang('menu_new_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('add') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
              </i>
            </a>
          </div>
         <?php } ?>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-image on-action-text on-action-pageelement on-action-template') ?>"><?php echo escapeHtml('') ?>
            <a title="<?php echo escapeHtml(''.@lang('menu_pub_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('pub') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo escapeHtml('') ?>
              </i>
            </a>
          </div>
         <?php } ?>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon menu') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--action-file') ?>"><?php echo escapeHtml('') ?>
            </i>
            <span class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('file').'') ?>
            </span>
            <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_new_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('add') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_new').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','method','add').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createfolder_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createfolder') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createfolder').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createpage_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createpage') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createpage').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createfile_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createfile') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createfile').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createimage_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createimage') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createimage').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createtext_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createtext') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createtext').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createlink_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createlink') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createlink').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_createurl_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createurl') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_createurl').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_compress_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('compress') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'compress\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-compress') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_compress').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_decompress_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('decompress') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'decompress\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-decompress') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_decompress').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-file') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_extract_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('extract') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extract\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-extract') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_extract').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('login') ?>" data-method="<?php echo escapeHtml('logout') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" data-data="<?php echo escapeHtml('{"action":"login","subaction":"logout","id":"",\"token":"<?php echo token() ?>","none":"0"}"') ?>" class="<?php echo escapeHtml('entry') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('USER_LOGOUT').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
         <?php } ?>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon menu') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--menu-edit') ?>"><?php echo escapeHtml('') ?>
            </i>
            <span class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('edit').'') ?>
            </span>
            <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-user on-action-project on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file on-action-url on-action-image on-action-text on-action-language on-action-model') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_prop_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-prop') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_prop').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','method','prop').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-link on-action-folder on-action-page on-action-file on-action-text on-action-url on-action-image') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_settings_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('settings') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'settings\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-settings') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_settings').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-page on-action-file on-action-folder on-action-text on-action-image on-action-pageelement on-action-template') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_pub_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('pub') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-publish') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_pub').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','method','pub').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-pageelement') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_archive_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('archive') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'archive\'}') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('entry') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-archive') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_archive').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','method','archive').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file on-action-image on-action-text on-action-url') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_rights_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('rights') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'rights\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-rights') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_rights').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','method','rights').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_history_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('history') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'history\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-history') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_history').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-url on-action-image on-action-text on-action-link on-action-language on-action-model on-action-user on-action-group') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_delete_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('remove') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'remove\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-delete') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_delete').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_preview_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('preview') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'preview\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-preview') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_preview').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
         <?php } ?>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon menu') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--menu-extra') ?>"><?php echo escapeHtml('') ?>
            </i>
            <span class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('extras').'') ?>
            </span>
            <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-user') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_password_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('pw') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pw\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-password') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_password').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-user on-action-group') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_memberships_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('memberships') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'memberships\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-membership') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_memberships').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder on-action-element on-action-file on-action-image on-action-text on-action-pageelement') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_advanced_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('advanced') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'advanced\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-advanced') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_advanced').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-page') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_changetemplate_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('changetemplate') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'changetemplate\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-changetemplate') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_changetemplate').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-template on-action-configuration on-action-page') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_src_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('src') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'src\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-code') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_src').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-template') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_extension_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('extension') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'extension\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-extension') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_extension').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-text') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_value_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('value') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'value\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-value') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_value').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-folder') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_order_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('order') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'order\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-order') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_order').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-image') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_size_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('size') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'size\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-size') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_size').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable filtered on-action-project') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_maintenance_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('maintenance') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'maintenance\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-maintenance') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_maintenance').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
         <?php } ?>
      </div>
      <div class="<?php echo escapeHtml('or-menu-group') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('toolbar-icon user menu') ?>"><?php echo escapeHtml('') ?>
          <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
          </i>
          <span class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@$userfullname.'') ?>
          </span>
          <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
            <?php $if1=($isLoggedIn); if($if1) {  ?>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_PROFILE_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-method="<?php echo escapeHtml('edit') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'edit\'}') ?>" href="<?php echo escapeHtml('/#/profile/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_profile').'') ?>
                  </span>
                  <span class="<?php echo escapeHtml('keystroke') ?>"><?php echo escapeHtml(''.config('ui','keybinding','action','profile').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_password_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-method="<?php echo escapeHtml('pw') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo escapeHtml('/#/profile/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-password') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_password').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_mail_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-method="<?php echo escapeHtml('mail') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'mail\'}') ?>" href="<?php echo escapeHtml('/#/profile/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-mail') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_mail').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_license_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('login') ?>" data-method="<?php echo escapeHtml('license') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'license\'}') ?>" href="<?php echo escapeHtml('/#/login/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-info') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_info').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('menu_history_desc').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-method="<?php echo escapeHtml('history') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'history\'}') ?>" href="<?php echo escapeHtml('/#/profile/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-history') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('menu_history').'') ?>
                  </span>
                </a>
              </div>
              <div class="<?php echo escapeHtml('divide') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a data-after-success="<?php echo escapeHtml('reloadAll') ?>" title="<?php echo escapeHtml(''.@lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('login') ?>" data-method="<?php echo escapeHtml('logout') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" data-data="<?php echo escapeHtml('{"action":"login","subaction":"logout","id":"",\"token":"<?php echo token() ?>","none":"0"}"') ?>" class="<?php echo escapeHtml('entry') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-logout') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('USER_LOGOUT').'') ?>
                  </span>
                </a>
              </div>
             <?php } ?>
            <?php if(!$if1) {  ?>
              <div class="<?php echo escapeHtml('entry clickable') ?>"><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@lang('USER_LOGIN_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('login') ?>" data-method="<?php echo escapeHtml('login') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'login\',\'dialogMethod\':\'login\'}') ?>" href="<?php echo escapeHtml('/#/login/') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--method-user') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('USER_LOGIN').'') ?>
                  </span>
                </a>
              </div>
             <?php } ?>
          </div>
        </div>
        <?php $if1=($isLoggedIn); if($if1) {  ?>
          <div class="<?php echo escapeHtml('toolbar-icon menu search') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--method-search') ?>"><?php echo escapeHtml('') ?>
            </i>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('text') ?>" placeholder="<?php echo escapeHtml(''.@lang('search').'') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$text.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml('') ?>
              </span>
            </div>
          </div>
         <?php } ?>
      </div>
    </div>
 <?php } ?>