<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('id').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$id.'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('pages').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$pages as $pageid=>$name) {  ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('page') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$pageid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/page/'.@$pageid.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-page') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>