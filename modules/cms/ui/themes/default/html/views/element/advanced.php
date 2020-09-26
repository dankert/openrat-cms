<?php if (!defined('OR_TITLE')) exit(); ?>
  <?php $if1=(config('security','disable_dynamic_code')); if($if1) {  ?>
    <?php $if1=(!1); if($if1) {  ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('message warn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOTICE_CODE_DISABLED').'') ?>
        </span>
      </div>
     <?php } ?>
   <?php } ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('advanced') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('element') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form element') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('element') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('advanced') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <?php $if1=(isset($subtype)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('ELEMENT_SUBTYPE').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=(isset($subtypes)); if($if1) {  ?>
                  <select name="<?php echo \template_engine\Output::escapeHtml('subtype') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LIST_ENTRY_EMPTY').'') ?>
                    </option>
                    <?php foreach($subtypes as $_key=>$_value) {  ?>
                      <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$subtype){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                      </option>
                     <?php } ?>
                  </select>
                 <?php } ?>
                <?php $if1=!(isset($subtypes)); if($if1) {  ?>
                  <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input name="<?php echo \template_engine\Output::escapeHtml('subtype') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$subtype.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                  </div>
                 <?php } ?>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($with_icon)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('with_icon') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$with_icon){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_WITH_ICON').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($inherit)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('inherit') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$inherit){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_INHERIT').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($all_languages)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('all_languages') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$all_languages){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_ALL_LANGUAGES').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($writable)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('writable') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$writable){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_writable').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($width)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('width').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('width') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$width.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($height)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('height').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('height') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$height.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($dateformat)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DATEFORMAT').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('dateformat') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($dateformats as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dateformat){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($format)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_FORMAT').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach( $formatlist as $_key=>$_value) {  ?>
                  <label><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('format') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </span>
                  </label>
                  <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($decimals)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DECIMALS').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('decimals') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('2') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$decimals.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($dec_point)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DEC_POINT').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('dec_point') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('5') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$dec_point.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($thousand_sep)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_thousand_sep').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('thousand_sep') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('1') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$thousand_sep.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($default_text)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_default_text').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('default_text') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('255') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$default_text.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($default_longtext)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_default_longtext').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <textarea name="<?php echo \template_engine\Output::escapeHtml('default_longtext') ?>" class="<?php echo \template_engine\Output::escapeHtml('inputarea') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$default_longtext.'') ?>
                </textarea>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($parameters)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DYNAMIC_PARAMETERS').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <textarea name="<?php echo \template_engine\Output::escapeHtml('parameters') ?>" class="<?php echo \template_engine\Output::escapeHtml('inputarea') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$parameters.'') ?>
                </textarea>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach((array)$dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$paramName.'') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(' (') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DEFAULT').'') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(') = ') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$defaultValue.'') ?>
                  </span>
                  <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($select_items)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_select_items').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <textarea name="<?php echo \template_engine\Output::escapeHtml('select_items') ?>" class="<?php echo \template_engine\Output::escapeHtml('inputarea') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$select_items.'') ?>
                </textarea>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($linkelement)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_LINK').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('linkelement') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($linkelements as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkelement){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($name)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('ELEMENT_NAME').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('name') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($names as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$name){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($folderobjectid)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DEFAULT_FOLDEROBJECT').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('folderobjectid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($folders as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$folderobjectid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($default_objectid)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_DEFAULT_OBJECT').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('default_objectid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <option value="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LIST_ENTRY_EMPTY').'') ?>
                  </option>
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$default_objectid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($code)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('EL_PROP_code').'') ?>
                </span>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <textarea name="<?php echo \template_engine\Output::escapeHtml('code') ?>" class="<?php echo \template_engine\Output::escapeHtml('inputarea') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$code.'') ?>
                </textarea>
              </div>
            </div>
           <?php } ?>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>