<?php /* THIS FILE IS GENERATED from info.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?></h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('type').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang(''.@$type.'').'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('filename').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$filename.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-btn or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </section>
  <?php foreach((array)@$languages as $list_key=>$list_value) { extract($list_value); ?>
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@$languagename.'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('name').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
            <small><?php echo O::escapeHtml(''.@$description.'') ?></small>
          </div>
        </section>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('alias').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$alias.'') ?></span>
            <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-method="<?php echo O::escapeHtml('name') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-languageid="<?php echo O::escapeHtml(''.@$languageid.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;languageid&quot;:&quot;'.@$languageid.'&quot;}') ?>" href="<?php echo O::escapeHtml('#/page') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
              </a>
            </div>
          </div>
        </section>
      </div>
    </section>
   <?php } ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('filename').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('language').'') ?></span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('model').'') ?></span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('filename').'') ?></span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('file_mimetype').'') ?></span>
              </td>
            </tr>
            <?php foreach((array)@$filenames as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('language') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$languageid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/language/'.@$languageid.'') ?>" class="<?php echo O::escapeHtml('or-link or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$languagename.'') ?></span>
                  </a>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$modelid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/model/'.@$modelid.'') ?>" class="<?php echo O::escapeHtml('or-link or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$modelname.'') ?></span>
                  </a>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$filename.'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(' ( '.@$mimetype.' )') ?></span>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('additional_info').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('full_filename').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$tmp_filename.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('template').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if4=(isset($templateid)); if($if4) {  ?>
            <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/template/'.@$templateid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@$template_name.'') ?></span>
              </a>
            </div>
           <?php } ?>
          <?php if(!$if4) {  ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?></i>
            <span><?php echo O::escapeHtml(''.@$template_name.'') ?></span>
           <?php } ?>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('FILE_MIMETYPE').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$mime_type.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('id').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$objectid.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('pageid').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$pageid.'') ?></span>
        </div>
      </section>
    </div>
  </section>
  
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('references').'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
            <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
              <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
                <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?></span>
                </th>
                <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></span>
                </th>
              </tr>
              <?php foreach((array)@$references as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                  <td><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$type.'') ?>"><?php echo O::escapeHtml('') ?></i>
                  </td>
                  <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
                    </a>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </section>
  
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('validity').'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
          <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('settings') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('state').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php $if7=($is_valid); if($if7) {  ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('is_yes').'') ?></span>
                 <?php } ?>
                <?php if(!$if7) {  ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('is_no').'') ?></span>
                 <?php } ?>
              </div>
            </section>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('from').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($valid_from_date); ?>
                 <?php } ?>
              </div>
            </section>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('until').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($valid_to_date); ?>
                 <?php } ?>
              </div>
            </section>
          </a>
        </div>
      </div>
    </section>
  
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('prop_userinfo').'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('created').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($create_date); ?>
               <?php } ?>
            </span>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($create_user); ?>
               <?php } ?>
            </span>
          </div>
        </section>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('lastchange').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
            </span>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($lastchange_user); ?>
               <?php } ?>
            </span>
          </div>
        </section>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('published').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($published_date); ?>
               <?php } ?>
            </span>
            <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?></i>
              <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($published_user); ?>
               <?php } ?>
            </span>
          </div>
        </section>
      </div>
    </section>
  
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('settings').'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
            <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach((array)@$settings as $list_key=>$entry) {  ?>
                <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                  <td><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$entry['key'].'') ?></span>
                  </td>
                  <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('settings') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$entry['value'].'') ?></span>
                    </a>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </section>