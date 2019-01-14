
	
		<form name="" target="_self" data-target="view" action="./" data-method="diff" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" class="or-form pageelement" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="diff" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
				<tr class="headline">
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NR')))); ?></span>
						
					</td>
					<td colspan="2" class="help">
						<?php $if6=(isset($compareid)); if($if6){?>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_COMPARE')))); ?></span>
							
						<?php } ?>
						<?php if(!$if6){?>
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
						<?php } ?>
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('DATE')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_USER')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_VALUE')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_STATE')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_ACTION')))); ?></span>
						
					</td>
				</tr>
				<?php $if4=(($el)==FALSE); if($if4){?>
					<tr>
						<td colspan="8">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
							
						</td>
					</tr>
				<?php } ?>
				<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data">
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities($lfd_nr))); ?></span>
							
						</td>
						<td>
							<?php $if7=(isset($compareid)); if($if7){?>
								<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_compareid_<?php echo $id ?>" name="compareid" value="<?php echo $id ?>"<?php if($id==@$compareid)echo ' checked="checked"' ?> />
								
							<?php } ?>
							<?php if(!$if7){?>
								<span><?php echo nl2br('&nbsp;'); ?></span>
								
							<?php } ?>
						</td>
						<td>
							<?php $if7=(isset($compareid)); if($if7){?>
								<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_withid_<?php echo $id ?>" name="withid" value="<?php echo $id ?>"<?php if($id==@$withid)echo ' checked="checked"' ?> />
								
							<?php } ?>
							<?php if(!$if7){?>
								<span><?php echo nl2br('&nbsp;'); ?></span>
								
							<?php } ?>
						</td>
						<td>
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities($user))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities($value))); ?></span>
							
						</td>
						<?php $if6=($public); if($if6){?>
							<td>
								<strong><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_PUBLIC'.'')))); ?></strong>
								
							</td>
						<?php } ?>
						<?php if(!$if6){?>
							<?php $if7=(isset($releaseUrl)); if($if7){?>
								<td class="clickable">
									<a title="<?php echo lang('GLOBAL_RELEASE_DESC') ?>" target="_self" data-type="post" data-action="" data-method="release" data-id="<?php echo $objectid ?>" data-extra="{'valueid':'<?php echo $valueid ?>'}" data-data="{&quot;action&quot;:&quot;pageelement&quot;,&quot;subaction&quot;:&quot;release&quot;,&quot;id&quot;:&quot;<?php echo $objectid ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;valueid&quot;:&quot;<?php echo $valueid ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
										<strong><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_RELEASE'.'')))); ?></strong>
										
									</a>

								</td>
							<?php } ?>
							<?php if(!$if7){?>
								<td>
									<em><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_INACTIVE'.'')))); ?></em>
									
								</td>
							<?php } ?>
						<?php } ?>
						<?php $if6=($active); if($if6){?>
							<td>
								<em><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_ACTIVE'.'')))); ?></em>
								
							</td>
						<?php } ?>
						<?php if(!$if6){?>
							<?php $if7=(isset($useUrl)); if($if7){?>
								<td class="clickable">
									<a title="<?php echo lang('GLOBAL_USE_DESC') ?>" target="_self" data-type="post" data-action="" data-method="use" data-id="<?php echo $objectid ?>" data-extra="{'valueid':'<?php echo $valueid ?>'}" data-data="{&quot;action&quot;:&quot;pageelement&quot;,&quot;subaction&quot;:&quot;use&quot;,&quot;id&quot;:&quot;<?php echo $objectid ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;valueid&quot;:&quot;<?php echo $valueid ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
										<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_USE'.'')))); ?></span>
										
									</a>

								</td>
							<?php } ?>
							<?php if(!$if7){?>
								<td>
								</td>
							<?php } ?>
						<?php } ?>
					</tr>
				<?php } ?>
			</table>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('compare') ?>" /></div></form>
	