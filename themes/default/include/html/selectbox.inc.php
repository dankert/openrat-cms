<?php
if ($attr_addempty) $$attr_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr_list;
?><select id="id_<?php echo $attr_name ?>"  name="<?php echo $attr_name; if ($attr_multiple) echo '[]'; ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
if (count($$attr_list)<=1) echo ' disabled="disabled"';
if	($attr_multiple) echo ' multiple="multiple"';
if (in_array($attr_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr_size).'"';
?>><?php
		$attr_tmp_list = $$attr_list;
		if	( isset($$attr_name) && isset($attr_tmp_list[$$attr_name]) )
			$attr_tmp_default = $$attr_name;
		elseif ( isset($attr_default) )
			$attr_tmp_default = $attr_default;
		else
			$attr_tmp_default = '';
		
		foreach( $attr_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr_class.'" value="'.$box_key.'" title="'.$box_title.'"';
				
			if ($box_key==$attr_tmp_default)
				echo ' selected="selected"';

			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==0) echo '<input type="hidden" name="'.$attr_name.'" value="" />';
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>