<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-form') ?>"><?php echo O::escapeHtml('') ?>
    <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('USER').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </legend>
      <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$user_name.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('USER_FULLNAME').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$user_fullname.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('USER_LOGIN_DATE').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($user_login); ?>
             <?php } ?>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('CMS').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </legend>
      <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$cms_name.'') ?>
            </span>
            <span><?php echo O::escapeHtml(''.@$cms_version.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('OPERATOR').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$cms_operator.'') ?>
            </span>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('SYSTEM').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </legend>
      <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('DATE_TIME').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$time.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('OPERATING_SYSTEM').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$os.'') ?>
            </span>
            <span><?php echo O::escapeHtml(''.@$release.'') ?>
            </span>
            <span><?php echo O::escapeHtml(''.@$machine.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('INTERPRETER').'') ?>
            </span>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$version.'') ?>
            </span>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('LICENSE').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </legend>
      <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
            <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
              <tr class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
                  </span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('license').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$software as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                  <td class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$url.'') ?>" data-type="<?php echo O::escapeHtml('external') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml(''.@$url.'') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$name.'') ?>
                      </span>
                    </a>
                  </td>
                  <td><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$license.'') ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </fieldset>
  </div>