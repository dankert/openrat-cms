<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('name').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('type').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$elements as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('element') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/element/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$type.'') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span title="<?php echo escapeHtml(''.@$description.'') ?>"><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('el_'.@$type.'').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=(($elements)==FALSE); if($if1) {  ?>
          <tr><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('template') ?>" data-method="<?php echo escapeHtml('addel') ?>" data-id="<?php echo escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'template\',\'dialogMethod\':\'addel\'}') ?>" href="<?php echo escapeHtml('/#/template/'.@$templateid.'') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('menu_template_addel').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <?php foreach((array)$models as $list_key=>$list_value) { extract($list_value); ?>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@$name.'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
          <code><?php echo escapeHtml(''.@$source.'') ?>
          </code>
          <br /><?php echo escapeHtml('') ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('src') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'modelid\':\''.@$modelid.'\'}') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('or-form-button') ?>"><?php echo escapeHtml('') ?>
            <i class="<?php echo escapeHtml('image-icon image-icon--action-template') ?>"><?php echo escapeHtml('') ?>
            </i>
            <span><?php echo escapeHtml(''.@lang('edit').'') ?>
            </span>
          </a>
        </div>
      </div>
    </fieldset>
   <?php } ?>