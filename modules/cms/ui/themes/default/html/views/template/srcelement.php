<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('srcelement') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form template') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('template') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('srcelement') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <?php $if1=(isset($elements)); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('addelement') ?>" <?php if(@$type=='addelement'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('value').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('elementid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($elements as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$elementid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
       <?php } ?>
      <?php $if1=(isset($writable_elements)); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </fieldset>
        <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('addicon') ?>" <?php if(@$type=='addicon'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('ICON').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('writable_elementid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($writable_elements as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$writable_elementid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('addifempty') ?>" <?php if(@$type=='addifempty'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('TEMPLATE_SRC_IFEMPTY').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('addifnotempty') ?>" <?php if(@$type=='addifnotempty'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('TEMPLATE_SRC_IFNOTEMPTY').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>