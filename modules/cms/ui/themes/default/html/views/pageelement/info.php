<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
              </span>
            </td>
            <td class="name">
              <span><?php echo encodeHtml(htmlentities(@$name)) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@$description)) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
              </span>
            </td>
            <td class="filename">
              <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
              </i>
              <span><?php echo encodeHtml(htmlentities(@lang('el_${element_type'))) ?>}
              </span>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('template'))) ?>
              </span>
            </td>
            <td class="clickable">
              <a target="_self" data-type="open" data-action="template" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$template_id)) ?>" data-extra="[]" href="/#/template/<?php echo encodeHtml(htmlentities(@$template_id)) ?>">
                <i class="image-icon image-icon--action-template">
                </i>
                <span><?php echo encodeHtml(htmlentities(@$template_name)) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('element'))) ?>
              </span>
            </td>
            <td class="clickable">
              <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$element_name)) ?>" name="<?php echo encodeHtml(htmlentities(@$element_name)) ?>" data-action="element" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$element_id)) ?>" data-extra="[]" href="/#/element/<?php echo encodeHtml(htmlentities(@$element_id)) ?>">
                <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
                </i>
                <span><?php echo encodeHtml(htmlentities(@$element_name)) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('format'))) ?>
              </span>
              <span><?php echo encodeHtml(htmlentities(@lang('element'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@$element_format)) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('format'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@$format)) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
              </span>
            </td>
            <td>
              <i class="image-icon image-icon--action-el_date">
              </i>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
              <span>, 
              </span>
              <i class="image-icon image-icon--action-user">
              </i>
              <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
               <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>