<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-linklist') ?>"><?php echo escapeHtml('') ?>
    <?php $if1=($mayCreateFolder); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createfolder') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfolder\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createfolder').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreatePage); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createpage') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createpage\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createpage').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateFile); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createfile') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createfile\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createfile').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateImage); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createimage') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createimage\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createimage').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateText); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createtext') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createtext\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createtext').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateUrl); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createurl') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createurl\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createurl').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
    <?php $if1=($mayCreateLink); if($if1) {  ?>
      <div class="<?php echo escapeHtml('clickable or-linklist-line or-round-corners or-hover-effect') ?>"><?php echo escapeHtml('') ?>
        <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('createlink') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'createlink\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_createlink').'') ?>
          </span>
        </a>
      </div>
     <?php } ?>
  </div>