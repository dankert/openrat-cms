
	
		
		
		<form name="" target="_self" data-target="upload" action="./" data-method="createfile" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="multipart/form-data" class="or-form folder" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="createfile" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="type" value="file"/>
			
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_FILE')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<input size="40" id="req154344041025418490_file" type="file" maxlength="<?php echo $maxlength ?>" name="file" class="upload"  multiple="multiple" />
					
				</div>
			</div>
			<div class="line filedropzone">
				<div class="label">
				</div>
				<div class="input">
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="help"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_max_size'.'')))); ?></span>
					
				</div>
				<div class="input">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($max_size))); ?></span>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'HTTP_URL'.'')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_url" name="<?php if ('') echo ''.'_' ?>url<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$url) ?>" /><?php if ('') { ?><input type="hidden" name="url" value="<?php $url ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('description') ?></legend><div>
			</div></fieldset>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_NAME')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_DESCRIPTION')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>description<?php if ('') echo '_disabled' ?>"><?php echo Text::encodeHtml('') ?></textarea></div>
					
				</div>
			</div>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
		
		
	