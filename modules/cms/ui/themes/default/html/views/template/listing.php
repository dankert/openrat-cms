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
              <?php foreach((array)$templates as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$name.'') ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
        <?php $if1=(($templates)==FALSE); if($if1) {  ?>
          <span><?php echo escapeHtml(''.@lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC').'') ?>
          </span>
         <?php } ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('template') ?>" data-method="<?php echo escapeHtml('add') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/template/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_template_add').'') ?>
          </span>
        </a>
 <?php } ?>