
	
		<form name="" target="_self" data-target="view" action="./" data-method="export" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="project" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="export" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_DATABASE'.'')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dbid" name="dbid" title="" class=""<?php if (count($dbids)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dbids,'actdbid',0,0) ?><?php if (count($dbids)==0) { ?><input type="hidden" name="dbid" value="" /><?php } ?><?php if (count($dbids)==1) { ?><input type="hidden" name="dbid" value="<?php echo array_keys($dbids)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	