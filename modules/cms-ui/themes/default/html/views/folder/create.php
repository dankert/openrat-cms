
	
		<div class="or-linklist">
			<?php $if3=($mayCreateFolder); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="<?php echo Html::url('','createfolder','',array('dialogAction'=>'','dialogMethod'=>'createfolder')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfolder'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreatePage); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="<?php echo Html::url('','createpage','',array('dialogAction'=>'','dialogMethod'=>'createpage')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createpage'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreateFile); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="<?php echo Html::url('','createfile','',array('dialogAction'=>'','dialogMethod'=>'createfile')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfile'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreateImage); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="<?php echo Html::url('','createimage','',array('dialogAction'=>'','dialogMethod'=>'createimage')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createimage'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreateText); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="<?php echo Html::url('','createtext','',array('dialogAction'=>'','dialogMethod'=>'createtext')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createltext'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreateUrl); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="<?php echo Html::url('','createurl','',array('dialogAction'=>'','dialogMethod'=>'createurl')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createurl'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
			<?php $if3=($mayCreateLink); if($if3){?>
				<div class="clickable or-linklist-line or-round-corners or-hover-effect">
					<a target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="<?php echo Html::url('','createlink','',array('dialogAction'=>'','dialogMethod'=>'createlink')) ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createlink'.'')))); ?></span>
						
					</a>

				</div>
			<?php } ?>
		</div>
	