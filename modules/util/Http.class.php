<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


/**
 * Kapselung einer HTTP-Anfrage.<br>
 * Unter Beruecksichtigung von RFC 1945.<br>
 *
 * @author Jan Dankert
 * @package openrat.services
 */
class Http
{
	public  $header           = array();
	
	public $url               = array();
	public $responseHeader    = array();
	public $requestParameter  = array();
	public $urlParameter      = array();

	/**
	 * HTTP-Request-Typ.<br>
	 * Muss entweder "GET" oder "POST" sein.<br>
	 * Default: "GET".
	 *
	 * @var String Request-Typ
	 */
	public $method  = 'GET';
	public $error   = '';
	public $status  = '';
	public $body    = '';
	
	public $httpCmd = '';



	/**
	 * Erzeugt eine HTTP-Anfrage.
	 *
	 * @param String URL
	 * @return Http
	 */
	public function Http( $url = '' )
	{
		$this->setURL( $url );
		$this->header['User-Agent'] = 'Mozilla/5.0 (OpenRat CMS)';
		$this->header['Connection'] = 'close';
	}



	/**
	 * Setzt die URL.
	 *
	 * @param String URL
	 */
	function setURL( $url )
	{
		$this->url = parse_url($url);

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
	public function setBasicAuthentication( $user, $password )
	{
		$this->header['Authorization'] = 'Basic '.base64_encode($user.':'.$password);
	}

	

	/**
	 * Erzeugt eine HTTP-Parameterstring mit allen Parametern.
	 * 
	 * @param withPraefixQuestionMark Praefix mit Fragezeichen (fuer GET-Anfragen)
	 * @return String URL-Parameter
	 */
	public function getParameterString( $withPraefixQuestionMark=false )
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
	 * Liefert die URL des Requests.
	 * 
	 * @return String URL
	 */
	public function getUrl()
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
	public function sendRedirect()
	{
		$location = $this->getUrl();
		
		header('Location: '.$location);
		exit;
	}


	/**
	 * Führt einen HTTP-Request durch.
	 *
	 * @return boolean Erfolg der Anfrage.
	 */
	public function request()
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
		
		foreach( $this->header as $header_key=>$header_value )
		{
			if	( is_numeric( $header_key ) )
			{
				$dp = strpos($header_value,':');
				if	( $dp!==FALSE)
					$this->header[substr($header_value,0,$dp)] = substr($header_value,$dp+1); 
				unset($this->header[$header_key]);
			}
		}
		
		$parameterString = $this->getParameterString();
		
		if	( $this->method == 'POST' )
		{
			$this->header['Content-Type'  ] = 'application/x-www-form-urlencoded';
			$this->header['Content-Length'] = strlen($parameterString);
		}
				
		// Accept-Header setzen, falls noch nicht vorhanden.
		if	( !array_key_exists('Accept',$this->header) )
			$this->header['Accept'] = '*/*';
			
		$this->responseHeader = array();

		// RFC 1945 (Section 9.3) says:
		// A user agent should never automatically redirect a request
		// more than 5 times, since such redirections usually indicate an infinite loop.
		for( $r=1; $r<=5; $r++ )
		{
			$this->header['Host'] = $this->url['host'];
			
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

				$request_header = array( $this->method.' '.$http_get.' HTTP/1.0');
				
				foreach($this->header as $header_key=>$header_value)
					$request_header[] = $header_key.': '.$header_value;
					
				$http_request = implode($lb,$request_header).$lb.$lb;

				if	( $this->method == 'GET')
					if	( !empty($parameterString) )
						$http_get .= '?'.$parameterString;
				
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
				
				$this->body = '';
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
				fclose($fp); // Verbindung brav schlie�en.


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
					
					//Html::debug($this->url,"alte URL");
					//Html::debug($location,"NEUES REDIRECT AUF");
					$this->setURL($location);
					continue; // Naechster Versuch mit umgeleiteter Adresse.
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
	 * 
	 * Beispiel:
	 * 'de_DE','de','en_GB','en' ... usw.<br>
	 * Wenn der Browser 'de_DE' anfordert, wird hier zusätzlich
	 * auch 'de' (als Fallback) ermittelt.
	 *
	 * @static
	 * @return array
	 */
	public static function getLanguages()
	{
		global $HTTP_SERVER_VARS;

		$languages = array();
		$http_languages = @$HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		foreach( explode(',',$http_languages) as $l )
		{
			list($part) = explode(';',$l); // Priorit�ten ignorieren.
			$languages[] = trim($part);

			// Aus "de_DE" das "de" extrahieren.
			$languages[] = current(explode('_',str_replace('-','_',trim($part))));
		}

		return array_unique( $languages );
	}
	
	
	/**
	 * Ermittelt die aktuelle HTTP-Adresse des Requests (inkl. Pfad, jedoch ohne Datei).
	 *
	 * @return String URL
	 */
	public static function getServer()
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
	 * Server-Fehlermeldung anzeigen.<br>
	 * 
	 * Erzeugt einen "HTTP 501 Internal Server Error". Zusaetzlich
	 * wird ein 'rollback' auf der Datenbank ausgefaehrt.
	 *
	 * @param String $message Eigener Hinweistext
	 */
	public static function serverError($message,$reason='')
	{
		if	( class_exists('Session'))
		{
			$db = Session::getDatabase();
			if	( is_object( $db ) )
				$db->rollback();
		}

		if	( class_exists('Logger')) 
			Logger::warn($message."\n".$reason);
		
		Http::sendStatus(501,'Internal Server Error',$message,$reason);
	}
	
	
	
	/**
	 * Der Benutzer ist nicht autorisiert, eine Aktion auszufuehren.
	 * 
	 * Diese Funktion erzeugt einen "HTTP 403 Not Authorized" und das
	 * Skript wird beendet.
	 *
	 * @param String $text Text
	 * @param String $message Eigener Hinweistext
	 */
	public static function notAuthorized($message='')
	{
	    Logger::warn("Security warning: $message");
		Http::sendStatus(403,'Not authorized',$message);
	}
	
	
	
	
	
	
	/**
	 * Nichts gefunden.
	 * 
	 * Diese Funktion erzeugt einen "HTTP 404 Not found" und das
	 * Skript wird beendet.
	 *
	 * @param String $text Text
	 * @param String $message Eigener Hinweistext
	 */
	public static function notFound($text,$message)
	{
		Http::sendStatus(404,'Not found',$message);
	}

	
	
	/**
	 * Kein Inhalt.
	 * 
	 * Die HTTP-Antwort stellt gegenüber dem Client klar, dass es keinen Inhalt gibt.
	 */
	public static function noContent()
	{
		header('HTTP/1.0 204 No Content');
		exit;
	}
	
	
	
	/**
	 * Schickt einen HTTP-Status zum Client und beendet das Skript.
	 *
	 * @param Integer $status HTTP-Status (ganzzahlig) (Default: 501)
	 * @param String $text HTTP-Meldung (Default: 'Internal Server Error')
	 * @param String $message Eigener Hinweistext (Default: leer)
	 * @param String $reason Technischer Grund (Default: leer)
	 */
	private static function sendStatus( $status=501,$text='Internal Server Error',$message='',$reason='' )
	{
		if	( headers_sent() )
		{
			echo "$status $text\n$message";
			exit;
		}
		
		header('HTTP/1.0 '.intval($status).' '.$text);
		
		
		$types = Http::getAccept();
		
		if	( @$_REQUEST['output']=='json' || sizeof($types)==1 && in_array('application/json',$types) )
		{
			header('Content-Type: application/json');
			require_once( OR_MODULES_DIR."util/JSON.class.".PHP_EXT );
			$json = new JSON();
			echo $json->encode( array('status'=>$status,'error'=>$text,'description'=>$message,'reason'=>$reason) );
		}
		elseif	( @$_REQUEST['output']=='xml' || sizeof($types)==1 && in_array('application/xml',$types) )
		{
			header('Content-Type: application/xml');
			require_once( OR_MODULES_DIR."util/XML.class.".PHP_EXT );
			$xml = new XML();
			$xml->root='error';
			echo $xml->encode( array('status'=>$status,'error'=>$text,'description'=>$message,'reason'=>$reason) );
		}
		else
		{
			header('Content-Type: text/html');
			$message = htmlentities($message);
			$reason  = htmlentities($reason );
			$signature = OR_TITLE.' '.OR_VERSION.' '.getenv('SERVER_SOFTWARE');
			echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Simple HttpErrorPages | MIT License | https://github.com/AndiDittrich/HttpErrorPages -->
    <meta charset="utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>We've got some trouble | Service currently unavailable</title>
    <style type="text/css">/*! normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css */html{font-family:sans-serif;line-height:1.15;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,footer,header,nav,section{display:block}h1{font-size:2em;margin:.67em 0}figcaption,figure,main{display:block}figure{margin:1em 40px}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent;-webkit-text-decoration-skip:objects}a:active,a:hover{outline-width:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:inherit}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace,monospace;font-size:1em}dfn{font-style:italic}mark{background-color:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}audio,video{display:inline-block}audio:not([controls]){display:none;height:0}img{border-style:none}svg:not(:root){overflow:hidden}button,input,optgroup,select,textarea{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{display:inline-block;vertical-align:baseline}textarea{overflow:auto}[type=checkbox],[type=radio]{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details,menu{display:block}summary{display:list-item}canvas{display:inline-block}template{display:none}[hidden]{display:none}/*! Simple HttpErrorPages | MIT X11 License | https://github.com/AndiDittrich/HttpErrorPages */body,html{width:100%;height:100%;background-color:#21232a}body{color:#fff;text-align:center;text-shadow:0 2px 4px rgba(0,0,0,.5);padding:0;min-height:100%;-webkit-box-shadow:inset 0 0 100px rgba(0,0,0,.8);box-shadow:inset 0 0 100px rgba(0,0,0,.8);display:table;font-family:"Open Sans",Arial,sans-serif}h1{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:36px}h1 small{font-size:68%;font-weight:400;line-height:1;color:#777}a{text-decoration:none;color:#fff;font-size:inherit;border-bottom:dotted 1px #707070}.lead{color:silver;font-size:21px;line-height:1.4}.cover{display:table-cell;vertical-align:middle;padding:0 20px}footer{position:fixed;width:100%;height:40px;left:0;bottom:0;color:#a0a0a0;font-size:14px}</style>
</head>
<body>
<div class="cover"><h1>Ooooh, sorry. This service is currently unavailable... <small>$text $status</small></h1><p class="lead">$message</p></div>

    <p>
        <code>
            <?php echo $reason; ?>
        </code>
    </p>

</body>
</html><?php

HTML;
		}
		exit;
	}
	
	
	/**
	 * Liefert den Mime-Type, den der Browser (oder besser: HTTP-Client) wünscht.
	 *
	 * @return array Mime-Typen, welche vom User-Agent akzeptiert werden.
	 */
	public static function getAccept()
	{
		$httpAccept = getenv('HTTP_ACCEPT');
		return $types = explode(',',$httpAccept);
	}
	
	

	/**
	 * Liefert die IPv4-Adresse des Clients. Falls der Request durch einen Proxy kam, wird
	 * versucht, die echte IP-Adresse aus dem Anfrageheader zu ermitteln.
	 * 
	 * @return Client-IPv4-Adresse
	 */
	public static function getClientIP()
	{
		$ip = '';
		
		if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )
		{
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif ( isset($_SERVER["HTTP_CLIENT_IP"]) )
		{
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif ( isset($_SERVER["REMOTE_ADDR"]) )
		{
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		
		return $ip;
	}
	
	

	/**
	 * Ermittelt den TCP/IP-Port des Clients.
	 * Achtung, bei Proxy-Zugriffen kann dies der Port des Proxys sein.
	 * 
	 * @return string TCP/IP-Port
	 */
	public static function getClientPort()
	{
		$ip = '';
		
		if ( isset($_SERVER["REMOTE_PORT"]) )
		{
			$ip = $_SERVER["REMOTE_PORT"];
		}
		
		return $ip;
	}
}

?>