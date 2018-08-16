
	
		<table width="100%">
			<?php foreach($projects as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr>
					<td>
						<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $projectname ?></legend><div>
							<?php $if7=(empty($acls)); if($if7){?>
								<tr>
									<td>
										<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
										
									</td>
								</tr>
							<?php } ?>
							<?php $if7=!(empty($acls)); if($if7){?>
								<table width="100%">
									<tr class="headline">
										<td class="help">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_USER')))); ?></span>
											
										</td>
										<td class="help">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
											
										</td>
										<td class="help">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_LANGUAGE')))); ?></span>
											
										</td>
										<?php foreach($show as $list_key=>$t){ ?>
											<td class="help">
												<span class="text" title="<?php echo lang('acl_'.$t.'') ?>"><?php echo nl2br(encodeHtml(htmlentities(lang('acl_'.$t.'_abbrev')))); ?></span>
												
											</td>
										<?php } ?>
									</tr>
									<?php foreach($rights as $aclid=>$acl){ ?><?php extract($acl) ?>
										<tr class="data">
											<td>
												<?php $if12=(!empty($groupname)); if($if12){?>
													<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_group.png" />
													
													<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $groupname,20,'..',constant('STR_PAD_BOTH') )))); ?></span>
													
												<?php } ?>
												<?php $if12=!(!empty($username)); if($if12){?>
													<?php $if13=!(!empty($groupname)); if($if13){?>
														<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_group.png" />
														
														<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_all'.'')))); ?></span>
														
													<?php } ?>
												<?php } ?>
												<?php unset($username) ?>
												
												<?php unset($groupname) ?>
												
											</td>
											<td>
												<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_<?php echo $objecttype ?>.png" />
												
												<a target="_self" data-action="<?php echo $objecttype ?>" data-method="" data-id="<?php echo $objectid ?>" href="<?php echo Html::url($objecttype,'',$objectid) ?>">
													<span class="text" title="<?php echo lang('select') ?>"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $objectname,20,'..',constant('STR_PAD_BOTH') )))); ?></span>
													
												</a>

											</td>
											<td>
												<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $languagename,20,'..',constant('STR_PAD_BOTH') )))); ?></span>
												
											</td>
											<?php foreach($show as $list_key=>$list_value){ ?>
												<td>
													<?php $$list_value= $bits[$list_value]; ?>
													
													<?php { $tmpname     = $list_value;$default  = '';$readonly = '1';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
													
												</td>
											<?php } ?>
										</tr>
									<?php } ?>
								</table>
							<?php } ?>
						</div></fieldset>
					</td>
				</tr>
			<?php } ?>
		</table>
	