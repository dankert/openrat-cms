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
	/**
	 * Erzeugt eine HTML-Dropdown-Box
	 *
	 * @param Name des Feldes
	 * @param Inhalte als assoziatives Array
	 * @param Vorbelegter Inhalt
	 * @param Weitere Parameter
	 */
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



	/**
	 * Erzeugt eine HTML-Checkbox zum Ankreuzen
	 *
	 * @param Name des Feldes
	 * @param boolean, ob Feld angekreuzt ist (default=nein)
	 * @param boolean, ob Feld offen ist      (default=ja)
	 * @param Weitere Parameter
	 */
	function checkBox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';

		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";

		if	( !$writable )
			$src .= ' disabled="disabled"';

		if	( $value )
			$src .= ' value="1" checked="checked"';

		$src .= ' />';

		return $src;
	}


	/**
	 * Erzeugt eine relative Url innerhalb von Openrat
	 *
	 * @param Aktion, die aufgerufen werden soll
	 * @param Unteraktion, die innerhalb der Aktion aufgerufen werden soll
	 * @param Id fuer diesen Aufruf
	 * @param Weitere beliebige Parameter
	 */
	function url( $action,$subaction='',$id='',$params=array() )
	{
		if	( intval($id)==0 )
			$id='-';

		global $conf;
		
		if	( is_array($action) )
		{
			$params = $action;

			if	( isset($params['callAction']) )
			{
				$params['subaction'] = $params['callAction']; 
				unset( $params['callAction'] );
				unset( $params['callSubaction'] );
			}
	

			if	( !isset($params['action'   ])) $params['action'   ] = '';
			if	( !isset($params['subaction'])) $params['subaction'] = '';
			if	( !isset($params['id'       ])) $params['id'       ] = '';
			$action    = $params['action'   ];
			$subaction = $params['subaction'];
			$id        = $params['id'       ];
			unset( $params['action'   ] );
			unset( $params['subaction'] );
			unset( $params['id'       ] );
			$params['old']='true';
		}

		// Session-Id ergaenzen
		if	( $conf['interface']['url_sessionid'] )
			$params[ session_name() ] = session_id();

		$fake_urls = $conf['interface']['nice_urls'];
		
		if	( isset($params['objectid']) && !isset($params['id']) )
			$params['id'] = $params['objectid']; 

		if	( $fake_urls )
		{
			if	( $id != '' )
				$id = '.'.$id;
		}
		else
		{
			$params[REQ_PARAM_ACTION   ] = $action;
			$params[REQ_PARAM_SUBACTION] = $subaction;
			$params[REQ_PARAM_ID       ] = $id;
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
			return './'.$action.','.$subaction.$id.$urlParameter;
		else
			return './'.'do.php'.$urlParameter;
	}



	/**
	  * Erstellt den Beginn eines HTML-Formulares
	  *
	  * @param Parameter
	  */
	function form( $action,$subaction='',$id='-',$params=array())
	{
		global $conf;
		extract( $params );

		if	( !isset($target  ) )  $target  = '_self';
		if	( !isset($method  ) )  $method  = 'post';
		if	( !isset($name    ) )  $name    = '';
		if	( !isset($enctype ) )  $enctype = '';

		unset( $params['name'     ]);
		unset( $params['method'   ]);
		unset( $params['target'   ]);
		unset( $params['enctype'  ]);

		$url = Html::url( $action,$subaction,$id );

		$text = '<form name="'.$name.'" target="'.$target.'" action="'.$url.'" method="'.$method.'" enctype="'.$enctype.'" >'."\n";

		$text.= '<input type="hidden" name="'.REQ_PARAM_ACTION.'" value="'.$action.'" />'."\n";
		$text.= '<input type="hidden" name="'.REQ_PARAM_SUBACTION.'" value="'.$subaction.'" />'."\n";
		$text.= '<input type="hidden" name="'.REQ_PARAM_ID.'" value="'.$id.'" />'."\n";

		if	( $conf['interface']['url_sessionid'] )
			$text.= '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";

		foreach( $params as $paramName=>$paramValue )
			$text.= '<input type="hidden" name="'.$paramName.'" value="'.$paramValue.'" />'."\n";

		return $text;
	}



	/**
	 * Setzt den Cursor beim Laden der Seite in ein definiertes Formularfeld
	 *
	 * @param Name des Feldes
	 */ 
	function focusField( $name )
	{
		echo '<script name="JavaScript" type="text/javascript"><!--'."\n";
		echo 'document.forms[0].'.$name.'.focus();'."\n";
		echo '//--></script>'."\n";
	}
}
?>