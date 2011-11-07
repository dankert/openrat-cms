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
	function error( $field )
	{
		global $inputErrors;

		if	( isset($inputErrors[$field]) )
			return '<span class="error">'.lang($inputErrors[$field]).'</span';
	}
	
	
	
	/**
	 * Ausgabe eines Variablenwertes.<br>
	 */
	function debug( $wert, $text='' )
	{
		echo "<strong>DEBUG: $text (".gettype($wert).")</strong><br/>";
		echo "<pre>";
		print_r($wert);
		echo "</pre>";		
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
		if	( $conf['interface']['url']['add_sessionid'] )
			$params[ session_name() ] = session_id();
			
		if	( config('security','use_post_token')  )
			$params[ 'token'] = token();

		$fake_urls  = $conf['interface']['url']['fake_url' ];
		$url_format = $conf['interface']['url']['url_format'];
		
		if	( isset($params['objectid']) && !isset($params['id']) )
			$params['id'] = $params['objectid']; 

		if	( $fake_urls )
		{
//			if	( $id != '' )
//				$id = '.'.$id;
		}
		else
		{
			global $view;
			$params[REQ_PARAM_ACTION   ] = $action;
			$params[REQ_PARAM_SUBACTION] = $subaction;
			$params[REQ_PARAM_ID       ] = $id;
			
			if	( !isset($params[REQ_PARAM_TARGET]))
				$params[REQ_PARAM_TARGET   ] = $view;
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

		if	( @$conf['interface']['url']['index'] )
			$controller_file_name = '';
		else
			$controller_file_name = OR_CONTROLLER_FILE.'.'.PHP_EXT;

		$prefix = './';
		
		if	( $fake_urls )
			$src = sprintf( $url_format,$action,$subaction,$id,session_id() ).$urlParameter;
		else
			$src = $prefix.$controller_file_name.$urlParameter;

		return $src;
	}



	function open_tag($tagname,$attributes)
	{
		$text = '<'.$tagname;
		foreach( $attributes as $attribute_name=>$attribute_value )
			if	( !empty($attribute_value) )
				$text .= ' '.$attribute_name.'="'.$attribute_value.'"';
		$text .= '>';
		return $text;
	}
	
	
	function close_tag($tagname)
	{
		return '</'.$tagname.'>';
	}
}
?>