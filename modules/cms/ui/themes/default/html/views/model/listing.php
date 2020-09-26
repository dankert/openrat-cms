<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml('') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml('') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_model.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php $if1=(isset($default_url)); if($if1) {  ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('make_default').'') ?>
                </span>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('is_default').'') ?>
                </span>
               <?php } ?>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php $if1=(isset($select_url)); if($if1) {  ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('select').'') ?>
                </span>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('selected').'') ?>
                </span>
               <?php } ?>
            </td>
          </tr>
          <?php  { unset($select_url) ?>
           <?php } ?>
          <?php  { unset($default_url}) ?>
           <?php } ?>
         <?php } ?>
      </table>
    </div>
  </div>