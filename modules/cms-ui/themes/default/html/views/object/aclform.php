
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="aclform" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="object" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="object" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="aclform" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('users') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_all" name="type" value="all"<?php if('all'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_all" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_ALL')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
				</div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_user" name="type" value="user"<?php if('user'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_user" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_USER')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_userid" name="userid" title="" class=""<?php if (count($users)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($users,'',1,0) ?><?php if (count($users)==0) { ?><input type="hidden" name="userid" value="" /><?php } ?><?php if (count($users)==1) { ?><input type="hidden" name="userid" value="<?php echo array_keys($users)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<?php $if4=(isset($groups)); if($if4){?>
					<div class="line">
						<div class="label">
							<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_group" name="type" value="group"<?php if('group'==@$type)echo ' checked="checked"' ?> />
							
							<label for="<?php echo REQUEST_ID ?>_type_group" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_GROUP')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_groupid" name="groupid" title="" class=""<?php if (count($groups)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($groups,'',1,0) ?><?php if (count($groups)==0) { ?><input type="hidden" name="groupid" value="" /><?php } ?><?php if (count($groups)==1) { ?><input type="hidden" name="groupid" value="<?php echo array_keys($groups)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('language') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_languageid" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_LANGUAGE')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_languageid" name="languageid" title="" class=""<?php if (count($languages)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($languages,'',0,0) ?><?php if (count($languages)==0) { ?><input type="hidden" name="languageid" value="" /><?php } ?><?php if (count($languages)==1) { ?><input type="hidden" name="languageid" value="<?php echo array_keys($languages)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('acl') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php foreach($show as $k=>$t){ ?>
							<div>
								<?php $if8=($t=='read'); if($if8){?>
									<?php $$t= '1'; ?>
									
									<?php { $tmpname     = $t;$default  = '';$readonly = '1';$required = '';		
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
									
								<?php } ?>
								<?php if(!$if8){?>
									<?php unset($$t) ?>
									
									<?php { $tmpname     = $t;$default  = '';$readonly = '';$required = '';		
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
									
								<?php } ?>
								<label for="<?php echo REQUEST_ID ?>_<?php echo $t ?>_" class="label">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('acl_'.$t.'')))); ?></span>
									
								</label>
							</div>
						<?php } ?>
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	