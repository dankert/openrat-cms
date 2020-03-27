<?php if (defined('OR_TITLE')) {  ?>
  
    <?php $if1=(config('security','disable_dynamic_code')); if($if1) {  ?>
      <?php $if1=(!true); if($if1) {  ?>
        <div class="message warn">
          <span><?php echo encodeHtml(htmlentities(@lang('NOTICE_CODE_DISABLED'))) ?>
          </span>
        </div>
       <?php } ?>
     <?php } ?>
    <form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="element" />
      <input type="hidden" name="subaction" value="advanced" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <?php $if1=(isset($subtype)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_SUBTYPE'))) ?>
                  </span>
                </div>
                <div class="input">
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
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($with_icon)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="with_icon" value="1" <?php if(@$with_icon){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_WITH_ICON'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($inherit)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="inherit" value="1" <?php if(@$inherit){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_INHERIT'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($all_languages)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="all_languages" value="1" <?php if(@$all_languages){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_ALL_LANGUAGES'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($writable)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="writable" value="1" <?php if(@$writable){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_writable'))) ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($width)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('width'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="width" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($height)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('height'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="height" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($dateformat)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DATEFORMAT'))) ?>
                  </span>
                </div>
                <div class="input">
                  <select name="dateformat" size="1">
                    <?php foreach($dateformats as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$dateformat){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($format)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_FORMAT'))) ?>
                  </span>
                </div>
                <div class="input">
                  <?php foreach( $formatlist as $_key=>$_value) {  ?>
                    <label>
                      <input type="radio" name="format" value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$format){ ?>checked="checked"<?php } ?> />
                      <span><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </span>
                    </label>
                    <br />
                   <?php } ?>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($decimals)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DECIMALS'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="decimals" type="text" maxlength="2" value="<?php echo encodeHtml(htmlentities(@$decimals)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($dec_point)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEC_POINT'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="dec_point" type="text" maxlength="5" value="<?php echo encodeHtml(htmlentities(@$dec_point)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($thousand_sep)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_thousand_sep'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="thousand_sep" type="text" maxlength="1" value="<?php echo encodeHtml(htmlentities(@$thousand_sep)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($default_text)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_text'))) ?>
                  </span>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="default_text" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$default_text)) ?>" />
                  </div>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($default_longtext)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_longtext'))) ?>
                  </span>
                </div>
                <div class="input">
                  <textarea name="default_longtext" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$default_longtext)) ?>
                  </textarea>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($parameters)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DYNAMIC_PARAMETERS'))) ?>
                  </span>
                </div>
                <div class="input">
                  <textarea name="parameters" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$parameters)) ?>
                  </textarea>
                </div>
              </div>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
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
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($select_items)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_select_items'))) ?>
                  </span>
                </div>
                <div class="input">
                  <textarea name="select_items" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$select_items)) ?>
                  </textarea>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($linkelement)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_LINK'))) ?>
                  </span>
                </div>
                <div class="input">
                  <select name="linkelement" size="1">
                    <?php foreach($linkelements as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$linkelement){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($name)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
                  </span>
                </div>
                <div class="input">
                  <select name="name" size="1">
                    <?php foreach($names as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$name){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($folderobjectid)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_FOLDEROBJECT'))) ?>
                  </span>
                </div>
                <div class="input">
                  <select name="folderobjectid" size="1">
                    <?php foreach($folders as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$folderobjectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($default_objectid)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_OBJECT'))) ?>
                  </span>
                </div>
                <div class="input">
                  <select name="default_objectid" size="1">
                    <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                    </option>
                    <?php foreach($objects as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$default_objectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($code)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('EL_PROP_code'))) ?>
                  </span>
                </div>
                <div class="input">
                  <textarea name="code" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$code)) ?>
                  </textarea>
                </div>
              </div>
             <?php } ?>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>