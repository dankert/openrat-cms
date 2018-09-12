
	
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LANGUAGE_ISOCODE'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/language.svg" />
						
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="language" data-method="show" data-id="<?php echo $id ?>" data-extra="[]" href="<?php echo Html::url('language','',$id,array()) ?>">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($isocode))); ?></span>
						
					</td>
					<?php $if5=(isset($default_url)); if($if5){?>
						<td class="clickable">
							<a target="_self" data-type="post" data-action="language" data-method="setdefault" data-id="<?php echo $id ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;language&quot;,&quot;subaction&quot;:&quot;setdefault&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_make_default')))); ?></span>
								
							</a>

						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td>
							<em class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_is_default')))); ?></em>
							
						</td>
					<?php } ?>
					<?php $if5=(isset($select_url)); if($if5){?>
						<td class="clickable">
							<a target="_self" data-type="post" data-action="start" data-method="language" data-id="<?php echo $id ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;language&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_select')))); ?></span>
								
							</a>

						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td>
							<em class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_selected')))); ?></em>
							
						</td>
					<?php } ?>
				</tr>
				<?php unset($select_url) ?>
				
				<?php unset($default_url) ?>
				
			<?php } ?>
			<tr class="data">
				<td colspan="4" class="clickable">
					<a target="_self" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="<?php echo Html::url('','add','',array('dialogAction'=>'','dialogMethod'=>'add')) ?>">
						<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	