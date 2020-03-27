<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="value" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="pageelement" />
      <input type="hidden" name="subaction" value="value" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" />
        <input type="hidden" name="elementid" value="<?php echo encodeHtml(htmlentities(@$elementid)) ?>" />
        <input type="hidden" name="value_time" value="<?php echo encodeHtml(htmlentities(@$value_time)) ?>" />
        <span class="help"><?php echo encodeHtml(htmlentities(@$desc)) ?>
        </span>
        <?php $if1=($type=='date'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('date'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <label class="or-form-row or-form-input">
                  <span class="or-form-label">date
                  </span>
                  <input name="date" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$date)) ?>" />
                </label>
                <label class="or-form-row or-form-input">
                  <span class="or-form-label">time
                  </span>
                  <input name="time" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$time)) ?>" />
                </label>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='text'); if($if1) {  ?>
          <tr>
            <td colspan="2">
              <div class="inputholder">
                <input name="text" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" class="text" />
              </div>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=($type=='longtext'); if($if1) {  ?>
          <input type="hidden" name="format" value="<?php echo encodeHtml(htmlentities(@$format)) ?>" />
          <?php $if1=(isset($preview)); if($if1) {  ?>
            <div class="preview">
              <fieldset class="or-group toggle-open-close open show">
                <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('page_preview'))) ?>
                  <img />
                  <div class="arrow arrow-right on-closed">
                  </div>
                  <div class="arrow arrow-down on-open">
                  </div>
                </legend>
                <div class="closable">
                  <span><?php echo @$preview ?>
                  </span>
                </div>
              </fieldset>
            </div>
           <?php } ?>
          <?php $if1=($editor=='markdown'); if($if1) {  ?>
            <textarea name="text" class="editor markdown-editor"><?php echo encodeHtml(htmlentities(@$text)) ?>
            </textarea>
           <?php } ?>
          <?php $if1=($editor=='html'); if($if1) {  ?>
            <textarea name="text" id="pageelement_edit_editor" class="editor html-editor"><?php echo @$text ?>
            </textarea>
           <?php } ?>
          <?php $if1=($editor=='wiki'); if($if1) {  ?>
            <?php $if1=(isset($languagetext)); if($if1) {  ?>
              <fieldset class="or-group toggle-open-close open show">
                <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@$languagename)) ?>
                  <img />
                  <div class="arrow arrow-right on-closed">
                  </div>
                  <div class="arrow arrow-down on-open">
                  </div>
                </legend>
                <div class="closable">
                  <span><?php echo encodeHtml(htmlentities(@$languagetext)) ?>
                  </span>
                </div>
              </fieldset>
              <br />
              <br />
             <?php } ?>
            <textarea name="text" class="editor wiki-editor"><?php echo @$text ?>
            </textarea>
            <fieldset class="or-group toggle-open-close closed show">
              <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('help'))) ?>
                <img />
                <div class="arrow arrow-right on-closed">
                </div>
                <div class="arrow arrow-down on-open">
                </div>
              </legend>
              <div class="closable">
                <div class="or-table-wrapper">
                  <div class="or-table-filter">
                    <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
                  </div>
                  <div class="or-table-area">
                    <table width="100%">
                      <td>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','strong-begin'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(@lang('text_markup_strong'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','strong-end'))) ?>
                        </span>
                        <br />
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','emphatic-begin'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(@lang('text_markup_emphatic'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','emphatic-end'))) ?>
                        </span>
                      </td>
                      <td>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-numbered'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(@lang('text_markup_numbered_list'))) ?>
                        </span>
                        <br />
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-numbered'))) ?>
                        </span>
                        <span>...
                        </span>
                        <br />
                      </td>
                      <td>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(@lang('text_markup_unnumbered_list'))) ?>
                        </span>
                        <br />
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered'))) ?>
                        </span>
                        <span>...
                        </span>
                        <br />
                      </td>
                      <td>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(@lang('text_markup_table'))) ?>
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span>...
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span>...
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <br />
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span>...
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span>...
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <span>...
                        </span>
                        <span><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
                        </span>
                        <br />
                      </td>
                    </table>
                  </div>
                </div>
              </div>
            </fieldset>
           <?php } ?>
          <?php $if1=($editor=='text'); if($if1) {  ?>
            <textarea name="text" maxlength="0" class="editor raw-editor"><?php echo encodeHtml(htmlentities(@$text)) ?>
            </textarea>
            
           <?php } ?>
         <?php } ?>
        <?php $if1=($type=='link'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('link_target'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  
                </div>
              </div>
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('link_url'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="linkurl" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$linkurl)) ?>" />
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='list'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
              <div class="">
                <select name="linkobjectid" size="1">
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$linkobjectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
                
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='insert'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
              <div class="">
                <select name="linkobjectid" size="1">
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$linkobjectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
                
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='number'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
              <div class="">
                <input type="hidden" name="decimals" value="decimals" />
                <div class="inputholder">
                  <input name="number" type="text" maxlength="20" value="<?php echo encodeHtml(htmlentities(@$number)) ?>" />
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php $if1=($type=='select'); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <div class="closable">
              <div class="">
                <select name="text" size="1">
                  <?php foreach($items as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$text){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
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
              <fieldset class="or-group toggle-open-close open show">
                <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('editor_show_language'))) ?>
                  <img />
                  <div class="arrow arrow-right on-closed">
                  </div>
                  <div class="arrow arrow-down on-open">
                  </div>
                </legend>
                <div class="closable">
                  <div class="">
                    <?php foreach($languages as $languageid=>$languagename) {  ?>
                      <input type="radio" name="otherlanguageid" disabled="" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" checked="<?php echo encodeHtml(htmlentities(@$otherlanguageid)) ?>" />
                      <label class="label">
                        <span><?php echo encodeHtml(htmlentities(@$languagename)) ?>
                        </span>
                      </label>
                      <br />
                     <?php } ?>
                  </div>
                </div>
              </fieldset>
             <?php } ?>
            <fieldset class="or-group toggle-open-close open show">
              <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('PAGE_PREVIEW'))) ?>
                <img />
                <div class="arrow arrow-right on-closed">
                </div>
                <div class="arrow arrow-down on-open">
                </div>
              </legend>
              <div class="closable">
                <div class="">
                  <input type="checkbox" name="preview" value="1" <?php if(@$preview){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('PAGE_PREVIEW'))) ?>
                    </span>
                  </label>
                </div>
              </div>
            </fieldset>
           <?php } ?>
         <?php } ?>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <?php $if1=(isset($release)); if($if1) {  ?>
              <div class="">
                <input type="checkbox" name="release" value="1" <?php if(@$release){ ?>checked="1"<?php } ?> />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
                  </span>
                </label>
              </div>
             <?php } ?>
            <?php $if1=(isset($publish)); if($if1) {  ?>
              <div class="">
                <input type="checkbox" name="publish" value="1" <?php if(@$publish){ ?>checked="1"<?php } ?> />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
                  </span>
                </label>
              </div>
             <?php } ?>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('APPLY'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--apply" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('save'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>