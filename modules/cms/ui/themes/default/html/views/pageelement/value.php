<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('value') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('post') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form pageelement') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('pageelement') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('value') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('languageid') ?>" value="<?php echo escapeHtml(''.@$languageid.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('elementid') ?>" value="<?php echo escapeHtml(''.@$elementid.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('value_time') ?>" value="<?php echo escapeHtml(''.@$value_time.'') ?>" /><?php echo escapeHtml('') ?>
        <span class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml(''.@$desc.'') ?>
        </span>
        <?php $if1=($type=='date'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('date').'') ?>
              <img /><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
                  <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('date') ?>
                  </span>
                  <input name="<?php echo escapeHtml('date') ?>" type="<?php echo escapeHtml('date') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$date.'') ?>" /><?php echo escapeHtml('') ?>
                </label>
                <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
                  <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('time') ?>
                  </span>
                  <input name="<?php echo escapeHtml('time') ?>" type="<?php echo escapeHtml('time') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$time.'') ?>" /><?php echo escapeHtml('') ?>
                </label>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='text'); if($if1) {  ?>
          <tr><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('text') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$text.'') ?>" class="<?php echo escapeHtml('text') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=($type=='longtext'); if($if1) {  ?>
          <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('format') ?>" value="<?php echo escapeHtml(''.@$format.'') ?>" /><?php echo escapeHtml('') ?>
          <?php $if1=(isset($preview)); if($if1) {  ?>
            <div class="<?php echo escapeHtml('preview') ?>"><?php echo escapeHtml('') ?>
              <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('page_preview').'') ?>
                  <img /><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                  </div>
                  <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                  </div>
                </legend>
                <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo ''.@$preview.'' ?>
                  </span>
                </div>
              </fieldset>
            </div>
           <?php } ?>
          <?php $if1=($editor=='markdown'); if($if1) {  ?>
            <textarea name="<?php echo escapeHtml('text') ?>" class="<?php echo escapeHtml('editor markdown-editor') ?>"><?php echo escapeHtml(''.@$text.'') ?>
            </textarea>
           <?php } ?>
          <?php $if1=($editor=='html'); if($if1) {  ?>
            <textarea name="<?php echo escapeHtml('text') ?>" id="<?php echo escapeHtml('pageelement_edit_editor') ?>" class="<?php echo escapeHtml('editor html-editor') ?>"><?php echo ''.@$text.'' ?>
            </textarea>
           <?php } ?>
          <?php $if1=($editor=='wiki'); if($if1) {  ?>
            <?php $if1=(isset($languagetext)); if($if1) {  ?>
              <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@$languagename.'') ?>
                  <img /><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                  </div>
                  <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                  </div>
                </legend>
                <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$languagetext.'') ?>
                  </span>
                </div>
              </fieldset>
              <br /><?php echo escapeHtml('') ?>
              <br /><?php echo escapeHtml('') ?>
             <?php } ?>
            <textarea name="<?php echo escapeHtml('text') ?>" class="<?php echo escapeHtml('editor wiki-editor') ?>"><?php echo ''.@$text.'' ?>
            </textarea>
            <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo escapeHtml('') ?>
              <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('help').'') ?>
                <img /><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                  <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                    <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                      <td><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','strong-begin').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.@lang('text_markup_strong').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','strong-end').'') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','emphatic-begin').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.@lang('text_markup_emphatic').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','emphatic-end').'') ?>
                        </span>
                      </td>
                      <td><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','list-numbered').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.@lang('text_markup_numbered_list').'') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','list-numbered').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                      </td>
                      <td><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','list-unnumbered').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.@lang('text_markup_unnumbered_list').'') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','list-unnumbered').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                      </td>
                      <td><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.@lang('text_markup_table').'') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <span><?php echo escapeHtml('...') ?>
                        </span>
                        <span><?php echo escapeHtml(''.config('editor','text-markup','table-cell-sep').'') ?>
                        </span>
                        <br /><?php echo escapeHtml('') ?>
                      </td>
                    </table>
                  </div>
                </div>
              </div>
            </fieldset>
           <?php } ?>
          <?php $if1=($editor=='text'); if($if1) {  ?>
            <textarea name="<?php echo escapeHtml('text') ?>" class="<?php echo escapeHtml('editor raw-editor') ?>"><?php echo escapeHtml(''.@$text.'') ?>
            </textarea>
            
           <?php } ?>
         <?php } ?>
        <?php $if1=($type=='link'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('link_target').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <?php echo escapeHtml('') ?>
                </div>
              </div>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('link_url').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                    <input name="<?php echo escapeHtml('linkurl') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$linkurl.'') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='list'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('linkobjectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
                
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='insert'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('linkobjectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
                
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='number'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('decimals') ?>" value="<?php echo escapeHtml('decimals') ?>" /><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('number') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('20') ?>" value="<?php echo escapeHtml(''.@$number.'') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='select'); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('text') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($items as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$text){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
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
              <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('editor_show_language').'') ?>
                  <img /><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                  </div>
                  <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                  </div>
                </legend>
                <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                    <?php foreach((array)$languages as $languageid=>$languagename) {  ?>
                      <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('otherlanguageid') ?>" value="<?php echo escapeHtml(''.@$languageid.'') ?>" checked="<?php echo escapeHtml(''.@$otherlanguageid.'') ?>" /><?php echo escapeHtml('') ?>
                      <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@$languagename.'') ?>
                        </span>
                      </label>
                      <br /><?php echo escapeHtml('') ?>
                     <?php } ?>
                  </div>
                </div>
              </fieldset>
             <?php } ?>
            <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
              <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('PAGE_PREVIEW').'') ?>
                <img /><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('preview') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$preview){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('PAGE_PREVIEW').'') ?>
                    </span>
                  </label>
                </div>
              </div>
            </fieldset>
           <?php } ?>
         <?php } ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <?php $if1=(isset($release)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('release') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_RELEASE').'') ?>
                  </span>
                </label>
              </div>
             <?php } ?>
            <?php $if1=(isset($publish)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('publish') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                  </span>
                </label>
              </div>
             <?php } ?>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('APPLY').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--apply') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('save').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>