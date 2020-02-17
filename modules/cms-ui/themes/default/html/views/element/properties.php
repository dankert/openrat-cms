<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="properties" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
				<?php $if5=(isset($subtype)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_SUBTYPE'))) ?>
							</span>
						</td>
						<td class="">
							<?php $if8=(isset($subtypes)); if($if8) {  ?>
								<input name="subtype" value="<?php echo encodeHtml(htmlentities(@$subtype)) ?>" size="1" class="">
								</input>
							 <?php } ?>
							<?php $if8=!(isset($subtypes)); if($if8) {  ?>
								<input name="subtype" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$subtype)) ?>" class="">
								</input>
							 <?php } ?>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($with_icon)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_WITH_ICON'))) ?>
							</span>
						</td>
						<td class="">
							<input type="checkbox" name="with_icon" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$with_icon)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($all_languages)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_ALL_LANGUAGES'))) ?>
							</span>
						</td>
						<td class="">
							<input type="checkbox" name="all_languages" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$all_languages)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($writable)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_writable'))) ?>
							</span>
						</td>
						<td class="">
							<input type="checkbox" name="writable" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$writable)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($width)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('width'))) ?>
							</span>
						</td>
						<td class="">
							<input name="width" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($height)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('height'))) ?>
							</span>
						</td>
						<td class="">
							<input name="height" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($dateformat)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DATEFORMAT'))) ?>
							</span>
						</td>
						<td class="">
							<input name="dateformat" value="<?php echo encodeHtml(htmlentities(@$dateformat)) ?>" size="1" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($format)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_FORMAT'))) ?>
							</span>
						</td>
						<td class="">
							<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php'); { <?php component_radio_box(format,$formatlist,${format}) ?> ?>
							 <?php } ?>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($decimals)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DECIMALS'))) ?>
							</span>
						</td>
						<td class="">
							<input name="decimals" disabled="" type="text" maxlength="2" value="<?php echo encodeHtml(htmlentities(@$decimals)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($dec_point)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEC_POINT'))) ?>
							</span>
						</td>
						<td class="">
							<input name="dec_point" disabled="" type="text" maxlength="5" value="<?php echo encodeHtml(htmlentities(@$dec_point)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($thousand_sep)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_thousand_sep'))) ?>
							</span>
						</td>
						<td class="">
							<input name="thousand_sep" disabled="" type="text" maxlength="1" value="<?php echo encodeHtml(htmlentities(@$thousand_sep)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($default_text)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_text'))) ?>
							</span>
						</td>
						<td class="">
							<input name="default_text" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$default_text)) ?>" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($default_longtext)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_default_longtext'))) ?>
							</span>
						</td>
						<td class="">
							<textarea name="default_longtext" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$default_longtext)) ?>
							</textarea>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($parameters)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DYNAMIC_PARAMETERS'))) ?>
							</span>
						</td>
						<td class="">
							<textarea name="parameters" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$parameters)) ?>
							</textarea>
						</td>
					</tr>
					<tr class="">
						<td class="">
						</td>
						<td class="">
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
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($select_items)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_select_items'))) ?>
							</span>
						</td>
						<td class="">
							<textarea name="select_items" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$select_items)) ?>
							</textarea>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($linkelement)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_LINK'))) ?>
							</span>
						</td>
						<td class="">
							<input name="linkelement" value="<?php echo encodeHtml(htmlentities(@$linkelement)) ?>" size="1" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($name)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
							</span>
						</td>
						<td class="">
							<input name="name" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" size="1" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($folderobjectid)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_FOLDEROBJECT'))) ?>
							</span>
						</td>
						<td class="">
							<input name="folderobjectid" value="<?php echo encodeHtml(htmlentities(@$folderobjectid)) ?>" size="1" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($default_objectid)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_DEFAULT_OBJECT'))) ?>
							</span>
						</td>
						<td class="">
							<input name="default_objectid" value="<?php echo encodeHtml(htmlentities(@$default_objectid)) ?>" size="1" class="">
							</input>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($code)); if($if5) {  ?>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('EL_PROP_code'))) ?>
							</span>
						</td>
						<td class="">
							<textarea name="code" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$code)) ?>
							</textarea>
						</td>
					</tr>
				 <?php } ?>
				<tr class="">
					<td colspan="2" class="act">
					</td>
				</tr>
		</form>