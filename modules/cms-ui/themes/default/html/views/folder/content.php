<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
				</span>
				<span class=""> / 
				</span>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LASTCHANGE'))) ?>
				</span>
			</td>
		</tr>
		<?php $if3=(isset($up_url)); if($if3) {  ?>
			<tr class="data">
				<td class="">
					<img src="./modules/cms-ui/themes/default/images/icon_folder.png" class="">
					</img>
					<span class="">..
					</span>
				</td>
				<td class="">
					<span class="">
					</span>
				</td>
			</tr>
		 <?php } ?>
		<?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable <?php echo encodeHtml(htmlentities(@$class)) ?>">
					<img src="./modules/cms-ui/themes/default/images/icon_<?php echo encodeHtml(htmlentities(@$icon)) ?>.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
					<span class=""> 
					</span>
				</td>
				<td class="">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($date); ?>
					 <?php } ?>
				</td>
			</tr>
		 <?php } ?>
		<?php $if3=(($object)==FALSE); if($if3) {  ?>
			<tr class="">
				<td colspan="2" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
					</span>
				</td>
			</tr>
		 <?php } ?>
		<tr class="data">
			<td colspan="2" class="">
				<a target="_self" data-type="view" data-action="folder" data-method="createfolder" data-id="" data-extra="[]" href="/#/folder/" class="">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_folder_createfolder'))) ?>
					</span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2" class="">
				<a target="_self" data-type="view" data-action="folder" data-method="createpage" data-id="" data-extra="[]" href="/#/folder/" class="">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_folder_createpage'))) ?>
					</span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2" class="">
				<a target="_self" data-type="view" data-action="folder" data-method="createfile" data-id="" data-extra="[]" href="/#/folder/" class="">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_folder_createfile'))) ?>
					</span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2" class="">
				<a target="_self" data-type="modal" data-action="folder" data-method="createlink" data-id="" data-extra="[]" href="/#/folder/" class="">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_folder_createlink'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>