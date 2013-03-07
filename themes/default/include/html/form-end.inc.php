
<!-- Ignore: --><form>

<div class="bottom">
	<div class="command <?php echo $attr_tmp_visible?'visible':'invisible' ?>">
	
		<input type="button" class="submit ok" value="<?php echo $attr_tmp_ok_label ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->
		<?php if ($attr_tmp_show_cancel) { ?>
		<input type="button" class="submit cancel" value="<?php echo lang('CANCEL') ?>" onclick="$('div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />
		<?php } ?>
	</div>
</div>

</form>
