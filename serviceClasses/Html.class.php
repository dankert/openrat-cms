<?php

/**
 * Bereitstellen von Methoden fuer die Darstellung von HTML-Elementen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Html
{
	function selectBox( $name,$values,$default='',$params=Array() )
	{
		$src = '<select size="1" name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';

		foreach( $values as $key=>$value )
		{
			$src .= '<option value="'.$key.'"';
			if ($key == $default)
				$src .= ' selected="selected"';
			$src .= '>'.$value.'</option>';
		}
		$src .= '</select>';

		return $src;
	}


	function checkBox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';

		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";

		if	( !$writable )
			$src .= ' disabled="disabled"';

		if	( $value )
			$src .= ' checked="checked"';

		$src .= ' />';

		return $src;
	}


	function url( $params )
	{
		global $conf;

		$fake_urls = $conf['interface']['fake_urls'];
		
		if	( isset($params['callAction']) )
		{
			$params['subaction'] = $params['callAction']; 
			unset( $params['callAction'] );
			unset( $params['callSubaction'] );
		}

		if	( isset($params['objectid']) && !isset($params['id']) )
			$params['id'] = $params['objectid']; 


		if	( $fake_urls )
		{		
			if	( !isset($params['action'   ])) $params['action'   ] = '';
			if	( !isset($params['subaction'])) $params['subaction'] = '';
			if	( !isset($params['id'       ])) $params['id'       ] = '';
			$action    = $params['action'   ];
			$subaction = $params['subaction'];
			$id        = $params['id'       ];
			unset( $params['action'   ] );
			unset( $params['subaction'] );
			unset( $params['id'       ] );

			if	( $id != '' )
				$id = '.'.$id;
		}

		if	( count($params) > 0 )
		{		
			$urlParameterList = array();
			foreach( $params as $var=>$value )
			{
				$urlParameterList[] = urlencode($var).'='.urlencode($value);
			}
			$urlParameter = '?'.implode('&amp;',$urlParameterList);
		}
		else
		{
			$urlParameter = '';
		}
		
		if	( $fake_urls )
			return $action.','.$subaction.$id.$urlParameter;
		else
			return 'do.php'.$urlParameter;
	}


	function form( $params )
	{
		if	( !isset($params['target'   ])) $params['target'   ] = '_self';
		if	( !isset($params['action'   ])) $params['action'   ] = '';
		if	( !isset($params['subaction'])) $params['subaction'] = '';
		if	( !isset($params['id'       ])) $params['id'       ] = '';

		$text = '<form name="'.$params['name'].'" target="'.$params['target'].'" action="'.Html::url($params).'" method="post" />'."\n";
		$text.= '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";

		return $text;
	}


	function focusField( $name )
	{
		echo '<script name="JavaScript" type="text/javascript"><!--'."\n";
		echo 'document.forms[0].'.$name.'.focus();'."\n";
		echo '//--></script>'."\n";
	}
}
?>