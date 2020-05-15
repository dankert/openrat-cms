<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form pageelement') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('pageelement') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
            <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('name').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$name.'') ?>
                  </span>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('description').'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$description.'') ?>
                  </span>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('type').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@lang('el_'.@$element_type.'').'') ?>
                  </span>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                  <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                    <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('additional_info').'') ?>
                      <img /><?php echo escapeHtml('') ?>
                      <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                      </div>
                      <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                      </div>
                    </legend>
                    <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                    </div>
                  </fieldset>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('template').'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <?php $if1=(isset($template_url)); if($if1) {  ?>
                    <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$template_url.'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                      <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo escapeHtml('') ?>
                      <span><?php echo escapeHtml(''.@$template_name.'') ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php $if1=(($template_url)==FALSE); if($if1) {  ?>
                    <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$template_name.'') ?>
                    </span>
                   <?php } ?>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('element').'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <?php $if1=(isset($element_url)); if($if1) {  ?>
                    <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$element_url.'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                      <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo escapeHtml('') ?>
                      </i>
                      <span><?php echo escapeHtml(''.@$element_name.'') ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php $if1=(($element_url)==FALSE); if($if1) {  ?>
                    <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/element.png') ?>" /><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$element_name.'') ?>
                    </span>
                   <?php } ?>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                  <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                    <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('prop_userinfo').'') ?>
                      <img /><?php echo escapeHtml('') ?>
                      <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                      </div>
                      <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                      </div>
                    </legend>
                    <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                    </div>
                  </fieldset>
                </td>
              </tr>
              <tr><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('lastchange').'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
                    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
                    </div>
                    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                        <tr><?php echo escapeHtml('') ?>
                          <td><?php echo escapeHtml('') ?>
                            <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo escapeHtml('') ?>
                            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                             <?php } ?>
                          </td>
                          <td><?php echo escapeHtml('') ?>
                            <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo escapeHtml('') ?>
                            <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                             <?php } ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>