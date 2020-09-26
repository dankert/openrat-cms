<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-linklist') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <?php $if1=($mayCreateFolder); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfolder') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfolder').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreatePage); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createpage') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createpage').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateFile); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfile') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createfile').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateImage); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createimage') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createimage').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateText); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createtext') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createtext').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateUrl); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createurl') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createurl').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateLink); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createlink') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_createlink').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
  </div>