
<!-- $Id$ -->
<select size="1" name="<?php echo $form_select_name ?>"<?php if ($form_select_onchange!='') echo " onchange=\"$form_select_onchange\"" ?>>
<?php foreach( $form_select_value as $k=>$v )
      { ?>
	<option value="<?php echo $k ?>"<?php if ($k==$form_select_default) echo ' selected' ?>><?php echo $v ?></option>
<?php } ?>
</select>
