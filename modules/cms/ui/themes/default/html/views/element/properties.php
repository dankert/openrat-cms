<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('properties') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-element') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('element') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('properties') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php $if1=(isset($subtype)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('ELEMENT_SUBTYPE').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <?php $if1=(isset($subtypes)); if($if1) {  ?>
              <select name="<?php echo O::escapeHtml('subtype') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?>
                </option>
                <?php foreach($subtypes as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$subtype){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
             <?php } ?>
            <?php $if1=!(isset($subtypes)); if($if1) {  ?>
              <input name="<?php echo O::escapeHtml('subtype') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$subtype.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($with_icon)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_WITH_ICON').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('with_icon') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$with_icon){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($all_languages)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_ALL_LANGUAGES').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('all_languages') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$all_languages){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($writable)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_writable').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('writable') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$writable){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($width)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('width').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('width') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$width.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($height)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('height').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('height') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$height.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($dateformat)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DATEFORMAT').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('dateformat') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($dateformats as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dateformat){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($format)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_FORMAT').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <?php foreach( $formatlist as $_key=>$_value) {  ?>
              <label><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$_value.'') ?>
                </span>
              </label>
              <br /><?php echo O::escapeHtml('') ?>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($decimals)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DECIMALS').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('decimals') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('2') ?>" value="<?php echo O::escapeHtml(''.@$decimals.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($dec_point)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEC_POINT').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('dec_point') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('5') ?>" value="<?php echo O::escapeHtml(''.@$dec_point.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($thousand_sep)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_thousand_sep').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('thousand_sep') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('1') ?>" value="<?php echo O::escapeHtml(''.@$thousand_sep.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_text)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_default_text').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('default_text') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$default_text.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_longtext)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_default_longtext').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <textarea name="<?php echo O::escapeHtml('default_longtext') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$default_longtext.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($parameters)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DYNAMIC_PARAMETERS').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <textarea name="<?php echo O::escapeHtml('parameters') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$parameters.'') ?>
            </textarea>
          </td>
        </tr>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <?php foreach((array)$dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
              <span><?php echo O::escapeHtml(''.@$paramName.'') ?>
              </span>
              <span><?php echo O::escapeHtml(' (') ?>
              </span>
              <span><?php echo O::escapeHtml(''.@O::lang('DEFAULT').'') ?>
              </span>
              <span><?php echo O::escapeHtml(') = ') ?>
              </span>
              <span><?php echo O::escapeHtml(''.@$defaultValue.'') ?>
              </span>
              <br /><?php echo O::escapeHtml('') ?>
             <?php } ?>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($select_items)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_select_items').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <textarea name="<?php echo O::escapeHtml('select_items') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$select_items.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($linkelement)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_LINK').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('linkelement') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($linkelements as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkelement){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($name)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('ELEMENT_NAME').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('name') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($names as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$name){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($folderobjectid)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEFAULT_FOLDEROBJECT').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('folderobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach($folders as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$folderobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($default_objectid)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_DEFAULT_OBJECT').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <select name="<?php echo O::escapeHtml('default_objectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
              <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?>
              </option>
              <?php foreach($objects as $_key=>$_value) {  ?>
                <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$default_objectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=(isset($code)); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('EL_PROP_code').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <textarea name="<?php echo O::escapeHtml('code') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$code.'') ?>
            </textarea>
          </td>
        </tr>
       <?php } ?>
      <tr><?php echo O::escapeHtml('') ?>
        <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-act') ?>"><?php echo O::escapeHtml('') ?>
          
        </td>
      </tr>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
        </span>
      </div>
    </div>
  </form>