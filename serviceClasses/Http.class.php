<?php

/**
 * Kapselung einer HTTP-Anfrage.<br>
 * Unter Berücksichtigung von RFC 1945.<br>
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Http
{
	var $url    = array();
	var $header = array();
	var $responseHeader = array();
	var $requestParameter = array();
	var $urlParameter = array();

	/**
	 * HTTP-Request-Typ.<br>
	 * Muss entweder "GET" oder "POST" sein.<br>
	 * Default: "GET".
	 *
	 * @var String Request-Typ
	 */
	var $method = 'GET';
	var $error  = '';
	var $status = '';
	var $body   = '';



	/**
	 * Erzeugt eine HTTP-Anfrage.
	 *
	 * @param String URL
	 * @return Http
	 */
	function Http( $url = '' )
	{
		$this->setURL( $url );
		$this->header[] = 'User-Agent: Mozilla/5.0 (OpenRat CMS)';
		$this->header[] = 'Connection: close';
	}



	/**
	 * Setzt die URL.
	 *
	 * @param String URL
	 */
	function setURL( $url )
	{
//		Html::debug($url,"neue url");
		$this->url = parse_url($url);
//		Html::debug($this->url,"direkt nach parse_url");

		if	( empty($this->url['host']) && !empty($this->url['path']) )
		{
			$this->url['host'] = basename($this->url['path']);
			$this->url['path'] = '/';
		}

		if	( empty($this->url['path']) )
			$this->url['path'] = '/';

		if	( !isset($this->url['port']) )
			if	( !isset($this->url['scheme']) )
			{
				$this->url['scheme'] = 'http'; // Standard-Port.
				$this->url['port']   = 80; // Standard-Port.
			}
			elseif	( $this->url['scheme'] == 'https' )
				$this->url['port'] = 443; // SSL-Port.
			else
				$this->url['port'] = 80; // Standard-Port.
		
		if	( !empty($this->url['query']) )
			parse_str( $this->url['query'],$this->urlParameter );

	}



	/**
	 * Setzt Authentisierungsinformationen in den HTTP-Request.<br>
	 *
	 * @param String Benutzername
	 * @param String Kennwort
	 */
	function setBasicAuthentication( $user, $password )
	{
		$this->header[] = 'Authorization: Basic '.base64_encode($user.':'.$password);
	}

	

	/**
	 * Erzeugt eine Zeichenkette mit allen Parametern.
	 * @param withPraefixQuestionMark Praefix mit Fragezeichen (für GET-Anfragen)
	 * @return String URL-Parameter
	 */
	function getParameterString( $withPraefixQuestionMark=false )
	{
		$parameterString = '';
		$parameter = $this->urlParameter + $this->requestParameter;
		
		if	( ! empty($parameter) )
		{
			foreach( $this->requestParameter as $paramName => $paramValue )
			{
				if	( strlen($parameterString) > 0)
					$parameterString .= '&';
				elseif	( $withPraefixQuestionMark )
					$parameterString .= '?';
					
				$parameterString .= urlencode($paramName) . '=' .urlencode($paramValue);
			}
		}
		
		return $parameterString;
	}

	
	/**
	 * Sendet eine Redirect-Anweisung an den Browser.
	 * @return String URL
	 */
	function getUrl()
	{
		$location = $this->url['scheme'];
		$location .= '://'; 
		$location .= $this->url['host'];
		if	( $this->url['scheme'] == 'http'  && $this->url['port'] != 80  ||
			  $this->url['scheme'] == 'https' && $this->url['port'] != 443    )
			$location .= ':'.$this->url['port'];
		$location .= $this->url['path'];
			
		$location .= $this->getParameterString(true);

		if	( isset($this->url['fragment']) )
			$location .= '#'.$this->url['fragment'];
		
		return $location;
	}


	/**
	 * Sendet eine Redirect-Anweisung mit der aktuellen URL an den Browser.
	 */
	function sendRedirect()
	{
		$location = $this->getUrl();
		
		header('Location: '.$location);
		exit;
	}


	/**
	 * Erzeugt den HTTP-Request
	 *
	 * @return boolean Erfolg der Anfrage.
	 */
	function request()
	{
		$this->error  = '';
		$this->status = '';

		$errno  = 0;
		$errstr = '';

		if	( empty($this->url['host']) )
		{
			$this->error = "No hostname specified";
			return false;
		}
		
		// RFC 1945 (Section 9.3) says:
		// A user agent should never automatically redirect a request
		// more than 5 times, since such redirections usually indicate an infinite loop.
		for( $r=1; $r<=5; $r++ )
		{
			// Die Funktion fsockopen() erwartet eine Protokollangabe (bei TCP optional, bei SSL notwendig).
			if	( $this->url['scheme'] == 'https' || $this->url['port'] == '443' )
				$prx_proto = 'ssl://'; // SSL
			else
				$prx_proto = 'tcp://'; // Default
				
			$fp = @fsockopen ($prx_proto.$this->url['host'],$this->url['port'], $errno, $errstr, 30);
	
			if	( !$fp || !is_resource($fp) )
			{
				// Keine Verbindung zum Host moeglich.
				$this->error = "Connection refused: '".$prx_proto.$this->url['host'].':'.$this->url['port']." - $errstr ($errno)";
				return false;
			}
			else
			{
				$lb = "\r\n";
				$http_get = $this->url['path'];

				$parameterString = $this->getParameterString();

				if	( $this->method == 'GET')
					if	( !empty($parameterString) )
						$http_get .= '?'.$parameterString;

				if	( $this->method == 'POST' )
				{
					$this->header[] = 'Content-Type: application/x-www-form-urlencoded';
					$this->header[] = 'Content-Length: '.strlen($parameterString);
				}
						
				$this->header[] = 'Host: '.$this->url['host'];
				$this->header[] = 'Accept: */*';
				$request_header = array( $this->method.' '.$http_get.' HTTP/1.0') + $this->header;
				$http_request = implode($lb,$request_header).$lb.$lb;
				
				if	( $this->method == 'POST' )
					$http_request .= $parameterString;

				if (!is_resource($fp)) {
					$this->error = 'Connection lost after connect: '.$prx_proto.$this->url['host'].':'.$this->url['port'];
					return false;
				}
				fputs($fp, $http_request); // Die HTTP-Anfrage zum Server senden.

				// Jetzt erfolgt das Auslesen der HTTP-Antwort.
				$isHeader = true;

				// RFC 1945 (Section 6.1) schreibt als Statuszeile folgendes Format vor
				// "HTTP/" 1*DIGIT "." 1*DIGIT SP 3DIGIT SP
				if (!is_resource($fp)) {
					$this->error = 'Connection lost during transfer: '.$this->url['host'].':'.$this->url['port'];
					return false;
				}
				elseif (!feof($fp)) {
					$line = fgets($fp,1028);
					$this->status = substr($line,9,3);
				}
				else
				{
					$this->error = 'Unexpected EOF while reading HTTP-Response';
					return false;
				}
				
				while (!feof($fp)) {
					$line = fgets($fp,1028);
					if	( $isHeader && trim($line)=='' ) // Leerzeile nach Header.
					{
						$isHeader = false;
					}
					elseif( $isHeader )
					{
						list($headerName,$headerValue) = explode(': ',$line) + array(1=>'');
						$this->responseHeader[$headerName] = trim($headerValue);
					}
					else
					{
						$this->body .= $line;
					}
				}
//				Html::debug($this->url,"URL");
//				Html::debug($http_request,"REQUEST komplett");
//				Html::debug($this->responseHeader);
//				Html::debug($this->body,'BODY');
//				echo "<pre>";
//				echo "REQUEST=".nl2br($http_request);
//				echo "HEADER=".nl2br(htmlentities(implode("\n",$this->responseHeader)));
//				echo "BODY=".nl2br(htmlentities($this->body));
//				echo "</pre>";
				fclose($fp); // Verbindung brav schließen.


				// RFC 1945 (Section 6.1.1) schreibt
				// "[...] However, applications must understand the class of any status code, as
				// indicated by the first digit"
				// Daher interessiert uns nur die erste Stelle des 3-stelligen HTTP-Status.

				// 301 Moved Permanently
				// 302 Moved Temporarily
				if	( $this->status == '301' ||
					  $this->status == '302'   )
				{
					$location = @$this->responseHeader['Location'];
					if	( empty($location) )
					{
						$this->error = '301/302 Response without Location-header';
						return false;
					}
					
//					Html::debug($this->url,"alte URL");
//					Html::debug($location,"NEUES REDIRECT AUF");
					$this->setURL($location);
//					Html::debug($this->url,"NEUE URL NACH REDIRECT");
					continue; // Nächster Versuch mit umgeleiteter Adresse.
				}
				// RFC 1945 (Section 6.1.1) schreibt
				// "2xx: Success - The action was successfully received, understood, and accepted."
				elseif	( substr($this->status,0,1) == '2' )
				{
					return true;
				}
				elseif	( substr($this->status,0,1) == '4' )
				{
					$this->error = 'Client Error: '.$this->status;
					return false;
				}
				elseif	( substr($this->status,0,1) == '5' )
				{
					$this->error = 'Server Error: '.$this->status;
					return false;
				}
				else
				{
					$this->error = 'Unexpected HTTP-Status: '.$this->status. '; this is mostly a client error, sorry.';
					return false;
				}
			}

			$this->error = 'Too much redirects, infinite loop assumed. Exiting. Last URL: '.$http_get;
			return false;

		}

	}


	/**
	 * Aus dem HTTP-Header werden die vom Browser angeforderten Sprachen
	 * gelesen.<br>
	 * Es wird eine Liste von Sprachen erzeugt.<br>
	 * Beispiel: 'de_DE','de','en_GB','en' ... usw.<br>
	 * Wenn der Browser 'de_DE' anfordert, wird hier auch 'de' (als Fallback) ermittelt.
	 *
	 * @static
	 * @return Array
	 */
	function getLanguages()
	{
		global $HTTP_SERVER_VARS;

		$languages = array();
		$http_languages = @$HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		foreach( explode(',',$http_languages) as $l )
		{
			list($part) = explode(';',$l); // Prioritäten ignorieren.
			$languages[] = trim($part);

			// Aus "de_DE" das "de" extrahieren.
			$languages[] = current(explode('_',str_replace('-','_',trim($part))));
		}

		return array_unique( $languages );
	}
	
	
	/**
	 * Ermittelt die aktuelle URL des Requests (ohne Datei).
	 *
	 * @static
	 * @return String URL
	 */
	function getServer()
	{
		$https = getenv('HTTPS');
		
		if	( $https )
			$server = 'https://';
		else
			$server = 'http://';
			
		$server .= getenv('SERVER_NAME').dirname(getenv('REQUEST_URI'));
		
		return $server;
	}
	

	
	/**
	 * Erzeugt einen "HTTP 501 Internal Server Error".
	 *
	 * @param String $message Eigener Hinweistext
	 */
	function serverError($message)
	{

		Http::sendStatus(501,'Internal Server Error',$message);
	}
	
	
	
	/**
	 * Erzeugt einen "HTTP 501 Internal Server Error".
	 *
	 * @param String $message Eigener Hinweistext
	 */
	function notAuthorized($message)
	{

		Http::sendStatus(403,'Not Authorized',$message);
	}
	
	
	
	/**
	 * Schickt einen HTTP-Status zum Client und beendet das Skript.
	 *
	 * @param Integer $status HTTP-Status
	 * @param String $text HTTP-Meldung
	 * @param String $message Eigener Hinweistext
	 */
	function sendStatus( $status=501,$text='Internal Server Error',$message='' )
	{
		if	( headers_sent() )
		{
			echo "$status $text\n$message";
			exit;
		}
		
		header('HTTP/1.0 '.intval($status).' '.$text);
		
		
		$types = Http::getAccept();
		
		if	( sizeof($types)==1 && in_array('application/json',$types) )
		{
			header('Content-Type: application/json');
			require_once( OR_SERVICECLASSES_DIR."JSON.class.".PHP_EXT );
			$json = new JSON();
			echo $json->encode( array('status'=>$status,'error'=>$text,'description'=>$message) );
		}
		elseif	( sizeof($types)==1 && in_array('application/xml',$types) )
		{
			header('Content-Type: application/xml');
			require_once( OR_SERVICECLASSES_DIR."XML.class.".PHP_EXT );
			$xml = new XML();
			$xml->root='error';
			echo $xml->encode( array('status'=>$status,'error'=>$text,'description'=>$message) );
		}
		else
		{
			header('Content-Type: text/html');
			$signature = OR_TITLE.' '.OR_VERSION.' '.getenv('SERVER_SOFTWARE');
			echo <<<HTML
<html>
<head><title>$status $text - OpenRat</title></head>
<body>
<h1>$text</h1>
<p>$message</p>
<hr>
<address>$signature</adddress>
</body>
</html>
HTML;
		}
		exit;
	}
	
	
	/**
	 * 
	 * @return Array Mime-Typen, welche vom User-Agent akzeptiert werden.
	 */
	function getAccept()
	{
		$httpAccept = getenv('HTTP_ACCEPT');
		return $types = explode(',',$httpAccept);
	}
}

?>