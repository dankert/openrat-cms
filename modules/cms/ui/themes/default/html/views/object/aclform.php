<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('aclform') ?>" data-action="<?php echo escapeHtml('object') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form object') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('object') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('aclform') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('users').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('all') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_ALL').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('user') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_USER').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('userid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
                  </option>
                  <?php foreach($users as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <?php $if1=(isset($groups)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('group') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('GLOBAL_GROUP').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <select name="<?php echo escapeHtml('groupid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                    <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
                    </option>
                    <?php foreach($groups as $_key=>$_value) {  ?>
                      <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
             <?php } ?>
          </div>
        </fieldset>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('language').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_LANGUAGE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('languageid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($languages as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('acl').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <?php foreach((array)$show as $k=>$t) {  ?>
                  <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                    <?php $if1=($t=='read'); if($if1) {  ?>
                      <?php  { $$t= 1; ?>
                       <?php } ?>
                      <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$t.'') ?>" disabled="<?php echo escapeHtml('disabled') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$t){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <?php  { unset($$t) ?>
                       <?php } ?>
                      <label class="<?php echo escapeHtml('or-form-row or-form-checkbox') ?>"><?php echo escapeHtml('') ?>
                        <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml(''.@lang('acl_'.@$t.'').'') ?>
                        </span>
                        <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$t.'') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$t){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                      </label>
                     <?php } ?>
                  </div>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>