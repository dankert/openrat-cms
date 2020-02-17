<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="">
			<td class="header">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
			<td class="header">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LASTCHANGE'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($result as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<img src="./modules/cms-ui/themes/default/images/icon_<?php echo encodeHtml(htmlentities(@$type)) ?>.png" class="">
						</img>
						<span title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
				<td class="">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
					 <?php } ?>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>