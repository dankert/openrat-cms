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
            <td data-name="<?php echo escapeHtml(''.@$name.'') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('clickable clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('user') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/user/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td data-name="<?php echo escapeHtml(''.@$name.'') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
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
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('user') ?>" data-method="<?php echo escapeHtml('switch') ?>" data-id="<?php echo escapeHtml(''.@$userid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" data-data="<?php echo escapeHtml('{"action":"user","subaction":"switch","id":"'.@$userid.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('LOGIN').'') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('3') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@lang('add').'') ?>" name="<?php echo escapeHtml(''.@lang('add').'') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('add') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('new').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>