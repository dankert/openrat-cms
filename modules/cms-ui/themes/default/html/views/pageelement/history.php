<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="diff" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
			<tr class="headline">
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NR'))) ?>
					</span>
				</td>
				<td colspan="2" class="help">
					<?php $if6=(isset($compareid)); if($if6) {  ?>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_COMPARE'))) ?>
						</span>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<span class=""> 
						</span>
					 <?php } ?>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('DATE'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_STATE'))) ?>
					</span>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ACTION'))) ?>
					</span>
				</td>
			</tr>
			<?php $if4=(($el)==FALSE); if($if4) {  ?>
				<tr class="">
					<td colspan="8" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
						</span>
					</td>
				</tr>
			 <?php } ?>
			<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
				<tr class="data">
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$lfd_nr)) ?>
						</span>
					</td>
					<td class="">
						<?php $if7=(isset($compareid)); if($if7) {  ?>
							<input type="radio" name="compareid" disabled="" value="<?php echo encodeHtml(htmlentities(@$id)) ?>" checked="<?php echo encodeHtml(htmlentities(@$compareid)) ?>" class="">
							</input>
						 <?php } ?>
						<?php if(!$if7) {  ?>
							<span class=""> 
							</span>
						 <?php } ?>
					</td>
					<td class="">
						<?php $if7=(isset($compareid)); if($if7) {  ?>
							<input type="radio" name="withid" disabled="" value="<?php echo encodeHtml(htmlentities(@$id)) ?>" checked="<?php echo encodeHtml(htmlentities(@$withid)) ?>" class="">
							</input>
						 <?php } ?>
						<?php if(!$if7) {  ?>
							<span class=""> 
							</span>
						 <?php } ?>
					</td>
					<td class="">
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($date); ?>
						 <?php } ?>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$user)) ?>
						</span>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$value)) ?>
						</span>
					</td>
					<?php $if6=($public); if($if6) {  ?>
						<td class="">
							<strong class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_PUBLIC'))) ?>
							</strong>
						</td>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<?php $if7=(isset($releaseUrl)); if($if7) {  ?>
							<td class="clickable">
								<a title="<?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE_DESC'))) ?>" target="_self" data-type="post" data-action="" data-method="release" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="{'valueid':'<?php echo encodeHtml(htmlentities(@$valueid)) ?>'}" data-data="{"action":"pageelement","subaction":"release","id":"<?php echo encodeHtml(htmlentities(@$objectid)) ?>",\"token":"<?php echo token() ?>","valueid":"<?php echo encodeHtml(htmlentities(@$valueid)) ?>","none":"0"}"" class="">
									<strong class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
									</strong>
								</a>
							</td>
						 <?php } ?>
						<?php if(!$if7) {  ?>
							<td class="">
								<em class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_INACTIVE'))) ?>
								</em>
							</td>
						 <?php } ?>
					 <?php } ?>
					<?php $if6=($active); if($if6) {  ?>
						<td class="">
							<em class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ACTIVE'))) ?>
							</em>
						</td>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<?php $if7=(isset($useUrl)); if($if7) {  ?>
							<td class="clickable">
								<a title="<?php echo encodeHtml(htmlentities(@lang('GLOBAL_USE_DESC'))) ?>" target="_self" data-type="post" data-action="" data-method="use" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="{'valueid':'<?php echo encodeHtml(htmlentities(@$valueid)) ?>'}" data-data="{"action":"pageelement","subaction":"use","id":"<?php echo encodeHtml(htmlentities(@$objectid)) ?>",\"token":"<?php echo token() ?>","valueid":"<?php echo encodeHtml(htmlentities(@$valueid)) ?>","none":"0"}"" class="">
									<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USE'))) ?>
									</span>
								</a>
							</td>
						 <?php } ?>
						<?php if(!$if7) {  ?>
							<td class="">
							</td>
						 <?php } ?>
					 <?php } ?>
				</tr>
			 <?php } ?>
		</table></div></div>
	</form>