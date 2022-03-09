<?php /* THIS FILE IS GENERATED from all.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('all') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('post') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-page') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('page') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('all') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('value_time') ?>" value="<?php echo O::escapeHtml(''.@$value_time.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php foreach((array)@$elements as $list_key=>$list_value) { extract($list_value); ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('elementid') ?>" value="<?php echo O::escapeHtml(''.@$elementid.'') ?>" /><?php echo O::escapeHtml('') ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$label.'') ?></span>
          </h2>
          <p class="<?php echo O::escapeHtml('or-group-description') ?>"><?php echo O::escapeHtml(''.@$desc.'') ?></p>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <?php $if5=($type=='date'); if($if5) {  ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('date') ?></span>
                    <input name="<?php echo O::escapeHtml(''.@$name.'_date') ?>" type="<?php echo O::escapeHtml('date') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </label>
                  <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('time') ?></span>
                    <input name="<?php echo O::escapeHtml(''.@$name.'_time') ?>" type="<?php echo O::escapeHtml('time') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </label>
                </div>
              </section>
             <?php } ?>
            <?php $if5=($type=='text'); if($if5) {  ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </section>
             <?php } ?>
            <?php $if5=($type=='longtext'); if($if5) {  ?>
              <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$format.'') ?>" /><?php echo O::escapeHtml('') ?>
              <?php $if6=($editor=='markdown'); if($if6) {  ?>
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
              <?php $if6=($editor=='html'); if($if6) {  ?>
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
              <?php $if6=($editor=='wiki'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div><?php echo O::escapeHtml('') ?>
                      <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-wiki-editor') ?>"><?php echo ''.@$value.'' ?></textarea>
                      <trix-editor input="<?php echo O::escapeHtml(''.@$name.'') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
                    </div>
                  </div>
                </section>
               <?php } ?>
              <?php $if6=($editor=='text'); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <textarea name="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-editor raw-editor') ?>"><?php echo O::escapeHtml(''.@$value.'') ?></textarea>
                  </div>
                </section>
               <?php } ?>
             <?php } ?>
            <?php $if5=($type=='link'); if($if5) {  ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('link_target').'') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-selector or-droppable-selector') ?>"><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('linkobjectid') ?>" value="<?php echo O::escapeHtml(''.@$linkobjectid.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-value') ?>" /><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('text') ?>" name="<?php echo O::escapeHtml('linkobjectid_text') ?>" placeholder="<?php echo O::escapeHtml(''.@$name.'') ?>" value="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input or-selector-link-name or-act-selector-search') ?>" /><?php echo O::escapeHtml('') ?>
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
          </div>
        </section>
        <?php $if4=($type=='insert'); if($if4) {  ?>
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
        <?php $if4=($type=='number'); if($if4) {  ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('decimals') ?>" value="<?php echo O::escapeHtml('decimals') ?>" /><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml(''.@$name.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('20') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </div>
          </section>
         <?php } ?>
        <?php $if4=($type=='select'); if($if4) {  ?>
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
       <?php } ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php $if5=(isset($release)); if($if5) {  ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('release') ?>" <?php if(@$release){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?></span>
                  </label>
                </div>
               <?php } ?>
              <?php $if5=(isset($publish)); if($if5) {  ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
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