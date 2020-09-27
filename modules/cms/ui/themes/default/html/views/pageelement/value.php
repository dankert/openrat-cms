<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('post') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form pageelement') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('pageelement') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('value') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('elementid') ?>" value="<?php echo O::escapeHtml(''.@$elementid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('value_time') ?>" value="<?php echo O::escapeHtml(''.@$value_time.'') ?>" /><?php echo O::escapeHtml('') ?>
      <span class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml(''.@$desc.'') ?>
      </span>
      <?php $if1=($type=='date'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('date').'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('date') ?>
                </span>
                <input name="<?php echo O::escapeHtml('date') ?>" type="<?php echo O::escapeHtml('date') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$date.'') ?>" /><?php echo O::escapeHtml('') ?>
              </label>
              <label class="<?php echo O::escapeHtml('or-form-row or-form-input') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml('time') ?>
                </span>
                <input name="<?php echo O::escapeHtml('time') ?>" type="<?php echo O::escapeHtml('time') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$time.'') ?>" /><?php echo O::escapeHtml('') ?>
              </label>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='text'); if($if1) {  ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('inputholder') ?>"><?php echo O::escapeHtml('') ?>
              <input name="<?php echo O::escapeHtml('text') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('text') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=($type=='longtext'); if($if1) {  ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('format') ?>" value="<?php echo O::escapeHtml(''.@$format.'') ?>" /><?php echo O::escapeHtml('') ?>
        <?php $if1=(isset($preview)); if($if1) {  ?>
          <div class="<?php echo O::escapeHtml('preview') ?>"><?php echo O::escapeHtml('') ?>
            <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
              <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('page_preview').'') ?>
                <img /><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo ''.@$preview.'' ?>
                </span>
              </div>
            </fieldset>
          </div>
         <?php } ?>
        <?php $if1=($editor=='markdown'); if($if1) {  ?>
          <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('editor markdown-editor') ?>"><?php echo O::escapeHtml(''.@$text.'') ?>
          </textarea>
         <?php } ?>
        <?php $if1=($editor=='html'); if($if1) {  ?>
          <textarea name="<?php echo O::escapeHtml('text') ?>" id="<?php echo O::escapeHtml('pageelement_edit_editor') ?>" class="<?php echo O::escapeHtml('editor html-editor') ?>"><?php echo ''.@$text.'' ?>
          </textarea>
         <?php } ?>
        <?php $if1=($editor=='wiki'); if($if1) {  ?>
          <?php $if1=(isset($languagetext)); if($if1) {  ?>
            <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
              <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@$languagename.'') ?>
                <img /><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$languagetext.'') ?>
                </span>
              </div>
            </fieldset>
            <br /><?php echo O::escapeHtml('') ?>
            <br /><?php echo O::escapeHtml('') ?>
           <?php } ?>
          <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('editor wiki-editor') ?>"><?php echo ''.@$text.'' ?>
          </textarea>
          <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo O::escapeHtml('') ?>
            <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('help').'') ?>
              <img /><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                  <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                    <td><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','strong-begin').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.@O::lang('text_markup_strong').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','strong-end').'') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','emphatic-begin').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.@O::lang('text_markup_emphatic').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','emphatic-end').'') ?>
                      </span>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','list-numbered').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.@O::lang('text_markup_numbered_list').'') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','list-numbered').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','list-unnumbered').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.@O::lang('text_markup_unnumbered_list').'') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','list-unnumbered').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.@O::lang('text_markup_table').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo O::escapeHtml('...') ?>
                      </span>
                      <span><?php echo O::escapeHtml(''.O::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <br /><?php echo O::escapeHtml('') ?>
                    </td>
                  </table>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($editor=='text'); if($if1) {  ?>
          <textarea name="<?php echo O::escapeHtml('text') ?>" class="<?php echo O::escapeHtml('editor raw-editor') ?>"><?php echo O::escapeHtml(''.@$text.'') ?>
          </textarea>
         <?php } ?>
       <?php } ?>
      <?php $if1=($type=='link'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('link_target').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <?php echo O::escapeHtml('') ?>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('link_url').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('inputholder') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('linkurl') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$linkurl.'') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='list'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('linkobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='insert'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('linkobjectid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='number'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('decimals') ?>" value="<?php echo O::escapeHtml('decimals') ?>" /><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('inputholder') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('number') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('20') ?>" value="<?php echo O::escapeHtml(''.@$number.'') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='select'); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('text') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($items as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$text){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='longtext'); if($if1) {  ?>
        <?php $if1=($editor=='wiki'); if($if1) {  ?>
          <?php $if1=(isset($languages)); if($if1) {  ?>
            <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
              <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('editor_show_language').'') ?>
                <img /><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach((array)$languages as $languageid=>$languagename) {  ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('otherlanguageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" <?php if(@$otherlanguageid=='${languageid}'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$languagename.'') ?>
                      </span>
                    </label>
                    <br /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                </div>
              </div>
            </fieldset>
           <?php } ?>
          <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
            <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('PAGE_PREVIEW').'') ?>
              <img /><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('preview') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$preview){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('PAGE_PREVIEW').'') ?>
                  </span>
                </label>
              </div>
            </div>
          </fieldset>
         <?php } ?>
       <?php } ?>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if1=(isset($release)); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('release') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
          <?php $if1=(isset($publish)); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('publish') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('APPLY').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--apply') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('save').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>