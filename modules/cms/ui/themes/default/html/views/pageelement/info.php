<?php /* THIS FILE IS GENERATED from info.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
            </span>
          </td>
          <td class="<?php echo O::escapeHtml('or-name') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$name.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$description.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('type').'') ?>
            </span>
          </td>
          <td class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$element_type.'') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$element_type.'').'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('template').'') ?>
            </span>
          </td>
          <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$template_id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/template/'.@$template_id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@$template_name.'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('element').'') ?>
            </span>
          </td>
          <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@$element_name.'') ?>" name="<?php echo O::escapeHtml(''.@$element_name.'') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$element_id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$element_id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$element_type.'') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@$element_name.'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('format').'') ?>
            </span>
            <span><?php echo O::escapeHtml(''.@O::lang('element').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$element_format.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('format').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$format.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('lastchange').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($lastchange_date); ?>
             <?php } ?>
            <span><?php echo O::escapeHtml(', ') ?>
            </span>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($lastchange_user); ?>
             <?php } ?>
          </td>
        </tr>
      </table>
    </div>
  </div>