<?php /* THIS FILE IS GENERATED from all.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('all') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('post') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-pageelement') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('pageelement') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('all') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('elementid') ?>" value="<?php echo O::escapeHtml(''.@$elementid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('value_time') ?>" value="<?php echo O::escapeHtml(''.@$value_time.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php foreach((array)@$elements as $list_key=>$list_value) { extract($list_value); ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
            <span><?php echo O::escapeHtml(''.@$label.'') ?></span>
          </h2>
          <p class="<?php echo O::escapeHtml('or-group-description or-collapsible-value') ?>"><?php echo O::escapeHtml(''.@$desc.'') ?></p>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            
              <?php $if6=($type=='insert'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <select name="<?php echo O::escapeHtml(''.@$name.'') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                      <?php foreach($objects as $_key=>$_value) {  ?>
                        <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='number'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('decimals') ?>" value="<?php echo O::escapeHtml('decimals') ?>" /><?php echo O::escapeHtml('') ?>
                      <?php $if9=($decimals); if($if9) {  ?>
                        <?php  { $type= 'number'; ?>
                         <?php } ?>
                       <?php } ?>
                      <?php if(!$if9) {  ?>
                        <?php  { $type= text; ?>
                         <?php } ?>
                       <?php } ?>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml(''.@$type.'') ?>" maxlength="<?php echo O::escapeHtml('20') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                    </div>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='range'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('range') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='checkbox'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                      <label><?php echo O::escapeHtml('') ?>
                        <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if($value){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" <?php if($value){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                        <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@$label.'') ?></span>
                      </label>
                    </div>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='select'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <select name="<?php echo O::escapeHtml(''.@$name.'') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                      <?php foreach($items as $_key=>$_value) {  ?>
                        <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='selects'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <select name="<?php echo O::escapeHtml(''.@$name.'') ?>" multiple="<?php echo O::escapeHtml('multiple') ?>" size="<?php echo O::escapeHtml('5') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                      <?php foreach($items as $_key=>$_value) {  ?>
                        <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='datetime'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('datetime').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('datetime-local') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='date'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('date').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('date') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='time'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('time').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('time') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='week'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('week').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('week') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='month'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('month').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('month') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='color'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('color').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('color') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='text'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('text').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='url'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('text').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='tel'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('text').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('tel') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='mail'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('text').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('email') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='password'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('text').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('password') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" list="<?php echo O::escapeHtml(''.@$name.'_list') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      <datalist id="<?php echo O::escapeHtml(''.@$name.'_list') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($items as $_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_value.'') ?>"><?php echo O::escapeHtml('') ?></option>
                         <?php } ?>
                      </datalist>
                    </label>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='data'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div><?php echo O::escapeHtml('') ?>
                      <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-extension="<?php echo O::escapeHtml('') ?>" data-mimetype="<?php echo O::escapeHtml('') ?>" data-mode="<?php echo O::escapeHtml('yaml') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-code-editor') ?>"><?php echo O::escapeHtml(''.@$value.'') ?></textarea>
                      <trix-editor input="<?php echo O::escapeHtml(''.@$name.'') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                    </div>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='longtext'); if($if6) {  ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$format.'') ?>" /><?php echo O::escapeHtml('') ?>
                <?php $if7=($editor=='markdown'); if($if7) {  ?>
                  <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                    <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                    <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                      <div><?php echo O::escapeHtml('') ?>
                        <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-markdown-editor') ?>"><?php echo O::escapeHtml(''.@$value.'') ?></textarea>
                        <trix-editor input="<?php echo O::escapeHtml(''.@$name.'') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                      </div>
                    </div>
                  </section>
                 <?php } ?>
                <?php $if7=($editor=='html'); if($if7) {  ?>
                  <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                    <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                    <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                      <div><?php echo O::escapeHtml('') ?>
                        <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" id="<?php echo O::escapeHtml('pageelement_edit_editor') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-html-editor') ?>"><?php echo ''.@$value.'' ?></textarea>
                        <trix-editor input="<?php echo O::escapeHtml(''.@$name.'') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                      </div>
                    </div>
                  </section>
                 <?php } ?>
                <?php $if7=($editor=='wiki'); if($if7) {  ?>
                  <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                    <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                    <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                      <div><?php echo O::escapeHtml('') ?>
                        <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-wiki-editor') ?>"><?php echo ''.@$value.'' ?></textarea>
                        <trix-editor input="<?php echo O::escapeHtml(''.@$name.'') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                      </div>
                      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
                        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span><?php echo O::escapeHtml(''.@O::lang('help').'') ?></span>
                        </h2>
                        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                          <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                            <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                              <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
                                <td><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','strong-begin']).'') ?></span>
                                  <span><?php echo O::escapeHtml(''.@O::lang('text_markup_strong').'') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','strong-end']).'') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','emphatic-begin']).'') ?></span>
                                  <span><?php echo O::escapeHtml(''.@O::lang('text_markup_emphatic').'') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','emphatic-end']).'') ?></span>
                                </td>
                                <td><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-numbered']).'') ?></span>
                                  <span><?php echo O::escapeHtml(''.@O::lang('text_markup_numbered_list').'') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-numbered']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                </td>
                                <td><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-unnumbered']).'') ?></span>
                                  <span><?php echo O::escapeHtml(''.@O::lang('text_markup_unnumbered_list').'') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-unnumbered']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                </td>
                                <td><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml(''.@O::lang('text_markup_table').'') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <span><?php echo O::escapeHtml('...') ?></span>
                                  <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                                  <br /><?php echo O::escapeHtml('') ?>
                                </td>
                              </table>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                  </section>
                 <?php } ?>
                <?php $if7=($editor=='text'); if($if7) {  ?>
                  <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                    <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                    <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                      <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-editor raw-editor') ?>"><?php echo O::escapeHtml(''.@$value.'') ?></textarea>
                    </div>
                  </section>
                 <?php } ?>
               <?php } ?>
              <?php $if6=($type=='link'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('link_target').'') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-selector or-droppable-selector') ?>"><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-value') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('text') ?>" name="<?php echo O::escapeHtml(''.@$name.'_text') ?>" placeholder="<?php echo O::escapeHtml(''.@$linkname.'') ?>" value="<?php echo O::escapeHtml(''.@$linkname.'') ?>" class="<?php echo O::escapeHtml('or-input or-selector-link-name or-act-selector-search') ?>" /><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-tree or-act-selector-tree-button') ?>"><?php echo O::escapeHtml('') ?></i>
                      <div class="<?php echo O::escapeHtml('or-dropdown or-act-selector-search-results') ?>"><?php echo O::escapeHtml('') ?></div>
                      <div type="<?php echo O::escapeHtml('hidden') ?>" data-types="<?php echo O::escapeHtml(''.@$types.'') ?>" data-init-id="<?php echo O::escapeHtml(''.@$linkobjectid.'') ?>" data-init-folderid="<?php echo O::escapeHtml(''.@$rootfolderid.'') ?>" class="<?php echo O::escapeHtml('or-navtree or-selector-tree or-act-load-selector-tree') ?>"><?php echo O::escapeHtml('') ?></div>
                    </div>
                  </div>
                </section>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('link_url').'') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <input name="<?php echo O::escapeHtml('linkurl') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$linkurl.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($type=='coord'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('latitude').' '.@O::lang('longitude').'') ?></span>
                      <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                    </label>
                  </div>
                </section>
               <?php } ?>
          </div>
        </section>
       <?php } ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php $if5=(isset($release)); if($if5) {  ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('release') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox or-remember') ?>" /><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('release') ?>" <?php if(@$release){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?></span>
                  </label>
                </div>
               <?php } ?>
              <?php $if5=(isset($publish)); if($if5) {  ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('publish') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox or-remember') ?>" /><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('publish') ?>" <?php if(@$publish){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('PAGE_PUBLISH_AFTER_SAVE').'') ?></span>
                  </label>
                </div>
               <?php } ?>
            </div>
          </section>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?></span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-apply') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-apply') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('APPLY').'') ?></span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('save').'') ?></span>
      </div>
    </div>
  </form>