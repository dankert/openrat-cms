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
	var $tableHasRows = false;
	var $rowHasCells  = false;
	var $openTags     = array();
	
	
	function insert( $attr )
	{
		extract($attr);
		return "<?php include( $$tpl_dir.'.$file.tpl.php') ?>";
	}
	
	
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


	function closeTag( $name )
	{
		if	( count($this->openTags) == 0 )
			return;
			
		for( $n=count($this->openTags); $n>=0; $n--)
		{
			$tagName = $this->openTags[$n];
			echo '</'.$tagName.'>';
			unset($this->openTags[$n]);
			
			if	( $tagName == $name )
				break;
		}
	}
	
	
	/**
	 * Erzeugt ein HTML-Eingabefeld
	 *
	 * @param Name des Feldes
	 * @param Vorbelegter Inhalt
	 * @param Weitere Parameter
	 */
	function inputText( $name,$default='',$params=Array() )
	{
		$src = '<input type="text" name="'.$name.'" value="'.$default.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';


		return $src;
	}



	/**
	 * Erzeugt einen HTML-Texteingabebereich
	 *
	 * @param Name des Feldes
	 * @param Inhalte als assoziatives Array
	 * @param Vorbelegter Inhalt
	 * @param Weitere Parameter
	 */
	function inputTextArea( $name,$default='',$params=Array() )
	{
		$src = '<textarea name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';
		$src .= $default;
		$src .= '</textarea>';

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
			$src = './'.sprintf( $url_format,$action,$subaction,$id ).$urlParameter;
		else
			$src = './'.OR_CONTROLLER_FILE.'.'.PHP_EXT.$urlParameter;

		return $src;
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
	
	
	function printUser( $user )
	{
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

		if	( !empty($user->mail) )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
	}
	
	
	function row()
	{
		$this->closeTag('tr');
		
		echo '<tr>';
		$this->tableHasRows = true;
	}


	function cell()
	{
		$this->closeTag('td');
		
		echo '<td>';
		$this->rowHasCells = true;
	}


	function text( $text )
	{
		echo lang($text);
	}
	
	
	function formatDate( $time )
	{
		if	( $time==0)
		{
			echo lang('GLOBAL_UNKNOWN');
			return;
		}
	
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		
		if	( $sekunden == 1 )
			$text = $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			$text = $sekunden.' '.lang('GLOBAL_SECONDS');
	
		elseif	( $minuten == 1 )
			$text = $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			$text = $minuten.' '.lang('GLOBAL_MINUTES');
	
		elseif	( $stunden == 1 )
			$text = $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			$text = $stunden.' '.lang('GLOBAL_HOURS');
	
		elseif	( $tage == 1 )
			$text = $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			$text = $tage.' '.lang('GLOBAL_DAYS');
	
		elseif	( $monate == 1 )
			$text = $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			$text = $monate.' '.lang('GLOBAL_MONTHS');
	
		elseif	( $jahre == 1 )
			$text = $jahre.' '.lang('GLOBAL_YEAR');
		else
			$text = $jahre.' '.lang('GLOBAL_YEARS');
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		echo $text;
		echo '</span>';
	//	return date(lang('DATE_FORMAT'),$time);
	}


	function window( $title,$objectName='',$icon='',$attr=array() )
	{
		global $image_dir;
		if	( !isset($attr['width'])) $attr['width']='90%';
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" ';
		foreach( $attr as $aName=>$aValue )
			echo " $aName=\"$aValue\"";
		echo '>';
		echo '<tr><th>';
		if	( !empty($icon) )
			echo '<img src="'.$image_dir.'icon_'.$icon.IMG_EXT.'" align="left" border="0">';
		echo $objectName.': ';
		echo lang( $title );
		echo <<<EOF
    </th>
  </tr>
  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
EOF
;
		echo '';
	}
	
	
	function windowClose()
	{
		echo <<<EOF
      </table>
	</td>
  </tr>
</table>

</center>
EOF
;
}

}
?>