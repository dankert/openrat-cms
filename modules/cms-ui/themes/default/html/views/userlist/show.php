
	
		
		
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="headline">
				<td>
					<imgsrc="./modules/cms-ui/themes/default/images/icon_user.png" />
					
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td data-name="<?php echo $name ?>" data-action="user" data-id="<?php echo $id ?>" class="clickable clickable">
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="user" data-method="show" data-id="<?php echo $id ?>" data-extra="[]" href="<?php echo Html::url('user','',$id,array()) ?>">
							<i class="image-icon image-icon--action-user"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
					<td data-name="<?php echo $name ?>" data-action="user" data-id="<?php echo $id ?>" class="clickable">
						<span><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
						
						<?php $if6=($isAdmin); if($if6){?>
							<span><?php echo nl2br('&nbsp;('); ?></span>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_ADMIN'.'')))); ?></span>
							
							<span><?php echo nl2br(')'); ?></span>
							
						<?php } ?>
					</td>
					<td class="clickable">
						<a target="_self" data-type="post" data-action="user" data-method="switch" data-id="<?php echo $userid ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;user&quot;,&quot;subaction&quot;:&quot;switch&quot;,&quot;id&quot;:&quot;<?php echo $userid ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="3" class="clickable">
					<a target="_self" date-name="<?php echo lang('add') ?>" name="<?php echo lang('add') ?>" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="<?php echo Html::url('','add','',array('dialogAction'=>'','dialogMethod'=>'add')) ?>">
						<imgsrc="./modules/cms-ui/themes/default/images/icon/add.png" />
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	