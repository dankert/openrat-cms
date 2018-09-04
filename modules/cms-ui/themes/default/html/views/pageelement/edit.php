
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="pageelement" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_languageid" name="languageid<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$languageid) ?>" /><?php if ('') { ?><input type="hidden" name="languageid" value="<?php $languageid ?>"/><?php } ?></div>
			
			<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_elementid" name="elementid<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$elementid) ?>" /><?php if ('') { ?><input type="hidden" name="elementid" value="<?php $elementid ?>"/><?php } ?></div>
			
			<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_value_time" name="value_time<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$value_time) ?>" /><?php if ('') { ?><input type="hidden" name="value_time" value="<?php $value_time ?>"/><?php } ?></div>
			
			
				<span class="help"><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
				
				<?php $if4=($type=='date'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('calendar') ?></legend><div>
						<div>
							<table class="calendar" width="85%">
								<tr>
									<td colspan="8" class="help">
										<a target="_self" data-url="<?php echo $lastmonthurl ?>" data-action="" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
											<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/left.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($monthname))); ?></strong>
										
										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $nextmonthurl ?>" data-action="" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
											<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/right.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $lastyearurl ?>" data-action="" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
											<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/left.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($yearname))); ?></strong>
										
										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $nextyearurl ?>" data-action="" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
											<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/right.png" />
											
										</a>

									</td>
								</tr>
								<tr>
									<td>
										<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'week'.'')))); ?></span>
										
									</td>
									<?php foreach($weekdays as $list_key=>$weekday){ ?>
										<td>
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities($weekday))); ?></span>
											
										</td>
									<?php } ?>
								</tr>
								<?php foreach($weeklist as $weeknr=>$week){ ?>
									<tr>
										<td width="12%">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities($weeknr))); ?></span>
											
										</td>
										<?php foreach($week as $list_key=>$list_value){ ?><?php extract($list_value) ?>
											<td width="12%">
												<?php $if12=(empty($url)); if($if12){?>
													<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
													
													<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($nr))); ?></strong>
													
													<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
													
												<?php } ?>
												<?php $if12=!(empty($url)); if($if12){?>
													<a target="_self" data-url="<?php echo $url ?>" data-action="" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
														<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
														
														<span class="text"><?php echo nl2br(encodeHtml(htmlentities($nr))); ?></span>
														
														<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
														
													</a>

												<?php } ?>
												<?php $if12=($today); if($if12){?>
													<span class="text"><?php echo nl2br('*'); ?></span>
													
												<?php } ?>
											</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div></fieldset>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('date') ?></legend><div>
						<div>
							<label for="<?php echo REQUEST_ID ?>_year" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'date'.'')))); ?></span>
								
							</label>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_year" name="year" title="" class=""<?php if (count($all_years)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_years,$year,0,0) ?><?php if (count($all_years)==0) { ?><input type="hidden" name="year" value="" /><?php } ?><?php if (count($all_years)==1) { ?><input type="hidden" name="year" value="<?php echo array_keys($all_years)[0] ?>" /><?php } ?>
							</select></div>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_month" name="month" title="" class=""<?php if (count($all_months)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_months,$month,0,0) ?><?php if (count($all_months)==0) { ?><input type="hidden" name="month" value="" /><?php } ?><?php if (count($all_months)==1) { ?><input type="hidden" name="month" value="<?php echo array_keys($all_months)[0] ?>" /><?php } ?>
							</select></div>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_day" name="day" title="" class=""<?php if (count($all_days)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_days,$day,0,0) ?><?php if (count($all_days)==0) { ?><input type="hidden" name="day" value="" /><?php } ?><?php if (count($all_days)==1) { ?><input type="hidden" name="day" value="<?php echo array_keys($all_days)[0] ?>" /><?php } ?>
							</select></div>
						</div>
						<div>
							<label for="<?php echo REQUEST_ID ?>_hour" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'date_time'.'')))); ?></span>
								
							</label>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_hour" name="hour" title="" class=""<?php if (count($all_hours)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_hours,$hour,0,0) ?><?php if (count($all_hours)==0) { ?><input type="hidden" name="hour" value="" /><?php } ?><?php if (count($all_hours)==1) { ?><input type="hidden" name="hour" value="<?php echo array_keys($all_hours)[0] ?>" /><?php } ?>
							</select></div>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_minute" name="minute" title="" class=""<?php if (count($all_minutes)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_minutes,$minute,0,0) ?><?php if (count($all_minutes)==0) { ?><input type="hidden" name="minute" value="" /><?php } ?><?php if (count($all_minutes)==1) { ?><input type="hidden" name="minute" value="<?php echo array_keys($all_minutes)[0] ?>" /><?php } ?>
							</select></div>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_second" name="second" title="" class=""<?php if (count($all_seconds)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($all_seconds,$second,0,0) ?><?php if (count($all_seconds)==0) { ?><input type="hidden" name="second" value="" /><?php } ?><?php if (count($all_seconds)==1) { ?><input type="hidden" name="second" value="<?php echo array_keys($all_seconds)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='text'); if($if4){?>
					<tr>
						<td colspan="2">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_text" name="text<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="text" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if ('') { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?></div>
							
						</td>
					</tr>
				<?php } ?>
				<?php $if4=($type=='longtext'); if($if4){?>
					<?php $if5=(isset($preview)); if($if5){?>
						<div class="preview">
							<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('page_preview') ?></legend><div>
								<span class="text"><?php echo nl2br($preview); ?></span>
								
							</div></fieldset>
						</div>
					<?php } ?>
					<?php $if5=($editor=='markdown'); if($if5){?>
						<textarea name="text" class="editor markdown-editor"><?php echo ${'text'} ?></textarea>
						
					<?php } ?>
					<?php $if5=($editor=='html'); if($if5){?>
						<textarea name="text" class="editor html-editor" id="pageelement_edit_editor"><?php echo ${'text'} ?></textarea>
						
					<?php } ?>
					<?php $if5=($editor=='wiki'); if($if5){?>
						<?php $if6=(isset($languagetext)); if($if6){?>
							<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $languagename ?></legend><div>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagetext))); ?></span>
								
							</div></fieldset>
							<br/>
							
							<br/>
							
						<?php } ?>
						<textarea name="text" class="editor wiki-editor"><?php echo ${'text'} ?></textarea>
						
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('help') ?></legend><div>
							<table width="100%">
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','strong-begin')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_strong'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','strong-end')))); ?></span>
									
									<br/>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','emphatic-begin')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_emphatic'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','emphatic-end')))); ?></span>
									
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-numbered')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_numbered_list'.'')))); ?></span>
									
									<br/>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-numbered')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<br/>
									
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_unnumbered_list'.'')))); ?></span>
									
									<br/>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<br/>
									
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_table'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<br/>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
									
									<br/>
									
								</td>
							</table>
						</div></fieldset>
					<?php } ?>
					<?php $if5=($editor=='text'); if($if5){?>
						<div class="inputholder"><textarea class="editor raw-editor" name="text"><?php echo Text::encodeHtml($text) ?></textarea></div>
						
						
						
					<?php } ?>
				<?php } ?>
				<?php $if4=($type=='link'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
						<div class="line">
							<div class="label">
								<label for="<?php echo REQUEST_ID ?>_linkobjectid" class="label">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_target'.'')))); ?></span>
									
								</label>
							</div>
							<div class="input">
								<div class="selector">
<div class="inputholder">
<input type="hidden" name="linkobjectid" value="{id}" />
<input type="text" disabled="disabled" value="{name}" />
</div>
<div class="tree selector" data-types="{types}" data-init-id="<?php echo $linkobjectid ?>" data-init-folderid="<?php echo $rootfolderid ?>">
								
							</div>
						</div>
						<div class="line">
							<div class="label">
								<label for="<?php echo REQUEST_ID ?>_link_url" class="label">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_url'.'')))); ?></span>
									
								</label>
							</div>
							<div class="input">
								<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_linkurl" name="linkurl<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$linkurl) ?>" /><?php if ('') { ?><input type="hidden" name="linkurl" value="<?php $linkurl ?>"/><?php } ?></div>
								
							</div>
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='list'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
						<div>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
							</select></div>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='insert'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
						<div>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
							</select></div>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='number'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
						<div>
							<input type="hidden" name="decimals" value="decimals"/>
							
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_number" name="number<?php if ('') echo '_disabled' ?>" type="text" maxlength="20" class="text" value="<?php echo Text::encodeHtml(@$number) ?>" /><?php if ('') { ?><input type="hidden" name="number" value="<?php $number ?>"/><?php } ?></div>
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='select'); if($if4){?>
					<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
						<div>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_text" name="text" title="" class=""<?php if (count($items)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($items,$text,0,0) ?><?php if (count($items)==0) { ?><input type="hidden" name="text" value="" /><?php } ?><?php if (count($items)==1) { ?><input type="hidden" name="text" value="<?php echo array_keys($items)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='longtext'); if($if4){?>
					<?php $if5=($editor=='wiki'); if($if5){?>
						<?php $if6=(isset($languages)); if($if6){?>
							<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('editor_show_language') ?></legend><div>
								<div>
									<?php foreach($languages as $languageid=>$languagename){ ?>
										<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_otherlanguageid_<?php echo $languageid ?>" name="otherlanguageid" value="<?php echo $languageid ?>"<?php if($languageid==@$otherlanguageid)echo ' checked="checked"' ?> />
										
										<label for="<?php echo REQUEST_ID ?>_<?php echo 'otherlanguageid_'.$languageid.'' ?>" class="label">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
											
										</label>
										<br/>
										
									<?php } ?>
								</div>
							</div></fieldset>
						<?php } ?>
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PAGE_PREVIEW') ?></legend><div>
							<div>
								<?php { $tmpname     = 'preview';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
								
								<label for="<?php echo REQUEST_ID ?>_preview" class="label">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'PAGE_PREVIEW'.'')))); ?></span>
									
								</label>
							</div>
						</div></fieldset>
					<?php } ?>
				<?php } ?>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
					<?php $if5=(isset($release)); if($if5){?>
						<div>
							<?php { $tmpname     = 'release';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
							<label for="<?php echo REQUEST_ID ?>_release" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_RELEASE')))); ?></span>
								
							</label>
						</div>
					<?php } ?>
					<?php $if5=(isset($publish)); if($if5){?>
						<div>
							<?php { $tmpname     = 'publish';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
							<label for="<?php echo REQUEST_ID ?>_publish" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_PUBLISH_AFTER_SAVE')))); ?></span>
								
							</label>
						</div>
					<?php } ?>
				</div></fieldset>
			
		<div class="bottom"><div class="command yes"><input type="submit" class="submit ok" value="<?php echo lang('save') ?>" /></div></div></form>
	