<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_user.png') ?>" /><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('name').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml('') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('LOGIN').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_user.png') ?>" /><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$name.'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$fullname.'') ?>
              </span>
              <?php $if1=($isAdmin); if($if1) {  ?>
                <span><?php echo escapeHtml('_(') ?>
                </span>
                <span><?php echo escapeHtml(''.@lang('USER_ADMIN').'') ?>
                </span>
                <span><?php echo escapeHtml(')') ?>
                </span>
               <?php } ?>
            </td>
            <td><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('index') ?>" data-method="<?php echo escapeHtml('switchuser') ?>" data-id="<?php echo escapeHtml(''.@$userid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/index/'.@$userid.'') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('LOGIN').'}') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>