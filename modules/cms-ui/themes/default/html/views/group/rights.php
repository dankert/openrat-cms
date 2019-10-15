<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%">
			<?php foreach($projects as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr>
					<td>
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $projectname ?></legend><div class="closable">
							<?php $if7=(($rights)==FALSE); if($if7){?>
								<tr>
									<td>
										<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
										
									</td>
								</tr>
							<?php } ?>
							<?php $if7=!(($rights)==FALSE); if($if7){?>
								<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
									<tr class="headline">
										<td class="help">
											<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_USER')))); ?></span>
											
										</td>
										<td class="help">
											<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
											
										</td>
										<td class="help">
											<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_LANGUAGE')))); ?></span>
											
										</td>
										<?php foreach($show as $list_key=>$t){ ?>
											<td class="help">
												<span title="<?php echo lang('acl_'.$t.'') ?>"><?php echo nl2br(encodeHtml(htmlentities(lang('acl_'.$t.'_abbrev')))); ?></span>
												
											</td>
										<?php } ?>
									</tr>
									<?php foreach($rights as $aclid=>$acl){ ?><?php extract($acl) ?>
										<tr class="data clickable">
											<td>
												<?php $if12=(isset($groupname)); if($if12){?>
													<i class="image-icon image-icon--action-group"></i>
													
													<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $groupname,20,'..',constant('STR_PAD_BOTH') )))); ?></span>
													
												<?php } ?>
												<?php $if12=!(isset($username)); if($if12){?>
													<?php $if13=!(isset($groupname)); if($if13){?>
														<i class="image-icon image-icon--action-group"></i>
														
														<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_all'.'')))); ?></span>
														
													<?php } ?>
												<?php } ?>
												<?php unset($username) ?>
												
												<?php unset($groupname) ?>
												
											</td>
											<td title="<?php echo $objectname ?>">
												<i class="image-icon image-icon--action-<?php echo $objecttype ?>"></i>
												
												<a target="_self" data-type="open" data-action="<?php echo $objecttype ?>" data-method="" data-id="<?php echo $objectid ?>" data-extra="[]" href="./#/<?php echo $objecttype ?>/<?php echo $objectid ?>">
													<span><?php echo nl2br(encodeHtml(htmlentities($objectname))); ?></span>
													
												</a>
											</td>
											<td>
												<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $languagename,20,'..',constant('STR_PAD_BOTH') )))); ?></span>
												
											</td>
											<?php foreach($show as $list_key=>$list_value){ ?>
												<td>
													<?php $$list_value= $bits[$list_value]; ?>
													
													<?php { $tmpname     = $list_value;$default  = '';$readonly = '1';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
													
												</td>
											<?php } ?>
										</tr>
									<?php } ?>
								</table></div></div>
							<?php } ?>
						</div></fieldset>
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	