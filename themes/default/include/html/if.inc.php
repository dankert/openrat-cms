<?php 

#IF-ATTR true#
	// Wahr-Vergleich
	if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
		$attr_tmp_exec = $$attr_true == true;
	else
		$attr_tmp_exec = $attr_true == true;
#END-IF#

#IF-ATTR false#
	if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
		$attr_tmp_exec = $$attr_false == false;
	else
		$attr_tmp_exec = $attr_false == false;
			
#END-IF#

#IF-ATTR contains#
	// Inhalt-Vergleich mit Wertliste
	$attr_tmp_exec = in_array($attr_value,explode(',',$attr_contains));
#END-IF#

#IF-ATTR equals#
	$attr_tmp_exec = $attr_equals == $attr_value;
#END-IF#
	
#IF-ATTR lessthan#
	// Inhalt-Vergleich
	$attr_tmp_exec = intval($attr_lessthan) > intval($attr_value);
#END-IF#

#IF-ATTR greaterthan#
	$attr_tmp_exec = intval($attr_greaterthan) < intval($attr_value);
#END-IF#

	
#IF-ATTR empty#
	if	( !isset($$attr_empty) )
		$attr_tmp_exec = empty($attr_empty);
	elseif	( is_array($$attr_empty) )
		$attr_tmp_exec = (count($$attr_empty)==0);
	elseif	( is_bool($$attr_empty) )
		$attr_tmp_exec = true;
	else
		$attr_tmp_exec = empty( $$attr_empty );
#END-IF#

		
#IF-ATTR present#
	$attr_tmp_exec = isset($$attr_present);
#END-IF#

	
#IF-ATTR invert#
	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr_invert) )
		$attr_tmp_exec = !$attr_tmp_exec;
#END-IF#
		
#IF-ATTR not#
		// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$attr_tmp_exec = !$attr_tmp_exec;
#END-IF#
		
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_equals);

	$last_exec = $attr_tmp_exec;
	
	if	( $attr_tmp_exec )
	{
?>

/* THIS LINE WILL BE IGNORED */ <?php } ?>