<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form pageelement') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('pageelement') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('prop') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('name') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$name.'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
                </span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$description.'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('type').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('filename') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$element_type.'').'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
                <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
                  <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('additional_info').'') ?>
                    <img /><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                    </div>
                    <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                    </div>
                  </legend>
                  <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                  </div>
                </fieldset>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('template').'') ?>
                </span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <?php $if1=(isset($template_url)); if($if1) {  ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$template_url.'') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                    <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$template_name.'') ?>
                    </span>
                  </a>
                 <?php } ?>
                <?php $if1=(($template_url)==FALSE); if($if1) {  ?>
                  <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$template_name.'') ?>
                  </span>
                 <?php } ?>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('element').'') ?>
                </span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <?php $if1=(isset($element_url)); if($if1) {  ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$element_url.'') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo O::escapeHtml('') ?>
                    </i>
                    <span><?php echo O::escapeHtml(''.@$element_name.'') ?>
                    </span>
                  </a>
                 <?php } ?>
                <?php $if1=(($element_url)==FALSE); if($if1) {  ?>
                  <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/element.png') ?>" /><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$element_name.'') ?>
                  </span>
                 <?php } ?>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
                <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
                  <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('prop_userinfo').'') ?>
                    <img /><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                    </div>
                    <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                    </div>
                  </legend>
                  <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                  </div>
                </fieldset>
              </td>
            </tr>
            <tr><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('lastchange').'') ?>
                </span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                    <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                      <tr><?php echo O::escapeHtml('') ?>
                        <td><?php echo O::escapeHtml('') ?>
                          <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo O::escapeHtml('') ?>
                          <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                           <?php } ?>
                        </td>
                        <td><?php echo O::escapeHtml('') ?>
                          <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo O::escapeHtml('') ?>
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
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>