<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="properties" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="element" />
        <input type="hidden" name="subaction" value="properties" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <?php $if1=(isset($subtype)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_SUBTYPE'))) ?>
                  </span>
                </td>
                <td>
                  <?php $if1=(isset($subtypes)); if($if1) {  ?>
                    <select name="subtype" size="1">
                      <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                      </option>
                      <?php foreach($subtypes as $_key=>$_value) {  ?>
                        <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$subtype){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                        </option>
                       <?php } ?>
                    </select>
                   <?php } ?>
                  <?php $if1=!(isset($subtypes)); if($if1) {  ?>
                    <div class="inputholder">
                      <input name="subtype" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$subtype)) ?>" />
                    </div>
                   <?php } ?>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($with_icon)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_WITH_ICON'))) ?>
                  </span>
                </td>
                <td>
                  <input type="checkbox" name="with_icon" value="1" <?php if(@$with_icon){ ?>checked="1"<?php } ?> />
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($all_languages)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_ALL_LANGUAGES'))) ?>
                  </span>
                </td>
                <td>
                  <input type="checkbox" name="all_languages" value="1" <?php if(@$all_languages){ ?>checked="1"<?php } ?> />
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($writable)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_writable'))) ?>
                  </span>
                </td>
                <td>
                  <input type="checkbox" name="writable" value="1" <?php if(@$writable){ ?>checked="1"<?php } ?> />
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($width)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('width'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="width" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($height)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('height'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="height" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($dateformat)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DATEFORMAT'))) ?>
                  </span>
                </td>
                <td>
                  <select name="dateformat" size="1">
                    <?php foreach($dateformats as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$dateformat){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($format)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_FORMAT'))) ?>
                  </span>
                </td>
                <td>
                  <?php foreach( $formatlist as $_key=>$_value) {  ?>
                    <label>
                      <input type="radio" name="format" value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$format){ ?>checked="checked"<?php } ?> />
                      <span><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </span>
                    </label>
                    <br />
                   <?php } ?>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($decimals)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DECIMALS'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="decimals" type="text" maxlength="2" value="<?php echo encodeHtml(htmlentities(@$decimals)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($dec_point)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEC_POINT'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="dec_point" type="text" maxlength="5" value="<?php echo encodeHtml(htmlentities(@$dec_point)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($thousand_sep)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_thousand_sep'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="thousand_sep" type="text" maxlength="1" value="<?php echo encodeHtml(htmlentities(@$thousand_sep)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($default_text)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_text'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="default_text" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$default_text)) ?>" />
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($default_longtext)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_longtext'))) ?>
                  </span>
                </td>
                <td>
                  <textarea name="default_longtext" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$default_longtext)) ?>
                  </textarea>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($parameters)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DYNAMIC_PARAMETERS'))) ?>
                  </span>
                </td>
                <td>
                  <textarea name="parameters" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$parameters)) ?>
                  </textarea>
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td>
                  <?php foreach($dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
                    <span><?php echo encodeHtml(htmlentities(@$paramName)) ?>
                    </span>
                    <span> (
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DEFAULT'))) ?>
                    </span>
                    <span>) = 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@$defaultValue)) ?>
                    </span>
                    <br />
                   <?php } ?>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($select_items)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_select_items'))) ?>
                  </span>
                </td>
                <td>
                  <textarea name="select_items" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$select_items)) ?>
                  </textarea>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($linkelement)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_LINK'))) ?>
                  </span>
                </td>
                <td>
                  <select name="linkelement" size="1">
                    <?php foreach($linkelements as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$linkelement){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($name)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
                  </span>
                </td>
                <td>
                  <select name="name" size="1">
                    <?php foreach($names as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$name){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($folderobjectid)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_FOLDEROBJECT'))) ?>
                  </span>
                </td>
                <td>
                  <select name="folderobjectid" size="1">
                    <?php foreach($folders as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$folderobjectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($default_objectid)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_OBJECT'))) ?>
                  </span>
                </td>
                <td>
                  <select name="default_objectid" size="1">
                    <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                    </option>
                    <?php foreach($objects as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$default_objectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($code)); if($if1) {  ?>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_code'))) ?>
                  </span>
                </td>
                <td>
                  <textarea name="code" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$code)) ?>
                  </textarea>
                </td>
              </tr>
             <?php } ?>
            <tr>
              <td colspan="2" class="act">
                
              </td>
            </tr>
        </div>
        <div class="or-form-actionbar">
          <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
          <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
        </div>
      </form>
      
 <?php } ?>