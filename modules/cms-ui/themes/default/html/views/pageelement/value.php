<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form pageelement" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="value" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="languageid" value="<?php echo $languageid ?>"/>
			
			<input type="hidden" name="elementid" value="<?php echo $elementid ?>"/>
			
			<input type="hidden" name="value_time" value="<?php echo $value_time ?>"/>
			
			<span class="help"><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
			
			<?php $if3=($type=='date'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('date') ?></legend><div class="closable">
					<div class="line">
						<label class="or-form-row"><span class="or-form-label"><?php echo lang('date') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_date" name="<?php if ('') echo ''.'_' ?>date<?php if (false) echo '_disabled' ?>" type="date" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$date) ?>" /><?php if (false) { ?><input type="hidden" name="date" value="<?php $date ?>"/><?php } ?></div></span></label>
						
						<label class="or-form-row"><span class="or-form-label"><?php echo lang('time') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_time" name="<?php if ('') echo ''.'_' ?>time<?php if (false) echo '_disabled' ?>" type="time" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$time) ?>" /><?php if (false) { ?><input type="hidden" name="time" value="<?php $time ?>"/><?php } ?></div></span></label>
						
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='text'); if($if3){?>
				<tr>
					<td colspan="2">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_text" name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" type="text" maxlength="255" class="text" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if (false) { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?></div>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=($type=='longtext'); if($if3){?>
				<input type="hidden" name="format" value="<?php echo $format ?>"/>
				
				<?php $if4=(isset($preview)); if($if4){?>
					<div class="preview">
						<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('page_preview') ?></legend><div class="closable">
							<span><?php echo nl2br($preview); ?></span>
							
						</div></fieldset>
					</div>
				<?php } ?>
				<?php $if4=($editor=='markdown'); if($if4){?>
					<textarea  name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" class="editor markdown-editor"><?php echo htmlentities(${'text'}) ?></textarea>
					
				<?php } ?>
				<?php $if4=($editor=='html'); if($if4){?>
					<textarea  name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" class="editor html-editor" id="pageelement_edit_editor"><?php echo ${'text'} ?></textarea>
					
				<?php } ?>
				<?php $if4=($editor=='wiki'); if($if4){?>
					<?php $if5=(isset($languagetext)); if($if5){?>
						<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $languagename ?></legend><div class="closable">
							<span><?php echo nl2br(encodeHtml(htmlentities($languagetext))); ?></span>
							
						</div></fieldset>
						<br/>
						
						<br/>
						
					<?php } ?>
					<textarea  name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" class="editor wiki-editor"><?php echo ${'text'} ?></textarea>
					
					<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('help') ?></legend><div class="closable">
						<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','strong-begin')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_strong'.'')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','strong-end')))); ?></span>
								
								<br/>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','emphatic-begin')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_emphatic'.'')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','emphatic-end')))); ?></span>
								
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-numbered')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_numbered_list'.'')))); ?></span>
								
								<br/>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-numbered')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<br/>
								
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_unnumbered_list'.'')))); ?></span>
								
								<br/>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<br/>
								
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_table'.'')))); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<br/>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<span><?php echo nl2br('...'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep')))); ?></span>
								
								<br/>
								
							</td>
						</table></div></div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($editor=='text'); if($if4){?>
					<div class="inputholder"><textarea class="editor raw-editor" name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($text) ?></textarea></div>
					
					
					
				<?php } ?>
			<?php } ?>
			<?php $if3=($type=='link'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_linkobjectid" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_target'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="selector">
<div class="inputholder or-droppable">
<input type="hidden" class="or-selector-link-value" name="linkobjectid" value="<?php echo $linkobjectid ?>" />
<input type="text" class="or-selector-link-name" value="<?php echo $linkname ?>" placeholder="<?php echo $linkname ?>" />
</div>
<div class="dropdown"></div>
<div class="tree selector" data-types="{types}" data-init-id="<?php echo $linkobjectid ?>" data-init-folderid="<?php echo $rootfolderid ?>">
</div>
</div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_link_url" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_url'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_linkurl" name="<?php if ('') echo ''.'_' ?>linkurl<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$linkurl) ?>" /><?php if (false) { ?><input type="hidden" name="linkurl" value="<?php $linkurl ?>"/><?php } ?></div>
							
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='list'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
					<div>
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
						</select></div>
						
						
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='insert'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
					<div>
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
						</select></div>
						
						
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='number'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
					<div>
						<input type="hidden" name="decimals" value="decimals"/>
						
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_number" name="<?php if ('') echo ''.'_' ?>number<?php if (false) echo '_disabled' ?>" type="text" maxlength="20" class="" value="<?php echo Text::encodeHtml(@$number) ?>" /><?php if (false) { ?><input type="hidden" name="number" value="<?php $number ?>"/><?php } ?></div>
						
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='select'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
					<div>
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_text" name="text" title="" class=""<?php if (count($items)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($items,$text,0,0) ?><?php if (count($items)==0) { ?><input type="hidden" name="text" value="" /><?php } ?><?php if (count($items)==1) { ?><input type="hidden" name="text" value="<?php echo array_keys($items)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php $if3=($type=='longtext'); if($if3){?>
				<?php $if4=($editor=='wiki'); if($if4){?>
					<?php $if5=(isset($languages)); if($if5){?>
						<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('editor_show_language') ?></legend><div class="closable">
							<div>
								<?php foreach($languages as $languageid=>$languagename){ ?>
									<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_otherlanguageid_<?php echo $languageid ?>" name="<?php if ('') echo ''.'_' ?>otherlanguageid<?php if (false) echo '_disabled' ?>" value="<?php echo $languageid ?>"<?php if($languageid==@$otherlanguageid)echo ' checked="checked"' ?> />
									
									<label for="<?php echo REQUEST_ID ?>_<?php echo 'otherlanguageid_'.$languageid.'' ?>" class="label">
										<span><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
										
									</label>
									<br/>
									
								<?php } ?>
							</div>
						</div></fieldset>
					<?php } ?>
					<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PAGE_PREVIEW') ?></legend><div class="closable">
						<div>
							<?php { $tmpname     = 'preview';$default  = false;$readonly = false;$required = false;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
							<label for="<?php echo REQUEST_ID ?>_preview" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'PAGE_PREVIEW'.'')))); ?></span>
								
							</label>
						</div>
					</div></fieldset>
				<?php } ?>
			<?php } ?>
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
				<?php $if4=(isset($release)); if($if4){?>
					<div>
						<?php { $tmpname     = 'release';$default  = false;$readonly = false;$required = false;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_release" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_RELEASE')))); ?></span>
							
						</label>
					</div>
				<?php } ?>
				<?php $if4=(isset($publish)); if($if4){?>
					<div>
						<?php { $tmpname     = 'publish';$default  = false;$readonly = false;$required = false;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_publish" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_PUBLISH_AFTER_SAVE')))); ?></span>
							
						</label>
					</div>
				<?php } ?>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('save') ?>" /></div></form>
	