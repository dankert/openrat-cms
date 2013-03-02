<?php

/**
 * Darstellung eines Verweises auf eine URL.<br>
 * <br>
 * Es wird nur das Verweisziel gespeichert.<br>
 * Der verweisende Text wird nicht hier, sondern in einem der Unterelemente gespeichert.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class LinkElement extends AbstractElement
{
	var $target;
	var $mail;
	var $protocol = '';
	var $objectId = 0;
	var $user = '';
	var $password = '';
	var $host = '';
	var $port     = '';
	var $query    = '';
	var $fragment = '';
	var $path     = '';
	
	var $name;
	
	/**
	 * Setzt das Ziel des Links.<br>
	 * Als Parameter wird eine URL erwartet.
	 * 
	 * @param target Verweisziel
	 */
	function setTarget( $target )
	{
		$this->target = $target;
		
		$url = parse_url( $target );

		$this->protocol = @$url['scheme'];
		$this->user     = @$url['user'  ];
		$this->password = @$url['pass'  ];
		$this->host     = @$url['host'  ];
		$this->port     = @$url['port'  ];
		$this->path     = @$url['path'  ];
		$this->query    = @$url['query' ];
		$this->fragment = @$url['fragment'];
			
		if	( $this->protocol == 'object' )
			$this->objectId = intval($url['host']);

		
		if	( $this->protocol == '' )
		{
			if	( strpos($target,'@') !== false )
			{
				$this->protocol = 'mailto';
				$this->path     = $this->target;
			}
			
			// "..."->"123"
			if	( intval($url['path']) > 0 )
			{
				$this->protocol = 'object';
				$this->objectId = intval($url['path']);
			}
		}
	}
	

	/**
	 * Ermittelt die URL des Links.
	 */
	function getUrl()
	{
		$url = '';
		
		// Protokollangabe im Format <protokoll>://
		if	( $this->protocol != '')
		{
			$url .= $this->protocol.':';
		
			// Ausnahme: Das "mailto"-Protokoll darf keinen Doppelslash haben.
			if	( $this->protocol != 'mailto' )
				$url.='//';
		}
			
		// Benutzer und Kennwort anh�ngen.
		// Format: <benutzer>:<kennwort>@
		if	( $this->user != '' )
		{
			$url .= $this->user;
			if	( $this->password != '' )
			{
				$url .= ':'.$this->password;
			}
			$url .= '@';
		}
		
		// Hostnamen anh�ngen.
		$url .= $this->host;
		
		// Port anh�ngen
		if	( $this->port != '' )
			$url .= ':'.$this->port;
		
		// Den Pfad anh�ngen.
		$url .= $this->url_encode($this->path);

		// Den Query-Teil mit einem "?" getrennt anh�ngen.
		if	( $this->query != '' )
			$url .= '?'.$this->url_encode($this->query);
//			$url .= '?'.urlencode($this->query);

		// Fragment mit "#" getrennt anh�ngen.
		if	( $this->fragment != '' )
			$url .= '#'.$this->url_encode($this->fragment);

		return $url;
	}
	
	
	
	/**
	 * Hilfsfunktion f�r #url_encode().
	 * Ein Ganzzahl-Wert wird in Hexadezimal umgewandelt. 
	 */
	private function int2hex($intega)
	{
	   	$Ziffer = "0123456789ABCDEF";
		return @$Ziffer[($intega%256)/16].$Ziffer[$intega%16];
	}
	
	
	
	/**
	 * Kodiert eine URL.<br>
	 * Alle Zeichen mit dem Ordinalwert >=129 werden kodiert.
	 */
	private function url_encode( $text )
	{
		for($i=129;$i<255;$i++)
		{
			$in   = chr($i);
			$out  = "%C3%".$this->int2hex($i-64);
			$text = str_replace($in,$out,$text);
		}
		return $text;
	}
}

?>