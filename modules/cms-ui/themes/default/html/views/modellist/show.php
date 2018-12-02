
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="model" data-method="show" data-id="<?php echo $id ?>" data-extra="[]" href="<?php echo Html::url('model','',$id,array()) ?>">
							<i class="image-icon image-icon--action-model"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

					</td>
					<?php $if5=(!$is_default); if($if5){?>
						<td class="clickable">
							<?php $if7=(isset($id)); if($if7){?>
								<a target="_self" data-type="post" data-action="model" data-method="setdefault" data-id="<?php echo $id ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;model&quot;,&quot;subaction&quot;:&quot;setdefault&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_make_default')))); ?></span>
									
								</a>

							<?php } ?>
						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td>
							<em><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_is_default')))); ?></em>
							
						</td>
					<?php } ?>
				</tr>
				<?php unset($select_url) ?>
				
				<?php unset($default_url) ?>
				
			<?php } ?>
			<tr class="data">
				<td colspan="2" class="clickable">
					<a target="_self" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="<?php echo Html::url('','add','',array('dialogAction'=>'','dialogMethod'=>'add')) ?>">
						<i class="image-icon image-icon--method-add"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	