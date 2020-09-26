<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('prop') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('prop') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('name') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
                </span>
              </td>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$description.'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('type').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('filename') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('el_'.@$element_type.'').'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('additional_info').'') ?>
                    <img /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </div>
                    <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </div>
                  </legend>
                  <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  </div>
                </fieldset>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('template').'') ?>
                </span>
              </td>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=(isset($template_url)); if($if1) {  ?>
                  <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-url="<?php echo \template_engine\Output::escapeHtml(''.@$template_url.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$template_name.'') ?>
                    </span>
                  </a>
                 <?php } ?>
                <?php $if1=(($template_url)==FALSE); if($if1) {  ?>
                  <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_template.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$template_name.'') ?>
                  </span>
                 <?php } ?>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('element').'') ?>
                </span>
              </td>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=(isset($element_url)); if($if1) {  ?>
                  <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-url="<?php echo \template_engine\Output::escapeHtml(''.@$element_url.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </i>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$element_name.'') ?>
                    </span>
                  </a>
                 <?php } ?>
                <?php $if1=(($element_url)==FALSE); if($if1) {  ?>
                  <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/element.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$element_name.'') ?>
                  </span>
                 <?php } ?>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('prop_userinfo').'') ?>
                    <img /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </div>
                    <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    </div>
                  </legend>
                  <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  </div>
                </fieldset>
              </td>
            </tr>
            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('lastchange').'') ?>
                </span>
              </td>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                  </div>
                  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <tr><?php echo \template_engine\Output::escapeHtml('') ?>
                        <td><?php echo \template_engine\Output::escapeHtml('') ?>
                          <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                          <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                           <?php } ?>
                        </td>
                        <td><?php echo \template_engine\Output::escapeHtml('') ?>
                          <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
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
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>