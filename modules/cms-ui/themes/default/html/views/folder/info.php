
	
		<form name="" target="_self" data-target="view" action="./" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('GLOBAL_PROP') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('global_name') ?>
						</label>
					</div>
					<div class="input">
						<span class="name,focus"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_filename" class="label"><?php echo lang('global_filename') ?>
						</label>
					</div>
					<div class="input">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_description" class="label"><?php echo lang('global_description') ?>
						</label>
					</div>
					<div class="input">
						<span class="description"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_full_filename" class="label"><?php echo lang('FULL_FILENAME') ?>
						</label>
					</div>
					<div class="input">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($full_filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_objectid" class="label"><?php echo lang('id') ?>
						</label>
					</div>
					<div class="input">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PROP_USERINFO') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_create_user" class="label"><?php echo lang('global_created') ?>
						</label>
					</div>
					<div class="input">
						<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/date.svg" />
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($create_date) ?>
						
						<br/>
						
						<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($create_user) ?>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_lastchange_user" class="label"><?php echo lang('global_lastchange') ?>
						</label>
					</div>
					<div class="input">
						<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/date.svg" />
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
						<br/>
						
						<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	