<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-form') ?>"><?php echo escapeHtml('') ?>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('USER').'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('USER_USERNAME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$user_name.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('USER_FULLNAME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$user_fullname.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('USER_LOGIN_DATE').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($user_login); ?>
             <?php } ?>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('CMS').'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$cms_name.'') ?>
            </span>
            <span><?php echo escapeHtml(''.@$cms_version.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('OPERATOR').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$cms_operator.'') ?>
            </span>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('SYSTEM').'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('DATE_TIME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$time.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('OPERATING_SYSTEM').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$os.'') ?>
            </span>
            <span><?php echo escapeHtml(''.@$release.'') ?>
            </span>
            <span><?php echo escapeHtml(''.@$machine.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('INTERPRETER').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$version.'') ?>
            </span>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('LICENSE').'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
            <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
              <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('name').'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('license').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$software as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                  <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                    <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$url.'') ?>" data-type="<?php echo escapeHtml('external') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml(''.@$url.'') ?>"><?php echo escapeHtml('') ?>
                      <span><?php echo escapeHtml(''.@$name.'') ?>
                      </span>
                    </a>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$license.'') ?>
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