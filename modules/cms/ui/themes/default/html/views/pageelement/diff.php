<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="">
			<td class="">
			</td>
			<td class="">
				<em class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_COMPARE'))) ?>
				</em>
				<span class=""> 
				</span>
				<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($date_left); ?>
				 <?php } ?>
			</td>
			<td class="">
			</td>
			<td class="">
				<em class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_WITH'))) ?>
				</em>
				<span class=""> 
				</span>
				<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($date_right); ?>
				 <?php } ?>
			</td>
		</tr>
		<tr class="">
			<td colspan="4" class="">
			</td>
		</tr>
		<?php foreach($diff as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="diff">
				<?php $if5=(isset($left)); if($if5) {  ?>
					<td width="5%" class="line">
						<tt class=""><?php echo encodeHtml(htmlentities(@$left['line'])) ?>
						</tt>
					</td>
					<td width="45%" class="<?php echo encodeHtml(htmlentities(@$left['type'])) ?>">
						<span class=""><?php echo encodeHtml(htmlentities(@$left['text'])) ?>
						</span>
					</td>
				 <?php } ?>
				<?php if(!$if5) {  ?>
					<td width="50%" colspan="2" class="help">
						<span class=""> 
						</span>
					</td>
				 <?php } ?>
				<?php $if5=(isset($right)); if($if5) {  ?>
					<td width="5%" class="line">
						<tt class=""><?php echo encodeHtml(htmlentities(@$right['line'])) ?>
						</tt>
					</td>
					<td width="45%" class="<?php echo encodeHtml(htmlentities(@$right['type'])) ?>">
						<span class=""><?php echo encodeHtml(htmlentities(@$right['text'])) ?>
						</span>
					</td>
				 <?php } ?>
				<?php if(!$if5) {  ?>
					<td width="50%" colspan="2" class="help">
						<span class=""> 
						</span>
					</td>
				 <?php } ?>
			</tr>
			<?php  { unset($left) ?>
			 <?php } ?>
			<?php  { unset($right) ?>
			 <?php } ?>
		 <?php } ?>
	</table></div></div>