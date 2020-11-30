<?php /* THIS FILE IS GENERATED from value.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('post') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-pageelement') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('pageelement') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('value') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('elementid') ?>" value="<?php echo O::escapeHtml(''.@$elementid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('value_time') ?>" value="<?php echo O::escapeHtml(''.@$value_time.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$desc.'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if4=($type=='date'); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
              <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@O::lang('date').'') ?></span>
              </h2>
              <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('date') ?></span>
                      <input name="<?php echo O::escapeHtml('date') ?>" type="<?php echo O::escapeHtml('date') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                    </label>
                    <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('time') ?></span>
                      <input name="<?php echo O::escapeHtml('time') ?>" type="<?php echo O::escapeHtml('time') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$time.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                    </label>
                  </div>
                </section>
              </div>
            </section>
           <?php } ?>
          <?php $if4=($type=='text'); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('text') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('or-text or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
           <?php } ?>
          <?php $if4=($type=='longtext'); if($if4) {  ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$format.'') ?>" /><?php echo O::escapeHtml('') ?>
            <?php $if5=($editor=='markdown'); if($if5) {  ?>
              <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-markdown-editor') ?>"><?php echo O::escapeHtml(''.@$text.'') ?></textarea>
             <?php } ?>
            <?php $if5=($editor=='html'); if($if5) {  ?>
              <textarea name="<?php echo O::escapeHtml('text') ?>" id="<?php echo O::escapeHtml('pageelement_edit_editor') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-html-editor') ?>"><?php echo ''.@$text.'' ?></textarea>
             <?php } ?>
            <?php $if5=($editor=='wiki'); if($if5) {  ?>
              <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-wiki-editor') ?>"><?php echo ''.@$text.'' ?></textarea>
              <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-closed or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
                <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
                  <span><?php echo O::escapeHtml(''.@O::lang('help').'') ?></span>
                </h2>
                <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                      <table width="<?php echo O::escapeHtml('100%') ?>" class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
                        <td><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','strong-begin']).'') ?></span>
                          <span><?php echo O::escapeHtml(''.@O::lang('text_markup_strong').'') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','strong-end']).'') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','emphatic-begin']).'') ?></span>
                          <span><?php echo O::escapeHtml(''.@O::lang('text_markup_emphatic').'') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','emphatic-end']).'') ?></span>
                        </td>
                        <td><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-numbered']).'') ?></span>
                          <span><?php echo O::escapeHtml(''.@O::lang('text_markup_numbered_list').'') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-numbered']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                        </td>
                        <td><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-unnumbered']).'') ?></span>
                          <span><?php echo O::escapeHtml(''.@O::lang('text_markup_unnumbered_list').'') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','list-unnumbered']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                        </td>
                        <td><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml(''.@O::lang('text_markup_table').'') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <span><?php echo O::escapeHtml('...') ?></span>
                          <span><?php echo O::escapeHtml(''.O::config(['editor','text-markup','table-cell-sep']).'') ?></span>
                          <br /><?php echo O::escapeHtml('') ?>
                        </td>
                      </table>
                    </div>
                  </div>
                </div>
              </section>
             <?php } ?>
            <?php $if5=($editor=='text'); if($if5) {  ?>
              <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('or-input or-editor raw-editor') ?>"><?php echo O::escapeHtml(''.@$text.'') ?></textarea>
             <?php } ?>
           <?php } ?>
          <?php $if4=($type=='link'); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
              <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
              <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('link_target').'') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-selector') ?>"><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('linkobjectid') ?>" value="<?php echo O::escapeHtml(''.@$linkobjectid.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-value') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('text') ?>" name="<?php echo O::escapeHtml('linkobjectid_text') ?>" placeholder="<?php echo O::escapeHtml(''.@$linkname.'') ?>" value="<?php echo O::escapeHtml(''.@$linkname.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-name') ?>" /><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-dropdown or-act-selector-search-results') ?>"><?php echo O::escapeHtml('') ?></div>
                      <div type="<?php echo O::escapeHtml('hidden') ?>" data-types="<?php echo O::escapeHtml(''.@$types.'') ?>" data-init-id="<?php echo O::escapeHtml(''.@$linkobjectid.'') ?>" data-init-folderid="<?php echo O::escapeHtml(''.@$rootfolderid.'') ?>" class="<?php echo O::escapeHtml('or-navtree or-act-load-selector-tree') ?>"><?php echo O::escapeHtml('') ?></div>
                    </div>
                  </div>
                </section>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('link_url').'') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <input name="<?php echo O::escapeHtml('linkurl') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$linkurl.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </div>
                </section>
              </div>
            </section>
           <?php } ?>
        </div>
      </section>
      <?php $if3=($type=='list'); if($if3) {  ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('linkobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </section>
       <?php } ?>
      <?php $if3=($type=='insert'); if($if3) {  ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('linkobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </section>
       <?php } ?>
      <?php $if3=($type=='number'); if($if3) {  ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('decimals') ?>" value="<?php echo O::escapeHtml('decimals') ?>" /><?php echo O::escapeHtml('') ?>
              <input name="<?php echo O::escapeHtml('number') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('20') ?>" value="<?php echo O::escapeHtml(''.@$number.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </div>
        </section>
       <?php } ?>
      <?php $if3=($type=='select'); if($if3) {  ?>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('text') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($items as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$text){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </section>
       <?php } ?>
      <?php $if3=($type=='longtext'); if($if3) {  ?>
        <?php $if4=($editor=='wiki'); if($if4) {  ?>
          <?php $if5=(isset($languages)); if($if5) {  ?>
            <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
              <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@O::lang('editor_show_language').'') ?></span>
              </h2>
              <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach((array)$languages as $languageid=>$languagename) {  ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('otherlanguageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" <?php if(@$otherlanguageid=='${languageid}'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-radio') ?>" /><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$languagename.'') ?></span>
                    </label>
                    <br /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                </div>
              </div>
            </section>
           <?php } ?>
         <?php } ?>
       <?php } ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
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
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('release') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?></span>
                  </label>
                </div>
               <?php } ?>
              <?php $if5=(isset($publish)); if($if5) {  ?>
                <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('publish') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
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