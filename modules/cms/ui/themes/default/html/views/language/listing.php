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
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml('') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml('') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml('') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                  <td><?php echo escapeHtml('') ?>
                    <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon_language.png') ?>" /><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$name.'') ?>
                    </span>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$isocode.'') ?>
                    </span>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <?php $if1=(isset($default_url)); if($if1) {  ?>
                      <span><?php echo escapeHtml(''.@lang('make_default').'') ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo escapeHtml(''.@lang('is_default').'') ?>
                      </span>
                     <?php } ?>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <?php $if1=(isset($select_url)); if($if1) {  ?>
                      <span><?php echo escapeHtml(''.@lang('select').'') ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo escapeHtml(''.@lang('selected').'') ?>
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
 <?php } ?>