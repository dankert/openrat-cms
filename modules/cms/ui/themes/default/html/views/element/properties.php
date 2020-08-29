<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('properties') ?>" data-action="<?php echo escapeHtml('element') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form element') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('element') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('properties') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <?php $if1=(isset($subtype)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('ELEMENT_SUBTYPE').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <?php $if1=(isset($subtypes)); if($if1) {  ?>
              <select name="<?php echo escapeHtml('subtype') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
                </option>
                <?php foreach($subtypes as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$subtype){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
             <?php } ?>
            <?php $if1=!(isset($subtypes)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('subtype') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$subtype.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($with_icon)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_WITH_ICON').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('with_icon') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$with_icon){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($all_languages)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_ALL_LANGUAGES').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('all_languages') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$all_languages){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($writable)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_writable').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('writable') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$writable){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($width)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('width').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('width') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$width.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($height)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('height').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('height') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$height.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($dateformat)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DATEFORMAT').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('dateformat') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($dateformats as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dateformat){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($format)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_FORMAT').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <?php foreach( $formatlist as $_key=>$_value) {  ?>
              <label><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('format') ?>" value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$_value.'') ?>
                </span>
              </label>
              <br /><?php echo escapeHtml('') ?>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($decimals)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DECIMALS').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('decimals') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('2') ?>" value="<?php echo escapeHtml(''.@$decimals.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($dec_point)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DEC_POINT').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('dec_point') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('5') ?>" value="<?php echo escapeHtml(''.@$dec_point.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($thousand_sep)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_thousand_sep').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('thousand_sep') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('1') ?>" value="<?php echo escapeHtml(''.@$thousand_sep.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_text)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_default_text').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('default_text') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$default_text.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_longtext)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_default_longtext').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <textarea name="<?php echo escapeHtml('default_longtext') ?>" class="<?php echo escapeHtml('inputarea') ?>"><?php echo escapeHtml(''.@$default_longtext.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($parameters)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DYNAMIC_PARAMETERS').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <textarea name="<?php echo escapeHtml('parameters') ?>" class="<?php echo escapeHtml('inputarea') ?>"><?php echo escapeHtml(''.@$parameters.'') ?>
            </textarea>
          </td>
        </tr>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
          </td>
          <td><?php echo escapeHtml('') ?>
            <?php foreach((array)$dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
              <span><?php echo escapeHtml(''.@$paramName.'') ?>
              </span>
              <span><?php echo escapeHtml(' (') ?>
              </span>
              <span><?php echo escapeHtml(''.@lang('DEFAULT').'') ?>
              </span>
              <span><?php echo escapeHtml(') = ') ?>
              </span>
              <span><?php echo escapeHtml(''.@$defaultValue.'') ?>
              </span>
              <br /><?php echo escapeHtml('') ?>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($select_items)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_select_items').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <textarea name="<?php echo escapeHtml('select_items') ?>" class="<?php echo escapeHtml('inputarea') ?>"><?php echo escapeHtml(''.@$select_items.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($linkelement)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_LINK').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('linkelement') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($linkelements as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkelement){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($name)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('ELEMENT_NAME').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('name') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($names as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$name){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($folderobjectid)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DEFAULT_FOLDEROBJECT').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('folderobjectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($folders as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$folderobjectid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_objectid)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_DEFAULT_OBJECT').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('default_objectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
              </option>
              <?php foreach($objects as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$default_objectid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($code)); if($if1) {  ?>
        <tr><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('EL_PROP_code').'') ?>
            </span>
          </td>
          <td><?php echo escapeHtml('') ?>
            <textarea name="<?php echo escapeHtml('code') ?>" class="<?php echo escapeHtml('inputarea') ?>"><?php echo escapeHtml(''.@$code.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <tr><?php echo escapeHtml('') ?>
        <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('act') ?>"><?php echo escapeHtml('') ?>
          
        </td>
      </tr>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>