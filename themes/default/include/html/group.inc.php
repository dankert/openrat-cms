<?php
?><fieldset class="<? echo $attr_open?'open':'' ?>"><?php if(isset($attr_title)) { ?><legend><?php if(isset($attr_icon)) { ?>&nbsp;&nbsp;<img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } if($attr_open) { ?><img src="<?php echo $image_dir.'icon/menu.gif' ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($attr_title) ?>&nbsp;&nbsp;</legend><?php } ?><div class="<?php echo $attr_open?'invisible':'' ?>">



<!-- Ignored: --></div></fieldset>