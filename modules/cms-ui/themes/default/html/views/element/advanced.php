<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('security','disable_dynamic_code')); if($if2) {  ?>
		<?php $if3=(!true); if($if3) {  ?>
			<div class="message warn">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('NOTICE_CODE_DISABLED'))) ?>
				</span>
			</div>
		 <?php } ?>
	 <?php } ?>
	<form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<?php $if4=(isset($subtype)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_SUBTYPE'))) ?>
						</span>
					</div>
					<div class="input">
						<?php $if7=(isset($subtypes)); if($if7) {  ?>
							<input name="subtype" value="<?php echo encodeHtml(htmlentities(@$subtype)) ?>" size="1" class="">
							</input>
						 <?php } ?>
						<?php $if7=!(isset($subtypes)); if($if7) {  ?>
							<input name="subtype" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$subtype)) ?>" class="">
							</input>
						 <?php } ?>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($with_icon)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="with_icon" value="1" <?php if(''.@$with_icon.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_WITH_ICON'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($inherit)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="inherit" value="1" <?php if(''.@$inherit.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_INHERIT'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($all_languages)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="all_languages" value="1" <?php if(''.@$all_languages.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_ALL_LANGUAGES'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($writable)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="writable" value="1" <?php if(''.@$writable.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_writable'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($width)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('width'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="width" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($height)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('height'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="height" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($dateformat)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DATEFORMAT'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="dateformat" value="<?php echo encodeHtml(htmlentities(@$dateformat)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($format)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_FORMAT'))) ?>
						</span>
					</div>
					<div class="input">
						<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php'); { <?php component_radio_box(format,$formatlist,${format}) ?> ?>
						 <?php } ?>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($decimals)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DECIMALS'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="decimals" type="text" maxlength="2" value="<?php echo encodeHtml(htmlentities(@$decimals)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($dec_point)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEC_POINT'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="dec_point" type="text" maxlength="5" value="<?php echo encodeHtml(htmlentities(@$dec_point)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($thousand_sep)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_thousand_sep'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="thousand_sep" type="text" maxlength="1" value="<?php echo encodeHtml(htmlentities(@$thousand_sep)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($default_text)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_text'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="default_text" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$default_text)) ?>" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($default_longtext)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_longtext'))) ?>
						</span>
					</div>
					<div class="input">
						<textarea name="default_longtext" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$default_longtext)) ?>
						</textarea>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($parameters)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DYNAMIC_PARAMETERS'))) ?>
						</span>
					</div>
					<div class="input">
						<textarea name="parameters" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$parameters)) ?>
						</textarea>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php foreach($dynamic_class_parameters as $paramName=>$defaultValue) {  ?>
							<span class=""><?php echo encodeHtml(htmlentities(@$paramName)) ?>
							</span>
							<span class=""> (
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DEFAULT'))) ?>
							</span>
							<span class="">) = 
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@$defaultValue)) ?>
							</span>
							<br>
							</br>
						 <?php } ?>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($select_items)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_select_items'))) ?>
						</span>
					</div>
					<div class="input">
						<textarea name="select_items" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$select_items)) ?>
						</textarea>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($linkelement)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_LINK'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="linkelement" value="<?php echo encodeHtml(htmlentities(@$linkelement)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($name)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="name" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($folderobjectid)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_FOLDEROBJECT'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="folderobjectid" value="<?php echo encodeHtml(htmlentities(@$folderobjectid)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($default_objectid)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_OBJECT'))) ?>
						</span>
					</div>
					<div class="input">
						<input name="default_objectid" value="<?php echo encodeHtml(htmlentities(@$default_objectid)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($code)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_code'))) ?>
						</span>
					</div>
					<div class="input">
						<textarea name="code" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$code)) ?>
						</textarea>
					</div>
				</div>
			 <?php } ?>
		</div></fieldset>
	</form>