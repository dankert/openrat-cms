<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('TYPE'))) ?>
				</span>
			</th>
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
				</span>
			</th>
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LASTCHANGE'))) ?>
				</span>
			</th>
		</tr>
		<?php $if3=(isset($up_url)); if($if3) {  ?>
			<tr class="data clickable">
				<td class="">
					<i class="image-icon image-icon--action-folder">
					</i>
				</td>
				<td class="">
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
	</table></div></div>
	<div class="clickable">
		<a target="_self" data-type="view" data-action="folder" data-method="create" data-id="" data-extra="[]" href="/#/folder/" class="or-link-btn">
			<i class="image-icon image-icon--action-new">
			</i>
			<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
			</span>
		</a>
	</div>