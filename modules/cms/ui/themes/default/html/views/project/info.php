<?php /* THIS FILE IS GENERATED from info.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)$info as $list_key=>$list_value) {  ?>
    <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
      <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang(''.@$list_key.'').'') ?>
      </h3>
      <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@$list_value.'') ?>
        </span>
      </div>
    </section>
   <?php } ?>