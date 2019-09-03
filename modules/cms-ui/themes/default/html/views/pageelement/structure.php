
	
		<?php $if2=(isset($text)); if($if2){?>
			<div class="structure">
				<?php $doc = new DocumentElement();$tmp_text = $text;if( !is_array($tmp_text))$tmp_text = explode("\n",$tmp_text);$doc->parse($tmp_text);echo $doc->render('application/html-dom');?>
				
			</div>
		<?php } ?>
	