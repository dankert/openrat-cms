<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form file" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="file" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_name')))); ?></span>
						
					</div>
					<div class="input">
						<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_filename')))); ?></span>
						
					</div>
					<div class="input">
						<span class="filename"><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('file_extension')))); ?></span>
						
					</div>
					<div class="input">
						<span class="extension"><?php echo nl2br(encodeHtml(htmlentities($extension))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_description')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_full_filename" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_full_filename')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($full_filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_size" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_SIZE')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
					<span><?php echo nl2br(encodeHtml(htmlentities($size))); ?></span>
					
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mimetype" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_mimetype')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($mimetype))); ?></span>
						
						<br/>
						
						<a class="action" target="_self" data-action="file" data-method="size" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/file/">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_file_size'.'')))); ?></span>
							
						</a>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(lang('id'))))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
						
					</div>
				</div>
				<?php $if4=(isset($cache_filename)); if($if4){?>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_cache_filename" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('CACHE_FILENAME')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<span><?php echo nl2br(encodeHtml(htmlentities($cache_filename))); ?></span>
							
							<br/>
							
							<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
							
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($cache_filemtime) ?>
							
						</div>
					</div>
				<?php } ?>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_pages" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_PAGES')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
							<?php foreach($pages as $list_key=>$list_value){ ?><?php extract($list_value) ?>
								<tr>
									<td>
										<a target="_self" data-url="<?php echo $url ?>" data-action="" data-method="info" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
											<img src="./modules/cms-ui/themes/default/images/icon_page.png" />
											
											<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
											
										</a>
									</td>
								</tr>
							<?php } ?>
						</table></div></div>
						<?php $if6=(($pages)==FALSE); if($if6){?>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
							
						<?php } ?>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('prop_userinfo') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_created')))); ?></span>
						
					</div>
					<div class="input">
						<i class="image-icon image-icon--action-el_date"></i>
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($create_date) ?>
						
						<br/>
						
						<i class="image-icon image-icon--action-user"></i>
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($create_user) ?>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_lastchange')))); ?></span>
						
					</div>
					<div class="input">
						<i class="image-icon image-icon--action-el_date"></i>
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
						<br/>
						
						<i class="image-icon image-icon--action-user"></i>
						
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
						<i class="image-icon image-icon--action-el_date"></i>
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($published_date) ?>
						
						<br/>
						
						<i class="image-icon image-icon--action-user"></i>
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($published_user) ?>
						
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /></div></form>
	