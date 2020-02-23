<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr>
            <td colspan="2" class="logo">
              <div class="line logo">
                <div class="label">
                  <img src="themes/default/images/logo_projectmenu.png" border="0" />
                </div>
                <div class="input">
                  <h2><?php echo encodeHtml(htmlentities(@lang('logo_projectmenu'))) ?>
                  </h2>
                  <p><?php echo encodeHtml(htmlentities(@lang('logo_projectmenu_text'))) ?>
                  </p>
                </div>
              </div>
            </td>
          </tr>
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('project'))) ?>
              </span>
            </td>
          </tr>
          <?php foreach($projects as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <a title="<?php echo encodeHtml(htmlentities(@lang('TREE_CHOOSE_PROJECT'))) ?>" target="_self" data-type="post" data-action="" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" data-data="{"action":"start","subaction":"projectmenu","id":"<?php echo encodeHtml(htmlentities(@$id)) ?>",\"token":"<?php echo token() ?>","none":"0"}"">
                  <?php  { $project= 'project'; ?>
                   <?php } ?>
                  <img src="./modules/cms/ui/themes/default/images/icon_project.png" />
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
                <div class="onrowvisible">
                  <div class="arrow-down">
                  </div>
                  <div class="dropdown">
                    <form name="" target="_self" data-target="view" action="./" data-method="project" data-action="index" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form index">
                      <input type="hidden" name="token" value="<?php echo token();?>" />
                      <input type="hidden" name="action" value="index" />
                      <input type="hidden" name="subaction" value="project" />
                      <input type="hidden" name="id" value="<?php echo encodeHtml(htmlentities(@$id)) ?>" />
                      <div>
                        <div class="or-table-wrapper">
                          <div class="or-table-filter">
                            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
                          </div>
                          <div class="or-table-area">
                            <table width="100%">
                              <tr>
                                <td>
                                  <?php foreach( $models as $_key=>$_value) {  ?>
                                    <label>
                                      <input type="radio" name="modelid" value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==${defaultmodelid}){ ?>checked="checked"<?php } ?> />
                                      <span><?php echo encodeHtml(htmlentities(@$_value)) ?>
                                      </span>
                                    </label>
                                    <br />
                                   <?php } ?>
                                </td>
                                <td>
                                  <?php foreach( $languages as $_key=>$_value) {  ?>
                                    <label>
                                      <input type="radio" name="languageid" value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==${defaultlanguageid}){ ?>checked="checked"<?php } ?> />
                                      <span><?php echo encodeHtml(htmlentities(@$_value)) ?>
                                      </span>
                                    </label>
                                    <br />
                                   <?php } ?>
                                </td>
                                <td>
                                  
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="or-form-actionbar">
                        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
                        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
                      </div>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>