<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<?php $if2=(config('security','nopublish')); if($if2){?>
			<div class="message warn">
				<span class="help"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NOPUBLISH_DESC'.'')))); ?></span>
				
			</div>
		<?php } ?>
		<form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="true" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="pub" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=($pages); if($if3){?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'pages';$default  = false;$readonly = false;$required = false;		
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
						
						<label for="<?php echo REQUEST_ID ?>_pages" class="label">
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_pages')))); ?></span>
							
						</label>
					</div>
				</div>
			<?php } ?>
			<?php $if3=($files); if($if3){?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'files';$default  = false;$readonly = false;$required = false;		
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
						
						<label for="<?php echo REQUEST_ID ?>_files" class="label">
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_files')))); ?></span>
							
						</label>
					</div>
				</div>
			<?php } ?>
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
				<?php $if4=(isset($subdirs)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'subdirs';$default  = false;$readonly = $subdirs;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_subdirs" class="label">
								<span><?php echo nl2br('&nbsp;'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_PUBLISH_WITH_SUBDIRS')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($clean)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'clean';$default  = false;$readonly = false;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_clean" class="label">
								<span><?php echo nl2br('&nbsp;'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_CLEAN_AFTER_PUBLISH')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('publish') ?>" /></div></form>
	