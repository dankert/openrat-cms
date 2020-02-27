<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
              </span>
            </th>
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('DESCRIPTION'))) ?>
              </span>
            </th>
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('TYPE'))) ?>
              </span>
            </th>
          </tr>
          <?php $if1=(($elements)==FALSE); if($if1) {  ?>
            <tr>
              <td>
                <span><?php echo encodeHtml(htmlentities(@lang('NOT_FOUND'))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach($elements as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data clickable">
              <td>
                <a title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="pageelement" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$pageelementid)) ?>" data-extra="[]" href="/#/pageelement/<?php echo encodeHtml(htmlentities(@$pageelementid)) ?>">
                  <i class="image-icon image-icon--action-pageelement">
                  </i>
                  <span><?php echo encodeHtml(htmlentities(@$label)) ?>
                  </span>
                </a>
              </td>
              <td title="<?php echo encodeHtml(htmlentities(@$desc)) ?>">
                <span><?php echo encodeHtml(htmlentities(@$desc)) ?>
                </span>
              </td>
              <td>
                <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$typename)) ?>">
                </i>
                <span><?php echo encodeHtml(htmlentities(@lang(''.@$typename.''))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>