<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('value') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('post') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('value') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('languageid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$languageid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('elementid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$elementid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('value_time') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$value_time.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <span class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>
      </span>
      <?php $if1=($type=='date'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('date').'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml('date') ?>
                </span>
                <input name="<?php echo \template_engine\Output::escapeHtml('date') ?>" type="<?php echo \template_engine\Output::escapeHtml('date') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$date.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              </label>
              <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml('time') ?>
                </span>
                <input name="<?php echo \template_engine\Output::escapeHtml('time') ?>" type="<?php echo \template_engine\Output::escapeHtml('time') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$time.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              </label>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='text'); if($if1) {  ?>
        <tr><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input name="<?php echo \template_engine\Output::escapeHtml('text') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('255') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('text') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </td>
        </tr>
       <?php } ?>
      <?php $if1=($type=='longtext'); if($if1) {  ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('format') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$format.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <?php $if1=(isset($preview)); if($if1) {  ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('preview') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('page_preview').'') ?>
                <img /><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo ''.@$preview.'' ?>
                </span>
              </div>
            </fieldset>
          </div>
         <?php } ?>
        <?php $if1=($editor=='markdown'); if($if1) {  ?>
          <textarea name="<?php echo \template_engine\Output::escapeHtml('text') ?>" class="<?php echo \template_engine\Output::escapeHtml('editor markdown-editor') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>
          </textarea>
         <?php } ?>
        <?php $if1=($editor=='html'); if($if1) {  ?>
          <textarea name="<?php echo \template_engine\Output::escapeHtml('text') ?>" id="<?php echo \template_engine\Output::escapeHtml('pageelement_edit_editor') ?>" class="<?php echo \template_engine\Output::escapeHtml('editor html-editor') ?>"><?php echo ''.@$text.'' ?>
          </textarea>
         <?php } ?>
        <?php $if1=($editor=='wiki'); if($if1) {  ?>
          <?php $if1=(isset($languagetext)); if($if1) {  ?>
            <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
                <img /><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$languagetext.'') ?>
                </span>
              </div>
            </fieldset>
            <br /><?php echo \template_engine\Output::escapeHtml('') ?>
            <br /><?php echo \template_engine\Output::escapeHtml('') ?>
           <?php } ?>
          <textarea name="<?php echo \template_engine\Output::escapeHtml('text') ?>" class="<?php echo \template_engine\Output::escapeHtml('editor wiki-editor') ?>"><?php echo ''.@$text.'' ?>
          </textarea>
          <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('help').'') ?>
              <img /><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','strong-begin').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('text_markup_strong').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','strong-end').'') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','emphatic-begin').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('text_markup_emphatic').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','emphatic-end').'') ?>
                      </span>
                    </td>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','list-numbered').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('text_markup_numbered_list').'') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','list-numbered').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                    </td>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','list-unnumbered').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('text_markup_unnumbered_list').'') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','list-unnumbered').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                    </td>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('text_markup_table').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml('...') ?>
                      </span>
                      <span><?php echo \template_engine\Output::escapeHtml(''.\template_engine\Output::config('editor','text-markup','table-cell-sep').'') ?>
                      </span>
                      <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                    </td>
                  </table>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($editor=='text'); if($if1) {  ?>
          <textarea name="<?php echo \template_engine\Output::escapeHtml('text') ?>" class="<?php echo \template_engine\Output::escapeHtml('editor raw-editor') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>
          </textarea>
         <?php } ?>
       <?php } ?>
      <?php $if1=($type=='link'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('link_target').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('link_url').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('linkurl') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$linkurl.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='list'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <select name="<?php echo \template_engine\Output::escapeHtml('linkobjectid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='insert'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <select name="<?php echo \template_engine\Output::escapeHtml('linkobjectid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach($objects as $_key=>$_value) {  ?>
                  <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='number'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('decimals') ?>" value="<?php echo \template_engine\Output::escapeHtml('decimals') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input name="<?php echo \template_engine\Output::escapeHtml('number') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('20') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$number.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php $if1=($type=='select'); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <select name="<?php echo \template_engine\Output::escapeHtml('text') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach($items as $_key=>$_value) {  ?>
                  <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$text){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
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
            <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('editor_show_language').'') ?>
                <img /><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach((array)$languages as $languageid=>$languagename) {  ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('otherlanguageid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$languageid.'') ?>" <?php if(@$otherlanguageid=='${languageid}'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
                      </span>
                    </label>
                    <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                   <?php } ?>
                </div>
              </div>
            </fieldset>
           <?php } ?>
          <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PAGE_PREVIEW').'') ?>
              <img /><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('preview') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$preview){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PAGE_PREVIEW').'') ?>
                  </span>
                </label>
              </div>
            </div>
          </fieldset>
         <?php } ?>
       <?php } ?>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('options').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <?php $if1=(isset($release)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('release') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('RELEASE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
          <?php $if1=(isset($publish)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('publish') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('APPLY').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--apply') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('save').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>