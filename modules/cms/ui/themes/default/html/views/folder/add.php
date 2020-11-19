<?php /* THIS FILE IS GENERATED from add.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-linklist') ?>"><?php echo O::escapeHtml('') ?>
    <?php $if3=($mayCreateFolder); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createfolder') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createfolder') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createfolder').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreatePage); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createpage') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createpage') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createpage').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreateFile); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createfile') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createfile') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createfile').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreateImage); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createimage') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createimage') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createimage').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreateText); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createtext') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createtext') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createtext').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreateUrl); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createurl') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createurl') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createurl').'') ?></span>
        </a>
      </div>
     <?php } ?>
    <?php $if3=($mayCreateLink); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('createlink') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('createlink') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('menu_createlink').'') ?></span>
        </a>
      </div>
     <?php } ?>
  </div>