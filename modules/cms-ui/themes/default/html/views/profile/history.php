<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('project'))) ?>
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('filename'))) ?>
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($timeline as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" data-type="open" data-action="project" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" data-extra="[]" href="/#/project/<?php echo encodeHtml(htmlentities(@$projectid)) ?>" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$projectname)) ?>
						</span>
					</a>
				</td>
				<td title="<?php echo encodeHtml(htmlentities(@$filename)) ?>" class="clickable">
					<a target="_self" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$filename)) ?>
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