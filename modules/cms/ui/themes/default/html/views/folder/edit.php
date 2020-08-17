<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <th><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('TYPE').'') ?>
              </span>
            </th>
            <th><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
              </span>
            </th>
            <th><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('LASTCHANGE').'') ?>
              </span>
            </th>
          </tr>
          <?php $if1=(isset($up_url)); if($if1) {  ?>
            <tr class="<?php echo escapeHtml('data clickable') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$parentid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/folder/'.@$parentid.'') ?>"><?php echo escapeHtml('') ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-folder') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml('..') ?>
                  </span>
                </a>
              </td>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml('') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data clickable') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-'.@$icon.'') ?>"><?php echo escapeHtml('') ?>
                </i>
              </td>
              <td><?php echo escapeHtml('') ?>
                <a title="<?php echo escapeHtml(''.@$desc.'') ?>" target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml(''.@$type.'') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/'.@$type.'/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$name.'') ?>
                  </span>
                  <span><?php echo escapeHtml(' ') ?>
                  </span>
                </a>
              </td>
              <td><?php echo escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                 <?php } ?>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=(($object)==FALSE); if($if1) {  ?>
            <tr><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
    <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
      <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('create') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'folder\',\'dialogMethod\':\'create\'}') ?>" href="<?php echo escapeHtml('/#/folder/') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
        <i class="<?php echo escapeHtml('image-icon image-icon--action-new') ?>"><?php echo escapeHtml('') ?>
        </i>
        <span><?php echo escapeHtml(''.@lang('new').'') ?>
        </span>
      </a>
    </div>
 <?php } ?>