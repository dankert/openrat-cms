<?php /* THIS FILE IS GENERATED from advanced.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php $if2=(O::config(['security','disable_dynamic_code'])); if($if2) {  ?>
    <?php $if3=(!1); if($if3) {  ?>
      <div class="<?php echo O::escapeHtml('or-message warn') ?>"><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@O::lang('NOTICE_CODE_DISABLED').'') ?></span>
      </div>
     <?php } ?>
   <?php } ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('advanced') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-element') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('element') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('advanced') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if4=(isset($subtype)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('ELEMENT_SUBTYPE').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php $if6=(isset($subtypes)); if($if6) {  ?>
                  <select name="<?php echo O::escapeHtml('subtype') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                    <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?></option>
                    <?php foreach($subtypes as $_key=>$_value) {  ?>
                      <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$subtype){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                     <?php } ?>
                  </select>
                 <?php } ?>
                <?php $if6=!(isset($subtypes)); if($if6) {  ?>
                  <input name="<?php echo O::escapeHtml('subtype') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$subtype.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($with_icon)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <label><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('with_icon') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$with_icon){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('with_icon') ?>" <?php if(@$with_icon){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_WITH_ICON').'') ?></span>
                </label>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($inherit)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <label><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('inherit') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$inherit){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('inherit') ?>" <?php if(@$inherit){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_INHERIT').'') ?></span>
                </label>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($all_languages)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <label><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('all_languages') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$all_languages){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('all_languages') ?>" <?php if(@$all_languages){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_ALL_LANGUAGES').'') ?></span>
                </label>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($writable)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <label><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('writable') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$writable){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('writable') ?>" <?php if(@$writable){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_writable').'') ?></span>
                </label>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($width)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('width').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('width') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$width.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($height)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('height').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('height') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$height.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($dateformat)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DATEFORMAT').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('dateformat') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($dateformats as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dateformat){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                   <?php } ?>
                </select>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($format)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_FORMAT').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach( $formatlist as $_key=>$_value) {  ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$_value.'') ?></span>
                  </label>
                  <br /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($decimals)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DECIMALS').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('decimals') ?>" type="<?php echo O::escapeHtml('number') ?>" maxlength="<?php echo O::escapeHtml('2') ?>" value="<?php echo O::escapeHtml(''.@$decimals.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($dec_point)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEC_POINT').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('dec_point') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('5') ?>" value="<?php echo O::escapeHtml(''.@$dec_point.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($thousand_sep)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_thousand_sep').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('thousand_sep') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('1') ?>" value="<?php echo O::escapeHtml(''.@$thousand_sep.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($default_text)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_default_text').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('default_text') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$default_text.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($default_longtext)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_default_longtext').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <textarea name="<?php echo O::escapeHtml('default_longtext') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$default_longtext.'') ?></textarea>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($parameters)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DYNAMIC_PARAMETERS').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <textarea name="<?php echo O::escapeHtml('parameters') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$parameters.'') ?></textarea>
              </div>
            </section>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach((array)@$dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
                  <span><?php echo O::escapeHtml(''.@$paramName.'') ?></span>
                  <span><?php echo O::escapeHtml(' (') ?></span>
                  <span><?php echo O::escapeHtml(''.@O::lang('DEFAULT_VALUE').'') ?></span>
                  <span><?php echo O::escapeHtml(') = ') ?></span>
                  <span><?php echo O::escapeHtml(''.@$defaultValue.'') ?></span>
                  <br /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($select_items)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_select_items').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <textarea name="<?php echo O::escapeHtml('select_items') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$select_items.'') ?></textarea>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($linkelement)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_LINK').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('linkelement') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($linkelements as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkelement){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                   <?php } ?>
                </select>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($name)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('ELEMENT_NAME').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('name') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($names as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$name){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                   <?php } ?>
                </select>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($folderobjectid)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEFAULT_FOLDEROBJECT').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('folderobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($folders as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$folderobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                   <?php } ?>
                </select>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($default_objectid)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEFAULT_OBJECT').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('default_objectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?></option>
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$default_objectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                   <?php } ?>
                </select>
              </div>
            </section>
           <?php } ?>
          <?php $if4=(isset($code)); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('EL_PROP_code').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <div><?php echo O::escapeHtml('') ?>
                  <textarea name="<?php echo O::escapeHtml('code') ?>" data-extension="<?php echo O::escapeHtml('') ?>" data-mimetype="<?php echo O::escapeHtml('') ?>" data-mode="<?php echo O::escapeHtml('js') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-code-editor') ?>"><?php echo O::escapeHtml(''.@$code.'') ?></textarea>
                  <trix-editor input="<?php echo O::escapeHtml('code') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                </div>
              </div>
            </section>
           <?php } ?>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?></span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?></span>
      </div>
    </div>
  </form>