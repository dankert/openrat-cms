<?php if (defined('OR_TITLE')) {  ?>
  
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
          </tr>
          <?php $if1=((groups)==FALSE); if($if1) {  ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach((array)groups as $list_key=>$group) {  ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$group.'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>