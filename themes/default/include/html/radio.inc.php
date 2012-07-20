<?php
		if ($this->isEditable() && !$this->isEditMode()) $attr_readonly=true;
		
		if	( isset($$attr_name)  )
			$attr_tmp_default = $$attr_name;
		elseif ( isset($attr_default) )
			$attr_tmp_default = $attr_default;
		else
			$attr_tmp_default = '';

 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $attr_name.'_'.$attr_value ?>"  name="<?php echo $attr_prefix.$attr_name ?>"<?php if ( $attr_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr_value ?>"<?php if($attr_value==$attr_tmp_default||@$attr_checked) echo ' checked="checked"' ?><?php if (in_array($attr_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />

<?php /* #IF-ATTR deactivated-children# */ ?>
<script name="Javascript" type="text/javascript">
<!--
<?php foreach(explode(',',$attr_children) as $attr_tmp_child) { if (empty($attr_tmp_child)) continue; ?>
var e = document.getElementById('id_<?php echo $attr_tmp_child ?>');
e.disabled = true;
<?php } ?>

function <?php echo $attr_name.'_'.$attr_value ?>_valueChanged(element)
{
	for(i=0; i<document.forms[0].elements.length; i++)
		if (document.forms[0].elements[i].type == 'text')
			document.forms[0].elements[i].disabled = true;
	<?php foreach(explode(',',$attr_children) as $attr_tmp_child) { if (empty($attr_tmp_child)) continue; ?>
	var e = document.getElementById('id_<?php echo $attr_tmp_child ?>');
	e.disabled = false;
	<?php } ?>
}
//-->
</script>
<?php /* #END-IF# */ ?>