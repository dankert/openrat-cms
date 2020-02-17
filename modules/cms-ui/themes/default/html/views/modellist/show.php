<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</td>
			<td class="">
				<span class="">
				</span>
			</td>
			<td class="">
				<span class="">
				</span>
			</td>
		</tr>
		<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="model" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/model/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<i class="image-icon image-icon--action-model">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
				<?php $if5=(!$is_default); if($if5) {  ?>
					<td class="clickable">
						<?php $if7=(isset($id)); if($if7) {  ?>
							<a target="_self" data-type="post" data-action="model" data-method="setdefault" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" data-data="{"action":"model","subaction":"setdefault","id":"<?php echo encodeHtml(htmlentities(@$id)) ?>",\"token":"<?php echo token() ?>","none":"0"}"" class="">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_make_default'))) ?>
								</span>
							</a>
						 <?php } ?>
					</td>
				 <?php } ?>
				<?php if(!$if5) {  ?>
					<td class="">
						<em class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
						</em>
					</td>
				 <?php } ?>
			</tr>
			<?php  { unset($select_url) ?>
			 <?php } ?>
			<?php  { unset($default_url) ?>
			 <?php } ?>
		 <?php } ?>
		<tr class="data">
			<td colspan="2" class="clickable">
				<a target="_self" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
					<i class="image-icon image-icon--method-add">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>