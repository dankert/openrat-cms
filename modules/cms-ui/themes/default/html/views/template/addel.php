
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_name')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('element_type')))); ?></span>
					
				</div>
				<div class="input">
					<?php $text= 'text'; ?>
					
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_typeid" name="typeid" title="" class=""<?php if (count($types)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($types,$typeid,0,1) ?><?php if (count($types)==0) { ?><input type="hidden" name="typeid" value="" /><?php } ?><?php if (count($types)==1) { ?><input type="hidden" name="typeid" value="<?php echo array_keys($types)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
			</div></fieldset>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<label for="<?php echo REQUEST_ID ?>_addtotemplate" class="label">
						<?php { $tmpname     = 'addtotemplate';$default  = '1';$readonly = '';		
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
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_template_srcelement'.'')))); ?></span>
						
					</label>
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	