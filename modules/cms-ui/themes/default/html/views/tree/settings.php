
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('languages') ?></legend><div>
				<?php foreach($languages as $id=>$name){ ?>
					<div>
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_languageid_<?php echo $id ?>" name="languageid" value="<?php echo $id ?>"<?php if($id==@$languageid)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_languageid_<?php echo $id ?>" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</label>
					</div>
				<?php } ?>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('models') ?></legend><div>
				<?php foreach($models as $id=>$name){ ?>
					<div>
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_modelid_<?php echo $id ?>" name="modelid" value="<?php echo $id ?>"<?php if($id==@$modelid)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_modelid_<?php echo $id ?>" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</label>
					</div>
				<?php } ?>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	