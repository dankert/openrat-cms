<?php if (defined('OR_TITLE')) {  ?>
  
    
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
              </span>
            </td>
          </tr>
          <?php foreach($elements as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="element" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/element/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                  <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$type)) ?>">
                  </i>
                  <span title="<?php echo encodeHtml(htmlentities(@$description)) ?>"><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@lang(''.@$type.''))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=(($elements)==FALSE); if($if1) {  ?>
            <tr>
              <td colspan="2">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <tr class="data">
            <td colspan="2" class="clickable">
              <a target="_self" data-type="dialog" data-action="template" data-method="addel" data-id="<?php echo encodeHtml(htmlentities(@$templateid)) ?>" data-extra="{'dialogAction':'template','dialogMethod':'addel'}" href="/#/template/<?php echo encodeHtml(htmlentities(@$templateid)) ?>">
                <i class="image-icon image-icon--method-add">
                </i>
                <span><?php echo encodeHtml(htmlentities(@lang('menu_template_addel'))) ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <?php foreach($models as $list_key=>$list_value) { extract($list_value); ?>
      <fieldset class="or-group toggle-open-close open show">
        <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@$name)) ?>
          <img />
          <div class="arrow arrow-right on-closed">
          </div>
          <div class="arrow arrow-down on-open">
          </div>
        </legend>
        <div class="closable">
          <div class="clickable">
            <code><?php echo encodeHtml(htmlentities(@$source)) ?>
            </code>
            <br />
            <a target="_self" data-type="edit" data-action="" data-method="src" data-id="" data-extra="{'modelid':'<?php echo encodeHtml(htmlentities(@$modelid)) ?>'}" href="/#//" class="or-form-button">
              <i class="image-icon image-icon--action-template">
              </i>
              <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
              </span>
            </a>
          </div>
        </div>
      </fieldset>
     <?php } ?>
 <?php } ?>