<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
		<input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" class="">
		</input>
		<input type="hidden" name="elementid" value="<?php echo encodeHtml(htmlentities(@$elementid)) ?>" class="">
		</input>
		<input type="hidden" name="value_time" value="<?php echo encodeHtml(htmlentities(@$value_time)) ?>" class="">
		</input>
		<span class="help"><?php echo encodeHtml(htmlentities(@$desc)) ?>
		</span>
		<?php $if3=($type=='date'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<label class="or-form-row or-form-input"><input name="date" disabled="" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$date)) ?>" class="">
					</input></label>
					<label class="or-form-row or-form-input"><input name="time" disabled="" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$time)) ?>" class="">
					</input></label>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='text'); if($if3) {  ?>
			<tr class="">
				<td colspan="2" class="">
					<input name="text" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" class="text">
					</input>
				</td>
			</tr>
		 <?php } ?>
		<?php $if3=($type=='longtext'); if($if3) {  ?>
			<input type="hidden" name="format" value="<?php echo encodeHtml(htmlentities(@$format)) ?>" class="">
			</input>
			<?php $if4=(isset($preview)); if($if4) {  ?>
				<div class="preview">
					<fieldset class="or-group toggle-open-close open show"><div class="closable">
						<span class=""><?php echo @$preview ?>
						</span>
					</div></fieldset>
				</div>
			 <?php } ?>
			<?php $if4=($editor=='markdown'); if($if4) {  ?>
				<textarea name="text" class="editor markdown-editor">
				</textarea>
			 <?php } ?>
			<?php $if4=($editor=='html'); if($if4) {  ?>
				<textarea name="text" id="pageelement_edit_editor" class="editor html-editor">
				</textarea>
			 <?php } ?>
			<?php $if4=($editor=='wiki'); if($if4) {  ?>
				<?php $if5=(isset($languagetext)); if($if5) {  ?>
					<fieldset class="or-group toggle-open-close open show"><div class="closable">
						<span class=""><?php echo encodeHtml(htmlentities(@$languagetext)) ?>
						</span>
					</div></fieldset>
					<br>
					</br>
					<br>
					</br>
				 <?php } ?>
				<textarea name="text" class="editor wiki-editor">
				</textarea>
				<fieldset class="or-group toggle-open-close closed show"><div class="closable">
					<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','strong-begin'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('text_markup_strong'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','strong-end'))) ?>
							</span>
							<br>
							</br>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','emphatic-begin'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('text_markup_emphatic'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','emphatic-end'))) ?>
							</span>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-numbered'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('text_markup_numbered_list'))) ?>
							</span>
							<br>
							</br>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-numbered'))) ?>
							</span>
							<span class="">...
							</span>
							<br>
							</br>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('text_markup_unnumbered_list'))) ?>
							</span>
							<br>
							</br>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','list-unnumbered'))) ?>
							</span>
							<span class="">...
							</span>
							<br>
							</br>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('text_markup_table'))) ?>
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class="">...
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class="">...
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<br>
							</br>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class="">...
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class="">...
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<span class="">...
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(config('editor','text-markup','table-cell-sep'))) ?>
							</span>
							<br>
							</br>
						</td>
					</table></div></div>
				</div></fieldset>
			 <?php } ?>
			<?php $if4=($editor=='text'); if($if4) {  ?>
				<textarea name="text" disabled="" maxlength="0" class="editor raw-editor"><?php echo encodeHtml(htmlentities(@$text)) ?>
				</textarea>
			 <?php } ?>
		 <?php } ?>
		<?php $if3=($type=='link'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('link_target'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('link_url'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<input name="linkurl" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$linkurl)) ?>" class="">
						</input>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='list'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="">
					<input name="linkobjectid" value="<?php echo encodeHtml(htmlentities(@$linkobjectid)) ?>" size="1" class="">
					</input>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='insert'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="">
					<input name="linkobjectid" value="<?php echo encodeHtml(htmlentities(@$linkobjectid)) ?>" size="1" class="">
					</input>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='number'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="">
					<input type="hidden" name="decimals" value="decimals" class="">
					</input>
					<input name="number" disabled="" type="text" maxlength="20" value="<?php echo encodeHtml(htmlentities(@$number)) ?>" class="">
					</input>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='select'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="">
					<input name="text" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" size="1" class="">
					</input>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php $if3=($type=='longtext'); if($if3) {  ?>
			<?php $if4=($editor=='wiki'); if($if4) {  ?>
				<?php $if5=(isset($languages)); if($if5) {  ?>
					<fieldset class="or-group toggle-open-close open show"><div class="closable">
						<div class="">
							<?php foreach($languages as $languageid=>$languagename) {  ?>
								<input type="radio" name="otherlanguageid" disabled="" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" checked="<?php echo encodeHtml(htmlentities(@$otherlanguageid)) ?>" class="">
								</input>
								<label class="label">
									<span class=""><?php echo encodeHtml(htmlentities(@$languagename)) ?>
									</span>
								</label>
								<br>
								</br>
							 <?php } ?>
						</div>
					</div></fieldset>
				 <?php } ?>
				<fieldset class="or-group toggle-open-close open show"><div class="closable">
					<div class="">
						<input type="checkbox" name="preview" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$preview)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('PAGE_PREVIEW'))) ?>
							</span>
						</label>
					</div>
				</div></fieldset>
			 <?php } ?>
		 <?php } ?>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<?php $if4=(isset($release)); if($if4) {  ?>
				<div class="">
					<input type="checkbox" name="release" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$release)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
						</span>
					</label>
				</div>
			 <?php } ?>
			<?php $if4=(isset($publish)); if($if4) {  ?>
				<div class="">
					<input type="checkbox" name="publish" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$publish)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
						</span>
					</label>
				</div>
			 <?php } ?>
		</div></fieldset>
	</form>