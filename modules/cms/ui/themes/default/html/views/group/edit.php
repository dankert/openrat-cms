<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('group').' '.@$name.'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
          <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('users').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <?php foreach((array)@$users as $id=>$name) {  ?>
              <tr class="<?php echo O::escapeHtml('or-act-clickable or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/user/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
                  </a>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
      <br /><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('memberships') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
        </a>
      </div>
    </div>
  </section>