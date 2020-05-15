<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('name').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$name.'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('description').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$description.'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('type').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('el_'.@$element_type.'').'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('template').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('template') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$template_id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/template/'.@$template_id.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-template') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@$template_name.'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('element').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$element_name.'') ?>" name="<?php echo escapeHtml(''.@$element_name.'') ?>" data-action="<?php echo escapeHtml('element') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$element_id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/element/'.@$element_id.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@$element_name.'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('format').'') ?>
              </span>
              <span><?php echo escapeHtml(''.@lang('element').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$element_format.'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('format').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$format.'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('lastchange').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-el_date') ?>"><?php echo escapeHtml('') ?>
              </i>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
              <span><?php echo escapeHtml(', ') ?>
              </span>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
              </i>
              <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
               <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>