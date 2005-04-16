<?php


// Ausgabe CSS-Klasse pro Zeile
function fx( $fx )
{
	if   ( $fx == 'f1' )
		return 'f2';
	else return 'f1';
}



function windowOpen( $title,$colSpan=2,$icon='',$attr=array() )
{
	global $image_dir;
	if	( !isset($attr['width'])) $attr['width']='90%';
	echo '<center>';
	echo '<table style="margin:20px;" cellspacing="0" cellpadding="0"';
	foreach( $attr as $aName=>$aValue )
		echo " $aName=\"$aValue\"";
	echo '>';
	echo '<tr><td colspan="2" rowspan="2">';
	echo '<table class="main" cellspacing="0" width="100%" cellpadding="4">';
	echo '<tr><th colspan="'.intval($colSpan).'">';
	if	( !empty($icon) )
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_EXT.'" align="left" border="0">';
	echo lang( $title ).'</th></tr>';
}

function windowClose()
{
	echo '<tr><td>&nbsp;</td></tr>';
	echo '</table>';
	echo '</td><td style="width:5px;height:5px;"></td></tr>';	
	echo '<tr><td rowspan="2" style="background-color:grey; width:5px;"></td></tr>';
	echo '<tr><td style="width:5px;height:5px;"></td><td style="background-color:grey; height:5px;"></td></tr>';
	echo '</table>';

	echo '</center>';
}

?>