<?php

/**
 * Bereitstellen von Methoden fuer die Darstellung von HTML-Elementen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class HtmlView
{
	var $tableHasRows = false;
	var $rowHasCells  = false;
	var $openTags     = array();
	
	
	function insert( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';

		return "<?php include( ".'$'."tpl_dir.'$file.tpl.php') ?>";
	}
	
	
	/**
	 * Erzeugt eine HTML-Dropdown-Box
	 *
	 * @param Name des Feldes
	 * @param Inhalte als assoziatives Array
	 * @param Vorbelegter Inhalt
	 * @param Weitere Parameter
	 */
	function selectBox( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';
		
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

//		if	( isset($this) ) // sind wir statisch oder instanziiert?
//			echo $src;
			
		return $src;
	}



	/**
	 * Erzeugt ein HTML-Eingabefeld
	 *
	 * @param Name des Feldes
	 * @param Vorbelegter Inhalt
	 * @param Weitere Parameter
	 */
	function inputText( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';
		
		$src = '<input type="text" name="'.$name.'" value="'.$value.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';

		if	( isset($this) ) // sind wir statisch oder instanziiert?
			echo $src;
			

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

		if	( isset($this) ) // sind wir statisch oder instanziiert?
			echo $src;
			
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

		if	( isset($this) ) // sind wir statisch oder instanziiert?
			echo $src;
		
		return $src;
	}


	function error( $field )
	{
		global $inputErrors;

		if	( isset($inputErrors[$field]) )
			return '<span class="error">'.lang($inputErrors[$field]).'</span';
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
			$src = './'.$action.','.$subaction.$id.$urlParameter;
		else
			$src = './'.'do.php'.$urlParameter;

//		if	( isset($this) ) // sind wir statisch oder instanziiert?
//			echo $src;

		return $src;
	}



	/**
	  * Erstellt den Beginn eines HTML-Formulares
	  *
	  * @param Parameter
	  */
	function form( $attr )
	{
		global $conf;
		$action='';
		$subaction = '';
		$id=0;
		$end = false;
		extract($attr);
		if	( $end ) return '';

		if	( !isset($target  ) )  $target  = '_self';
		if	( !isset($method  ) )  $method  = 'post';
		if	( !isset($name    ) )  $name    = '';
		if	( !isset($enctype ) )  $enctype = '';

		$url = Html::url( $action,$subaction,$id );
		
		$reqParamAction    = REQ_PARAM_ACTION;
		$reqParamSubAction = REQ_PARAM_SUBACTION;
		$reqParamId        = REQ_PARAM_ID;
		$text = <<<EOF
<form name="$name" target="$target" action="$url" method="$method" enctype="$enctype">
<input type="hidden" name="$reqParamAction" value="$action" />
<input type="hidden" name="$reqParamAction" value="$subaction" />
<input type="hidden" name="$reqParamAction" value="$id" />
EOF;
		if	( $conf['interface']['url_sessionid'] )
			$text.= '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";

		unset($attr['target' ]);
		unset($attr['method' ]);
		unset($attr['name'   ]);
		unset($attr['enctype']);
		foreach( $attr as $paramName=>$paramValue )
			$text.= '<input type="hidden" name="'.$paramName.'" value="'.$paramValue.'" />'."\n";

		return $text;
	}



	/**
	 * Setzt den Cursor beim Laden der Seite in ein definiertes Formularfeld
	 *
	 * @param Name des Feldes
	 */ 
	function focus( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';
		$text = <<<EOF
<script name="JavaScript" type="text/javascript"><!--
document.forms[0].$field.focus();
//--></script>
EOF;
		return $text;
	}
	
	
	function printUser( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';
		$text = <<<EOF
		<php
		if	( empty(\$user->name) )
			\$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty(\$user->fullname) )
			\$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

		if	( !empty(\$user->mail) )
			echo '<a href="mailto:'.\$user->mail.'" title="'.\$user->fullname.'">'.\$user->name.'</a>';
		else
			echo '<span title="'.\$user->fullname.'">'.\$user->name.'</span>';
		>
EOF;
		return $text;
	}
	
	
	function row( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end )
			return '</tr>';
		
		return '<tr>';
	}


	function cell( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end )
			return '</td>';
		return '<td>';
	}


	function text(  $attr  )
	{
		$text = 'need attribute text';
		$end = false;
		extract($attr);
		if	( $end ) return '';
		
		if	( isset($raw) )
			return str_replace('_',' ',$raw);
			
		return lang($text);
	}
	
	
	function formatDate( $attr )
	{
		$end = false;
		extract($attr);
		if	( $end ) return '';
		$text = <<<EOF
		<?php
		\$time = \$$value;
		if	( \$time==0)
		{
			echo lang('GLOBAL_UNKNOWN');
			return;
		}
	
		\$sekunden = time()-\$time;
		\$minuten = intval(\$sekunden/60);
		\$stunden = intval(\$minuten /60);
		\$tage    = intval(\$stunden /24);
		\$monate  = intval(\$tage    /30);
		\$jahre   = intval(\$monate  /12);
		
		if	( \$sekunden == 1 )
			\$text = \$sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( \$sekunden < 60 )
			\$text = \$sekunden.' '.lang('GLOBAL_SECONDS');
	
		elseif	( \$minuten == 1 )
			\$text = \$minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( \$minuten < 60 )
			\$text = \$minuten.' '.lang('GLOBAL_MINUTES');
	
		elseif	( \$stunden == 1 )
			\$text = \$stunden.' '.lang('GLOBAL_HOUR');
		elseif	( \$stunden < 60 )
			\$text = \$stunden.' '.lang('GLOBAL_HOURS');
	
		elseif	( \$tage == 1 )
			\$text = \$tage.' '.lang('GLOBAL_DAY');
		elseif	( \$tage < 60 )
			\$text = \$tage.' '.lang('GLOBAL_DAYS');
	
		elseif	( \$monate == 1 )
			\$text = \$monate.' '.lang('GLOBAL_MONTH');
		elseif	( \$monate < 12 )
			\$text = \$monate.' '.lang('GLOBAL_MONTHS');
	
		elseif	( \$jahre == 1 )
			\$text = \$jahre.' '.lang('GLOBAL_YEAR');
		else
			\$text = \$jahre.' '.lang('GLOBAL_YEARS');
		echo '<span title="'.date(lang('DATE_FORMAT'),\$time).'"">';
		echo \$text;
		echo '</span>';
	//	return date(lang('DATE_FORMAT'),\$time);
	?>
EOF;
		return $text;

	}


	function window( $title,$objectName='',$icon='',$attr=array() )
	{
		$end = false;
		extract($attr);
		if	( $end )
		{
				$end = false;
			return <<<EOF
      </table>
	</td>
  </tr>
</table>

</center>
EOF;
		
		}
		
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
	

}
?>