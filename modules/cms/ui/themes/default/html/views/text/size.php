<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="size" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form text">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="text" />
      <input type="hidden" name="subaction" value="size" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('IMAGE_OLD_SIZE'))) ?>
            </span>
          </div>
          <div class="input">
            <span><?php echo encodeHtml(htmlentities(@$width)) ?>
            </span>
            <span> * 
            </span>
            <span><?php echo encodeHtml(htmlentities(@$height)) ?>
            </span>
          </div>
        </div>
        <?php $if1=!(($formats)==FALSE); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('IMAGE_NEW_SIZE'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="radio" name="type" disabled="" value="factor" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_SIZE_FACTOR'))) ?>
                    </span>
                  </label>
                  <select name="factor" size="1">
                    <?php foreach($factors as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$factor){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                  <?php  { $factor= '1'; ?>
                   <?php } ?>
                </div>
              </div>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="radio" name="type" disabled="" value="input" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_NEW_WIDTH_HEIGHT'))) ?>
                    </span>
                  </label>
                </div>
                <div class="label">
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="width" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" />
                  </div>
                  <span> * 
                  </span>
                  <div class="inputholder">
                    <input name="height" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" />
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_FORMAT'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <select name="format" size="1">
                    <?php foreach($formats as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$format){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_JPEG_COMPRESSION'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <?php  { $jpeg_compression= '70'; ?>
                   <?php } ?>
                  <select name="jpeg_compression" size="1">
                    <?php foreach($jpeglist as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$jpeg_compression){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="checkbox" name="copy" value="1" <?php if(@$copy){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>