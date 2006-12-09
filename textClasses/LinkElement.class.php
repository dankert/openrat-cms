<?php

/**
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
	

	function getUrl()
	{
		$url = '';
		
		if	( $this->protocol != '')
		{
			$url .= $this->protocol.':';
		
			if	( $this->protocol != 'mailto' )
				$url.='//';
		}
			
		if	( $this->user != '' )
		{
			$url .= $this->user;
			if	( $this->password != '' )
			{
				$url .= ':'.$this->password;
			}
			$url .= '@';
		}
		
		$url .= $this->host;
		
		if	( $this->port != '' )
			$url .= ':'.$this->port;
			
		$url .= $this->url_encode($this->path);

		if	( $this->query != '' )
			$url .= '?'.urlencode($this->query);

		if	( $this->fragment != '' )
			$url .= '#'.$this->fragment;

		return $url;
	}
	
	
	
	function int2hex($intega)
	{
	   	$Ziffer = "0123456789ABCDEF";
		return $Ziffer[($intega%256)/16].$Ziffer[$intega%16];
	}
	
	
	function url_encode( $text )
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