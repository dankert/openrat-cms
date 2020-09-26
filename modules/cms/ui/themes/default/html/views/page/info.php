<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('info') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('page') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form page') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('page') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('info') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <span class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
      </span>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('type').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang(''.@$type.'').'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('filename').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('description') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$description.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('prop') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-link-btn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </fieldset>
      <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </span>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
              </span>
            </label>
            <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </span>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
              </span>
            </label>
            <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </span>
              <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('alias').'') ?>
              </span>
            </label>
            <div class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('page') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('name') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/page/') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-link-btn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('additional_info').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('full_filename').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('filename') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$full_filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('full_filename').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('filename') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$tmp_filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('template').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php $if1=(isset($templateid)); if($if1) {  ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('template') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/template/'.@$templateid.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </i>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$template_name.'') ?>
                    </span>
                  </a>
                </div>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$template_name.'') ?>
                </span>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('FILE_MIMETYPE').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span class="<?php echo \template_engine\Output::escapeHtml('filename') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$mime_type.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('id').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('prop_userinfo').'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($create_date); ?>
                 <?php } ?>
                <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($create_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
                <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($published_date); ?>
                 <?php } ?>
                <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($published_user); ?>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>