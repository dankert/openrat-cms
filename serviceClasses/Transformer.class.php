<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Transformer
{
	var $text  = '';
	var $args  = array();
	var $tag   = '';
	var $value = '';
	var $type  = 'html';
	var $html  = false;
	var $types = array('html','wml','text');
	var $rules = array('strong','emphatic');
	var $parsedText   = array();
	var $renderedText = array();
	var $toc = array();
	var $render = true;


	function anchorName( $text )
	{
		$text = trim(strtolower($text));
		$gueltig = 'abcdefghijklmnopqrstuvwxyz0123456789-';
		$tmp = strtr($text, $gueltig, str_repeat('#', strlen($gueltig)));
		$text = strtr($text, $tmp, str_repeat('-', strlen($tmp)));
		return $text;
	}

	function replace( $search,$with )
	{
		$this->zeile = str_replace( $search,$with,$this->zeile );
	}


	function replaceRegexp( $search,$with )
	{
		$this->zeile = ereg_replace( $search,$with,$this->zeile );
	}
	
	
	function macro( $text,$param=array() )
	{
		$paramText = implode(',',$param);
		if	( !empty($paramText) )
			$paramText = ','.$paramText;
		return( '{'.$text.$paramText.'}' );
	}


	function transform()
	{
		$this->parse();
		$this->render();
		
		$this->text = implode( '',$this->renderedText );
	}



	function parse()
	{
		$tocid = 0;
	
		$pre   = false;
		$quote = false;
		$br    = false;
		$ul    = false;
		$ol    = false;
		$li    = true;
		$level = 0;
		$lis   = array();
		$table = false;
		$p     = false;

		// Links
		if   ( $this->html )
			$pf = '>';
		else $pf = '&amp;gt;';

		if   ( $this->html )
			$pf = '>';
		else $pf = '&amp;gt;';


		$this->text = preg_replace( '/([^\n]*)\r\n[\=]{3,}/','+ \\1',$this->text );
		$this->text = preg_replace( '/([^\n]*)\r\n[\-]{3,}/','++ \\1',$this->text );
		$this->text = preg_replace( '/([^\n]*)\r\n[\.]{3,}/','+++ \\1',$this->text );

		$zeilen = explode("\n",$this->text);

		foreach( $zeilen as $zeile )
		{
			# Leer- und Sonderzeichen am Zeilenende entfernen
			$this->zeile = chop($zeile);
			$zeile = chop($zeile);

			$this->replace( '##TOC##','{table-of-contents}' );

			//$this->replaceRegexp( '([^\-\;]?)"',"\\1''" );
			$this->replace( '"',"''" );
	
			// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
			$this->replaceRegexp( '([A-Za-z0-9._????????-]+)-'.$pf, '\'\'\\1\'\'-'.$pf  );
	
			// ...->Link umsetzen nach ...->"Link" (Anfuehrungszeichen ergaenzen)
			$this->replaceRegexp( '-'.$pf.'([A-Za-z0-9.:_\/\,\?\=\&-]+)', '-'.$pf.'\'\'\\1\'\''  );
	
			# Links ...->"nnn" ersetzen mit ...->"object:nnn"
			$this->replaceRegexp( '-'.$pf.'\'\'([0-9]+)\'\'', '-'.$pf.'\'\'object\\1\'\'' );

			$this->replaceRegexp( '-'.$pf.'\'\'([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)\'\'', '-'.$pf.'\'\'mailto:\\1\'\'' );
	
	
			# Links "mit->..."
			$this->replaceRegexp(  '\'\'([^\']+)\'\'-'.$pf.'\'\'([^\']+)\'\'', '{link:"\\2","\\1"}' );
	
			// alleinstehende externe Links
			$this->replaceRegexp( '([^"])((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]*))', '\\1{link:"\\2","\\4"}' );
			$this->replaceRegexp( '^((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]*))'     , '{link:"\\1","\\3"}'    );

			# mailto:...-Links
			$this->replaceRegexp( '([^[A-Za-z0-9._:-])([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)', '\\1{link:"mailto:\\2","\\2"}' );
			$this->replaceRegexp( '^([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)'                  , '{link:"mailto:\\1","\\1"}' );
			
			// Einbinden von Bildern
			$this->replaceRegexp( '(ima?ge?):\/?\/?(([0-9]+))(\{.*\})?', '{image:"object\\2"}' );
			$this->replaceRegexp( '\{([0-9]+),?\}'                     , '{image:"object\\1"}' );
			$this->replaceRegexp( '\{([0-9]+),([^\}]+)\}'              , '{image:"object\\1","\\2"}' );
	

			

			// Backtick am Zeilenbeginn schaltet Wikiauszeichnungen aus
			if	( substr($this->zeile,0,1) == '`' && !$pre )
			{
				$this->zeile = substr($this->zeile,1);
				$nowiki = true;
			}
			else
			{
				$nowiki = false;
			}

			// Zitat Anfang
			if   ( $zeile == $pf  &&  !$quote && !$pre )
			{
				if	( $p )
				{
					$this->parsedText[] = '{paragraph-close}';
					$p = false;
				}

				$this->zeile = '{blockquote-open}';
				$quote = true;
			}
	
			// Zitat Ende
			if   ( $zeile == $pf &&  $quote  && !$pre )
			{
				if	( $p )
				{
					$this->parsedText[] = '{paragraph-close}';
					$p = false;
				}
				$this->zeile = '{blockquote-close}';
				$quote = false;
			}
		
			// Pr?formatierter Text Anfang
			if   ( $this->zeile == '='  &&  !$pre )
			{
				if	( $p )
				{
					$this->parsedText[] = '{paragraph-close}';
					$p = false;
				}

				$this->zeile = '{code-open}';
				$pre = true;
			}
	
			// Pr?formatierter Text Ende
			if   ( $this->zeile == '='  &&  $pre )
			{
				$this->zeile = '{code-close}';
				$pre = false;
			}
		

			// ?berschriften
			if	( preg_match('/^([+]{1,}) ?(.*)/',$zeile,$match) && !$nowiki && !$pre && !$quote )
			{
				if	( $p )
				{
					$this->parsedText[] = '{paragraph-close}';
					$p = false;
				}

				$tocid++;
				$hlev = strlen($match[1]);
				$this->toc[] = array('level'=>$hlev,'id'=>$this->anchorName($match[2]),'text'=>$match[2]);
				$this->zeile = '{heading:"'.$hlev.'","'.$this->anchorName($match[2]).'","'.$match[2].'"}';
			}

			// Bei pr?formatierem Text keine weiteren Formatierungen durchf?hren	
			if   ( !$pre )
			{
				// Tabellen
				$beg = substr($zeile,0,1);
				
				if   ( $beg == '|' )
				{
					if   ( !$table )
					{
						if	( $p )
						{
							$this->parsedText[] = '{paragraph-close}';
							$p = false;
						}
	
						$this->parsedText[] = '{table-open}';
						$table = true;
					}
					
					$this->replaceRegexp( '^\|' ,'{table-line-open}{table-cell-open:"1"}' );
					$this->replaceRegexp( '\|?$','{table-cell-close}{table-line-close}'       );
					$this->replace( '|','{table-cell-close}{table-cell-open:"1"}' );

					// Spalten?bergreifende Zellen
					for	( $i=1; $i<=10; $i++)
						$this->replace('{table-cell-close}{table-cell-open:"'.$i.'"}{table-cell-close}{table-cell-open:"1"}','{table-cell-close}{table-cell-open:"'.($i+1).'"}' );

					// Spalten-?berschriften <th>
					$this->replaceRegexp( '{table-cell-open:"([0-9])"}!([^{]+){table-cell-close}','{table-header-cell-open:"\\1"}\\2{table-header-cell-close}' );

					//TODO: CSS-Klassen (etwas allgemeingueltiges finden!)
					//$this->replaceRegexp( '{table-cell-open:"([0-9])"}<t([dh][^<]*)>\(([a-zA-Z0-9]+)\)([^<]+)</td>','<t\\1 class\="\\2">\\3</td>',$this->zeile );
				}
				else
				{
					if( $table )
					{
						$table = false;
						$this->parsedText[] = '{table-close}';
					}
				}


				// Aufz?hlungen		
				if	( preg_match('/^( *)([\*#-]) (.*)/',$zeile,$match) && !$nowiki )
				{
					if	( $p )
					{
						$this->parsedText[] = '{paragraph-close}';
						$p = false;
					}

					$lev  = strlen($match[1])+1;
					$type = $match[2];
					$text = $match[3];
					
					if	( $level == $lev ) $this->parsedText[] = '{entry-close}';

					while( $level < $lev )
					{
						$level++;

						if	( $match[2]=='#')
							$this->parsedText[] = '{numbered-list-open:level='.$level.'}';
						else
							$this->parsedText[] = '{list-open:level='.$level.'}';

						$lis[$level] = $match[2]; 
					}

					while( $level > $lev )
					{
						$this->parsedText[] = '{entry-close}';
						if	( $lis[$level]=='#')
							$this->parsedText[] = '{numbered-list-close}';
						else
							$this->parsedText[] = '{list-close}';

						$level--;
					}

					$this->zeile = '{entry-open}'.$text;
				}
				else
				{
					while( $level > 0 )
					{
						if	( $lis[$level]=='#')
							$this->parsedText[] = '{numbered-list-close}';
						else
							$this->parsedText[] = '{list-close}';
						$level--;
					}
				}
			}
	
			
			// Abs?tze einrichten
			if   (!$pre && !$ol && !$ul && !$table && substr($this->zeile,0,1)!='{' )
			{
				if   ( $zeile != '' && $p )
				{
					$this->parsedText[] = '{line-break}';
				}
	
				if   ( $zeile == '' && $p )
				{
					$this->parsedText[] = '{paragraph-close}';
					$p = false;
				}
	
				if   ( $zeile != '' && !$p )
				{
					$this->parsedText[] = '{paragraph-open}';
					$p = true;
				}
			}
		
	
	
			// Textauszeichnungen fett,kursiv,fest		
			if   ( !$pre && !$nowiki )  // nicht bei praeformatiertem Text
			{

				$this->replaceRegexp( '\*([^\*]+[^\\])\*', '{strong-open}\\1{strong-close}'     );
				$this->replaceRegexp( '_([^_]+[^\\])_'   , '{emphatic-open}\\1{emphatic-close}' );

				$this->replaceRegexp( '_([^_]+[^\\])_'   , '{emphatic-open}\\1{emphatic-close}' );
				$this->replaceRegexp( '_([^_]+[^\\])_'   , '{emphatic-open}\\1{emphatic-close}' );
	
				// "Wortliche Rede"
				if	( !$this->html )
					$this->replaceRegexp( '\'\'([^\']+[^\\])\'\'', '{speech-open}\\1{speech-close}' );
	
				// =feste Breite=
				$this->replaceRegexp( '=([^=]+[^\\])=', '{teletype-open}\\1{teletype-close}' );

				$this->zeile = ereg_replace( '([^\\\\])\\\\','\\1', $this->zeile );
			}
			else
			{
				$this->replace( "''",'"' );
			}
			
			$this->parsedText[] = $this->zeile;
		}

		if   ( $ol    ) $parsedText[] = '{numbered-list-close}';
		if   ( $ul    ) $parsedText[] = '{list-close}';
		if   ( $table ) $parsedText[] = '{table-close}';
		if   ( $pre   ) $parsedText[] = '{code-close}';
		if   ( $p     ) $parsedText[] = '{paragraph-close}';
	}
	
	
	
	
	
	function render()
	{
//		echo '<pre>'.implode("\n",$this->parsedText).'</pre>';

		foreach( $this->parsedText as $zeile )
		{
			$this->zeile = $zeile;

			if	( $this->render )
			{
				$this->renderLine();
			}
			$this->renderedText[] = $this->zeile;
		}
	}



	function renderLine()
	{

		switch( $this->type )
		{
			case 'html':
				$this->replace( '{table-open}' ,'<table>'  );
				$this->replace( '{table-close}','</table>' );

				$this->replace( '{table-line-open}' ,'<tr>'  );
				$this->replace( '{table-line-close}','</tr>' );

				$this->replaceRegexp( '\{table-cell-open:"([0-9]+)"\}' ,'<td colspan="\\1">' );
				$this->replace( '{table-cell-close}' ,'</td>'  );

				$this->replaceRegexp( '\{table-header-cell-open:"([0-9]+)"\}' ,'<th colspan="\\1">' );
				$this->replace( '{table-header-cell-close}' ,'</th>'  );

				$this->replace( '{strong-open}' ,'<strong>'  );
				$this->replace( '{strong-close}','</strong>' );

				$this->replace( '{emphatic-open}' ,'<em>'  );
				$this->replace( '{emphatic-close}','</em>' );

				$this->replace( '{emphatic-open}' ,'<em>'  );
				$this->replace( '{emphatic-close}','</em>' );

				$this->replace( '{teletype-open}' ,'<tt>'  );
				$this->replace( '{teletype-close}','</tt>' );

				$this->replace( '{code-open}' ,'<pre>'  );
				$this->replace( '{code-close}','</pre>' );

				$this->replace( '{paragraph-open}' ,'<p>'  );
				$this->replace( '{paragraph-close}','</p>' );

				$this->replace( '{speech-open}'  ,'&raquo;'  );
				$this->replace( '{speech-close}' ,'&laquo;'  );

				$this->replaceRegexp( '\{list-open:level=([0-9])+\}' ,'<ul class="level\\1">' );
				$this->replace( '{list-close}' ,'</ul>'  );

				$this->replaceRegexp( '\{numbered-list-open:level=([0-9])+\}' ,'<ol class="level\\1">' );
				$this->replace( '{numbered-list-close}' ,'</ol>'  );

				$this->replace( '{entry-open}' ,'<li>'  );
				$this->replace( '{entry-close}','</li>' );

				$this->replace( '{line-break}' ,'<br />'  );

				$this->replaceRegexp( '\{heading:"([0-9]+)","([^}"]*)","([^}"]*)"\}' ,'<h\\1><a name="\\2"></a>\\3</h\\1>' );
				//<a name="toc'.$tocid.'"></a>		

				$toctext = array();
				foreach( $this->toc as $t )
				{
					if	($t['level'] == 1 && count($toctext)>0) $toctext[] = '';
					$toctext[] = str_repeat('&nbsp;',$t['level']*2).'<a href="#'.$t['id'].'">'.$t['text'].'</a>';
				}
				$this->replace( '{table-of-contents}',implode("<br/>\n",$toctext) );
		
				// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
				$this->replaceRegexp( '\{link:"([^"]+)","([^"]+)"\}','<a href="\\1">\\2</a>'  );
		
				$this->replaceRegExp( '\{image:"([^}"]+)"\}' ,'<img src="\\1" />' );
				$this->replaceRegExp( '\{image:"([^}"]+)","([^}]*)"\}' ,'<table align="right"><tr><td class="image"><img src="\\1" /></tr><tr><td class="imagetext">\\2</td></tr></table>' );
		
				$this->replaceRegexp( '\{mailto:([^}]+)\}','<a href="mailto:\\1">\\1</a>' );

				break;

			case 'text':
				$this->replaceRegexp( '\{image:([^}]+)\}' ,''  );

				$this->replace( '{strong-open}' ,''  );
				$this->replace( '{strong-close}','' );

				$this->replace( '{emphatic-open}' ,''  );
				$this->replace( '{emphatic-close}','' );

				$this->replace( '{emphatic-open}' ,''  );
				$this->replace( '{emphatic-close}','' );

				$this->replace( '{teletype-open}' ,''  );
				$this->replace( '{teletype-close}','' );

				$this->replace( '{paragraph-open}' ,''  );
				$this->replace( '{paragraph-close}',"\n" );

				$this->replace( '{speech-open}'  ,'"'  );
				$this->replace( '{speech-close}' ,'"'  );

				$this->replace( '{list-open}' ,"\n"  );
				$this->replace( '{list-close}' ,"\n" );

				$this->replace( '{numbered-list-open}' ,"\n" );
				$this->replace( '{numbered-list-close}' ,"\n" );

				$this->replace( '{entry-open}' ,'- '  );
				$this->replace( '{entry-close}' ,'- '  );

				$this->replace( '{line-break}' ,"\n" );
				$this->replaceRegexp( '\{[^}]+)\}','' );
				break;

			default:
		}

		// Links object:nnn ersetzen
		preg_match_all( '|object:?([0-9]+)|',$this->zeile,$objects,PREG_SET_ORDER );
		foreach( $objects as $object )
		{
//			print_r($this->page);
			$var = $this->page->path_to_object( $object[1] );
			$this->replace( $object[0],$var );
		}

	}
	


	function old()
	{	
	
		foreach( $conf['replace'] as $replace )
		{
			$repl = explode(',',$replace);
			if	( count($repl) == 2 )
				$text = str_replace( $repl[0],$repl[1],$text );
		}
	}
}

?>