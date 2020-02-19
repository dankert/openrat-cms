<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
			<tr class="headline">
				<td class="help">
					<input type="checkbox" name="checkall" value="1" <?php if(''.@$checkall.''){ ?>checked="1"<?php } ?> class="">
					</input>
				</td>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
					</span>
					<span class=""> / 
					</span>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
					</span>
				</td>
			</tr>
			<?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
				<tr class="data">
					<td width="1%" class="">
						<?php $if7=($writable); if($if7) {  ?>
							<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$id)) ?>" value="1" <?php if(''.@$${id.'}'){ ?>checked="1"<?php } ?> class="">
							</input>
						 <?php } ?>
						<?php $if7=(!'writable'); if($if7) {  ?>
							<span class=""> 
							</span>
						 <?php } ?>
					</td>
					<td class="clickable">
						<label class="label">
							<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>" class="">
								<i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$icon)) ?>">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
								</span>
								<span class=""> 
								</span>
							</a>
						</label>
					</td>
				</tr>
			 <?php } ?>
			<?php $if4=(($object)==FALSE); if($if4) {  ?>
				<tr class="">
					<td colspan="2" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
						</span>
					</td>
				</tr>
			 <?php } ?>
			<tr class="data">
				<td class="">
					<span class=""> 
					</span>
				</td>
				<td colspan="2" class="clickable">
					<a target="_self" data-type="dialog" data-action="folder" data-method="create" data-id="" data-extra="{'dialogAction':'folder','dialogMethod':'create'}" href="/#/folder/" class="">
						<i class="image-icon image-icon--method-add">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_folder_create'))) ?>
						</span>
					</a>
				</td>
			</tr>
		</table></div></div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<?php  { $type= $defaulttype; ?>
			 <?php } ?>
			<?php foreach($actionlist as $list_key=>$actiontype) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="radio" name="type" disabled="" value="<?php echo encodeHtml(htmlentities(@$actiontype)) ?>" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
						</input>
						<label class="label">
							<span class=""> 
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('${actiontype'))) ?>}
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<span class="">    
					</span>
					<input type="checkbox" name="confirm" value="1" <?php if(''.@$confirm.''){ ?>checked="1"<?php } ?> required="required" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('CONFIRM_DELETE'))) ?>
						</span>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('FOLDER_SELECT_TARGET_FOLDER'))) ?>
					</span>
				</div>
				<div class="input">
				</div>
			</div>
		</div></fieldset>
	</form>