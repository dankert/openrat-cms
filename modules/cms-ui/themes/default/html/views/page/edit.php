<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
				</span>
			</th>
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('DESCRIPTION'))) ?>
				</span>
			</th>
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('TYPE'))) ?>
				</span>
			</th>
		</tr>
		<?php $if3=(($elements)==FALSE); if($if3) {  ?>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('NOT_FOUND'))) ?>
					</span>
				</td>
			</tr>
		 <?php } ?>
		<?php foreach($elements as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data clickable">
				<td class="">
					<a title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="pageelement" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$pageelementid)) ?>" data-extra="[]" href="/#/pageelement/<?php echo encodeHtml(htmlentities(@$pageelementid)) ?>" class="">
						<i class="image-icon image-icon--action-pageelement">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$label)) ?>
						</span>
					</a>
				</td>
				<td title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$desc)) ?>
					</span>
				</td>
				<td class="">
					<i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$typename)) ?>">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('${typename'))) ?>}
					</span>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>