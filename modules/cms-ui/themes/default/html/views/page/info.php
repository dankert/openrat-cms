<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form page" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<span class="headline"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'type'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.$type.'')))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_filename')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_description')))); ?></span>
						
					</div>
					<div class="input">
						<span class="description"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input clickable">
						<a class="or-link-btn" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="./#//">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
							
						</a>
					</div>
				</div>
			</div></fieldset>
			<?php foreach($languages as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $languagename ?></legend><div class="closable">
					<label class="or-form-row"><span class="or-form-label"><?php echo lang('name') ?></span><span class="or-form-input"><span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span></span></label>
					
					<label class="or-form-row"><span class="or-form-label"><?php echo lang('description') ?></span><span class="or-form-input"><span><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span></span></label>
					
					<label class="or-form-row"><span class="or-form-label"><?php echo lang('alias') ?></span><span class="or-form-input"><span><?php echo nl2br(encodeHtml(htmlentities($alias))); ?></span></span></label>
					
					<div class="clickable">
						<a class="or-link-btn" target="_self" data-type="edit" data-action="page" data-method="name" data-id="<?php echo OR_ID ?>" data-extra="{'languageid':'<?php echo $languageid ?>'}" href="./#/page/">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
							
						</a>
					</div>
				</div></fieldset>
			<?php } ?>
			<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_full_filename" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_full_filename')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span class="filename"><?php echo nl2br(encodeHtml(htmlentities($full_filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_full_filename" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_full_filename')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span class="filename"><?php echo nl2br(encodeHtml(htmlentities($tmp_filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_template_name" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_template')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<?php $if6=(isset($templateid)); if($if6){?>
							<div class="clickable">
								<a target="_self" data-type="open" data-action="template" data-method="info" data-id="<?php echo $templateid ?>" data-extra="[]" href="./#/template/<?php echo $templateid ?>">
									<i class="image-icon image-icon--action-template"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
									
								</a>
							</div>
						<?php } ?>
						<?php if(!$if6){?>
							<i class="image-icon image-icon--action-template"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
							
						<?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mime_type" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FILE_MIMETYPE'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span class="filename"><?php echo nl2br(encodeHtml(htmlentities($mime_type))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_objectid" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			
				<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('prop_userinfo') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_create_date" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_created')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
							
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($create_date) ?>
							
							<br/>
							
							<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
							
							<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($create_user) ?>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_lastchange_date" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_lastchange')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
							
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
							
							<br/>
							
							<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
							
							<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_published_date" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_published')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
							
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($published_date) ?>
							
							<br/>
							
							<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
							
							<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($published_user) ?>
							
						</div>
					</div>
				</div></fieldset>
			
		<div class="or-form-actionbar"></div></form>
	