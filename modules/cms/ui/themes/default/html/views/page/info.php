<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
		<span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('${type'))) ?>}
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('global_filename'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$filename)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('global_description'))) ?>
					</span>
				</div>
				<div class="input">
					<span class="description"><?php echo encodeHtml(htmlentities(@$description)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input clickable">
					<a target="_self" data-type="dialog" data-action="" data-method="prop" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="/#//" class="or-link-btn">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
						</span>
					</a>
				</div>
			</div>
		</div></fieldset>
		<?php foreach($languages as $list_key=>$list_value) { extract($list_value); ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<label class="or-form-row"><span class="or-form-input"><span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
				</span></span></label>
				<label class="or-form-row"><span class="or-form-input"><span class=""><?php echo encodeHtml(htmlentities(@$description)) ?>
				</span></span></label>
				<label class="or-form-row"><span class="or-form-input"><span class=""><?php echo encodeHtml(htmlentities(@$alias)) ?>
				</span></span></label>
				<div class="clickable">
					<a target="_self" data-type="edit" data-action="page" data-method="name" data-id="" data-extra="{'languageid':'<?php echo encodeHtml(htmlentities(@$languageid)) ?>'}" href="/#/page/" class="or-link-btn">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
						</span>
					</a>
				</div>
			</div></fieldset>
		 <?php } ?>
		<fieldset class="or-group toggle-open-close closed show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_full_filename'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<span class="filename"><?php echo encodeHtml(htmlentities(@$full_filename)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_full_filename'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<span class="filename"><?php echo encodeHtml(htmlentities(@$tmp_filename)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_template'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<?php $if6=(isset($templateid)); if($if6) {  ?>
						<div class="clickable">
							<a target="_self" data-type="open" data-action="template" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$templateid)) ?>" data-extra="[]" href="/#/template/<?php echo encodeHtml(htmlentities(@$templateid)) ?>" class="">
								<i class="image-icon image-icon--action-template">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@$template_name)) ?>
								</span>
							</a>
						</div>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<i class="image-icon image-icon--action-template">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$template_name)) ?>
						</span>
					 <?php } ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('FILE_MIMETYPE'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<span class="filename"><?php echo encodeHtml(htmlentities(@$mime_type)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$objectid)) ?>
					</span>
				</div>
			</div>
		</div></fieldset>
			<fieldset class="or-group toggle-open-close closed show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('global_created'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date('var:create_date'); ?>
						 <?php } ?>
						<br>
						</br>
						<img src="./modules/cms-ui/themes/default/images/icon/user.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php'); { component_user('var:create_user'); ?>
						 <?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('global_lastchange'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date('var:lastchange_date'); ?>
						 <?php } ?>
						<br>
						</br>
						<img src="./modules/cms-ui/themes/default/images/icon/user.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php'); { component_user('var:lastchange_user'); ?>
						 <?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('global_published'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date('var:published_date'); ?>
						 <?php } ?>
						<br>
						</br>
						<img src="./modules/cms-ui/themes/default/images/icon/user.png" class="">
						</img>
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php'); { component_user('var:published_user'); ?>
						 <?php } ?>
					</div>
				</div>
			</div></fieldset>
	</form>