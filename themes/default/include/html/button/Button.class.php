<?php

class ButtonComponent extends Component {

public function begin( $attr ) {

	extract( $attr,EXTR_PREFIX_ALL,'attr');
	echo <<<'HTML'
		<div class="invisible">
HTML;

		if ($attr_type == 'ok')
			$attr_type = 'submit';

		if (!empty($attr_src))
	{
			$attr_type    = 'image';
			$attr_tmp_src = $image_dir.'icon_'.$attr_src.IMG_ICON_EXT;
		}
		else
		{
			$attr_tmp_src  = '';
		}
		
		if	( !empty($attr_type)) { 
	?>
	<input type="<?php echo $attr_type ?>"<?php if(isset($attr_src)) { ?> src="<?php $attr_tmp_src ?>"<?php } ?> name="<?php echo $attr_value ?>" class="%class%" title="<?php echo lang($attr_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr_src); ?>
	<?php }

    }

	public function end() {
	    echo"</div>";
	}
}

?>