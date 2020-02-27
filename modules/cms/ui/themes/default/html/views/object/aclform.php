<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="aclform" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="aclform" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('users'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <input type="radio" name="type" disabled="" value="all" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ALL'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
              </div>
            </div>
            <div class="line">
              <div class="label">
                <input type="radio" name="type" disabled="" value="user" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <select name="userid" size="1">
                  <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                  </option>
                  <?php foreach($users as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$userid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <?php $if1=(isset($groups)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <input type="radio" name="type" disabled="" value="group" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_GROUP'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <select name="groupid" size="1">
                    <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                    </option>
                    <?php foreach($groups as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$groupid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('language'))) ?>
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
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LANGUAGE'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <select name="languageid" size="1">
                  <?php foreach($languages as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$languageid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('acl'))) ?>
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
                <?php foreach($show as $k=>$t) {  ?>
                  <div class="">
                    <?php $if1=($t=='read'); if($if1) {  ?>
                      <?php  { $$t= true; ?>
                       <?php } ?>
                      <input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$t)) ?>" disabled="disabled" value="1" <?php if(@$${t}){ ?>checked="1"<?php } ?> />
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <?php  { unset($$t) ?>
                       <?php } ?>
                      <input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$t)) ?>" value="1" <?php if(@$${t}){ ?>checked="1"<?php } ?> />
                     <?php } ?>
                    <label class="label">
                      <span><?php echo encodeHtml(htmlentities(@lang(''.@$t.''))) ?>
                      </span>
                    </label>
                  </div>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>