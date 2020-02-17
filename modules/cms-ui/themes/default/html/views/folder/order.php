<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="order" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="or-table--sortable">
			<tr class="headline">
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('FOLDER_ORDER'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_FILENAME'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LASTCHANGE'))) ?>
					</span>
				</td>
			</tr>
			<?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
				<tr data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="data">
					<td class="">
						<span class=""> 
						</span>
					</td>
					<td class="">
						<span class="sort-value"><?php echo encodeHtml(htmlentities(@$icon)) ?>
						</span>
						<i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$icon)) ?>">
						</i>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$filename)) ?>
						</span>
					</td>
					<td class="">
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($date); ?>
						 <?php } ?>
					</td>
				</tr>
			 <?php } ?>
		</table></div></div>
		<input type="hidden" name="order" value="<?php echo encodeHtml(htmlentities(@$order)) ?>" class="">
		</input>
	</form>