<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('name') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@$description.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('type').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('filename') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </i>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('el_'.@$element_type.'').'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('template').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('template') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$template_id.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/template/'.@$template_id.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-template') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$template_name.'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('element').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" date-name="<?php echo \template_engine\Output::escapeHtml(''.@$element_name.'') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@$element_name.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('element') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$element_id.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/element/'.@$element_id.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$element_type.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$element_name.'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('format').'') ?>
            </span>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('element').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@$element_format.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('format').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@$format.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('lastchange').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_date') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </i>
            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
             <?php } ?>
            <span><?php echo \template_engine\Output::escapeHtml(', ') ?>
            </span>
            <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </i>
            <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
             <?php } ?>
          </td>
        </tr>
      </table>
    </div>
  </div>