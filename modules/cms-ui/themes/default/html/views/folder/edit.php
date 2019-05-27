
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="headline">
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TYPE'.'')))); ?></span>
					
				</th>
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
					
				</th>
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LASTCHANGE'.'')))); ?></span>
					
				</th>
			</tr>
			<?php $if3=(isset($up_url)); if($if3){?>
				<tr class="data clickable">
					<td>
						<a target="_self" date-name="" name="" data-type="open" data-action="folder" data-method="edit" data-id="<?php echo $parentid ?>" data-extra="[]" href="<?php echo Html::url('folder','',$parentid,array()) ?>">
							<i class="image-icon image-icon--action-folder"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities('..'))); ?></span>
							
						</a>

					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data clickable">
					<td>
						<i class="image-icon image-icon--action-<?php echo $icon ?>"></i>
						
					</td>
					<td>
						<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="edit" data-id="<?php echo $id ?>" data-extra="[]" href="<?php echo Html::url($type,'',$id,array()) ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
						</a>

					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(($object)==FALSE); if($if3){?>
				<tr>
					<td colspan="2">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
		<div class="clickable">
			<a class="or-link-btn" target="_self" data-type="dialog" data-action="folder" data-method="create" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'folder','dialogMethod':'create'}" href="<?php echo Html::url('folder','create','',array('dialogAction'=>'folder','dialogMethod'=>'create')) ?>">
				<i class="image-icon image-icon--action-new"></i>
				
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'new'.'')))); ?></span>
				
			</a>

		</div>
	