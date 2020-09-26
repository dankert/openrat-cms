<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon_user.png') ?>" /><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('LOGIN').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('clickable clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/user/'.@$id.'') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$fullname.'') ?>
              </span>
              <?php $if1=($isAdmin); if($if1) {  ?>
                <span><?php echo O::escapeHtml('_(') ?>
                </span>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_ADMIN').'') ?>
                </span>
                <span><?php echo O::escapeHtml(')') ?>
                </span>
               <?php } ?>
            </td>
            <td class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('switch') ?>" data-id="<?php echo O::escapeHtml(''.@$userid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"user","subaction":"switch","id":"'.@$userid.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('LOGIN').'') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('3') ?>" class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@O::lang('add').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('add').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@O::lang('new').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>