<?php

/**
 * Bereitstellen von HTTP-Methoden
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Http
{
	var $url    = array();
	var $header = array();
	var $method = 'GET';
	var $error  = '';
	var $status = '';
	var $body   = '';
	
	
		
	function Http( $url = '' )
	{
		$this->url = parse_url($url);

		if	( !isset($this->url['port']))
			$this->url['port'] = 80; // Standard-Port 80.
			
		$this->header[] = 'User-Agent: Mozilla/5.0 (OpenRat HTTP-Client)';
		$this->header[] = 'Connection: close';
	}
	
	
	
	function setBasicAuthentication( $user, $password )
	{
		$this->header[] = 'Authorization: Basic '.base64_encode($user.':'.$password);
	}
	
	
	
	function request()
	{
		$this->body   = '';
		$this->error  = '';
		$this->status = '';
		
		$errno  = 0;
		$errstr = '';
		
		$fp = @fsockopen ($this->url['host'],$this->url['port'], $errno, $errstr, 30);

		if	( !$fp )
		{
			// Keine Verbindung zum Host moeglich.
			$this->error = "Connection refused: '".$this->url['host'].':'.$this->url['host']." - $errstr ($errno)";
			return false;
		}
		else
		{
			$lb = "\r\n";
			$http_get = $this->url['path'];
			if	( !empty($this->url['query']) ) 
				$http_get .= '?'.$this->url['query'];
						
			$request_header = array( $this->method.' '.$http_get.' HTTP/1.0',
			                         'Host: '.$this->url['host']) + $this->header;
			$http_request = implode($lb,$request_header).$lb.$lb;

			fputs($fp, $http_request);

			$inhalt = array();
			while (!feof($fp)) {
				$inhalt[] = fgets($fp,128);
			}
			fclose($fp);
			
			$this->body = implode('',$inhalt); // HTTP-Antwort
			

			// RFC 1945 (Section 6.1) schreibt als Statuszeile folgendes Format vor
			// "HTTP/" 1*DIGIT "." 1*DIGIT SP 3DIGIT SP
			
			$this->status = substr($this->body,9,3); 

			// RFC 1945 (Section 6.1.1) schreibt
			// "[...] However, applications must understand the class of any status code, as
			// indicated by the first digit"
			// Daher interessiert uns nur die erste Stelle des 3-stelligen HTTP-Status.
			
			// RFC 1945 (Section 6.1.1) schreibt
			// "2xx: Success - The action was successfully received, understood, and accepted."
			if	( substr($this->status,0,1) == '2' ) 
			{
				return true;
			}
			else
			{
				$this->error = 'Received no 2XX-Status from host: '.$this->status;
				return false;
			}
		}
		
	}
	
	
	/**
	 * Aus dem HTTP-Header werden die vom Browser angeforderten Sprachen
	 * gelesen.
	 *
	 * @return Array
	 */
	function getLanguages()
	{
		global $SESS,
		       $HTTP_SERVER_VARS,
		       $conf_php,
		       $conf;
	
		$languages = array();
		$http_languages = @$HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		foreach( explode(',',$http_languages) as $l )
		{
			$parts = explode(';',$l);
			$languages[] = trim($parts[0]);
			// aus "xx_yy" das "xx" extrahieren.
			$languages[] = current(explode('_',trim($parts[0])));
			$languages[] = current(explode('-',trim($parts[0])));
			
		}
		
		return array_unique( $languages );
	}
}

?>