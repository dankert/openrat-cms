<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('TYPE'))) ?>
              </span>
            </th>
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
              </span>
            </th>
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('LASTCHANGE'))) ?>
              </span>
            </th>
          </tr>
          <?php $if1=(isset($up_url)); if($if1) {  ?>
            <tr class="data clickable">
              <td>
                <a target="_self" data-type="open" data-action="folder" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$parentid)) ?>" data-extra="[]" href="/#/folder/<?php echo encodeHtml(htmlentities(@$parentid)) ?>">
                  <i class="image-icon image-icon--action-folder">
                  </i>
                  <span>..
                  </span>
                </a>
              </td>
              <td>
                <span>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data clickable">
              <td>
                <i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$icon)) ?>">
                </i>
              </td>
              <td>
                <a title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                  <span> 
                  </span>
                </a>
              </td>
              <td>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                 <?php } ?>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=(($object)==FALSE); if($if1) {  ?>
            <tr>
              <td colspan="2">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
    <div class="clickable">
      <a target="_self" data-type="dialog" data-action="folder" data-method="create" data-id="" data-extra="{'dialogAction':'folder','dialogMethod':'create'}" href="/#/folder/" class="or-link-btn">
        <i class="image-icon image-icon--action-new">
        </i>
        <span><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
        </span>
      </a>
    </div>
 <?php } ?>