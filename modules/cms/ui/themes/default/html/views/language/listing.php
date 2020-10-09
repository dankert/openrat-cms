<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_language.png') ?>" /><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$name.'') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$isocode.'') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php $if1=(isset($default_url)); if($if1) {  ?>
                <span><?php echo O::escapeHtml(''.@O::lang('make_default').'') ?>
                </span>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <span><?php echo O::escapeHtml(''.@O::lang('is_default').'') ?>
                </span>
               <?php } ?>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php $if1=(isset($select_url)); if($if1) {  ?>
                <span><?php echo O::escapeHtml(''.@O::lang('select').'') ?>
                </span>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <span><?php echo O::escapeHtml(''.@O::lang('selected').'') ?>
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