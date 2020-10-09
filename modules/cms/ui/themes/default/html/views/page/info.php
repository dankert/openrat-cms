<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-page') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('page') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('info') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <span class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml(''.@$name.'') ?>
      </span>
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('type').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang(''.@$type.'').'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('filename').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-description') ?>"><?php echo O::escapeHtml(''.@$description.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('or-value or-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('prop') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>" class="<?php echo O::escapeHtml('or-btn') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </fieldset>
      <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
        <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@$languagename.'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </legend>
          <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('or-form-row') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-form-input') ?>"><?php echo O::escapeHtml('') ?>
              </span>
              <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
              </span>
            </label>
            <label class="<?php echo O::escapeHtml('or-form-row') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-form-input') ?>"><?php echo O::escapeHtml('') ?>
              </span>
              <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
              </span>
            </label>
            <label class="<?php echo O::escapeHtml('or-form-row') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-form-input') ?>"><?php echo O::escapeHtml('') ?>
              </span>
              <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('alias').'') ?>
              </span>
            </label>
            <div class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-method="<?php echo O::escapeHtml('name') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-languageid="<?php echo O::escapeHtml(''.@$languageid.'') ?>" data-extra="<?php echo O::escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo O::escapeHtml('/#/page/') ?>" class="<?php echo O::escapeHtml('or-btn') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-closed or-show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('additional_info').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </legend>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('full_filename').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$full_filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('full_filename').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$tmp_filename.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('template').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php $if1=(isset($templateid)); if($if1) {  ?>
                <div class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/template/'.@$templateid.'') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?>
                    </i>
                    <span><?php echo O::escapeHtml(''.@$template_name.'') ?>
                    </span>
                  </a>
                </div>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@$template_name.'') ?>
                </span>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('FILE_MIMETYPE').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$mime_type.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('id').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$objectid.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      
        <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-closed or-show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('prop_userinfo').'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </legend>
          <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($create_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($create_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml('') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($published_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($published_user); ?>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
    </div>
  </form>