<?php


/**
 * Open-Id Authentisierung gem�� OpenId-Spezifikation 1.0.
 *
 */
class OpenId
{
	/**
	 * Open-Id Server, an den die Authentisierungsanfrage gestellt wird.
	 *
	 * @var String
	 */
	var $server;
	
	
	/**
	 * Informationen zum Benutzer.
	 *
	 * @var Array
	 */
	var $info;
	
	/**
	 * Open-Id Identity.
	 *
	 * @var String
	 */
	var $identity;
	
	/**
	 * Fehlermeldung (falls vorhanden).
	 *
	 * @var String
	 */
	var $error;

	/**
	 * OpenId-Benutzername.
	 *
	 * @var String
	 */
	var $user;

	/**
	 * OpenId-Provider.
	 *
	 * @var String
	 */
	var $provider;

	
	var $supportAX;
	var $supportSREG;
	var $supportOpenId1_1;
	var $supportOpenId2_0;
	
	
	/**
	 * Neue Open-Id Anfrage.
	 *
	 * @param String $user
	 * @return OpenId
	 */
	function OpenId( $provider='',$user='' )
	{
		$this->provider = $provider;
		$this->user     = $user;
	}

	
	/**
	 * Stellt fest, ob der Server vertrauensw�rdig ist.
	 *
	 * @return true, wenn vertrauensw�rdig.
	 */
	function serverOk()
	{
		global $conf;
		$servers = $conf['security']['openid']['trusted_server'];
		
		if	( empty($servers) )
		{
			return true;
		}
		else
		{
			$serverList = explode(',',$servers);
			
			$http = new Http($this->server);
			if	( !in_array($http->url['host'],$serverList) )
			{
				$this->error = 'Server '.$this->server.' is not trusted';
				return false;
			}
			else
				return true;
		}
		
	}
	
	
	
	/**
	 * Authentisierung Schritt 1.<br>
	 * Ermitteln der Identity.
	 *
	 * @return boolean TRUE, wenn Identity ermittelt wurde.
	 */
	function login()
	{
		if	( $this->provider != 'identity' ) 
		{
			$this->user     = config('security','openid','provider.'.$this->provider.'.xrds_uri'); 
			$this->identity = 'http://specs.openid.net/auth/2.0/identifier_select'; 
		}
		// Schritt 1: Identity aus Yadis-Dokument laden.
		$this->getIdentityFromYadis();

		// Schritt 2: Fallback auf HTML-Dokument.
		if	( empty($this->server) )
		{
			$this->getIdentityFromHtmlMetaData();
		}
		
		// Falls immer noch kein Servername gefunden wurde, dann Abbruch.
		if	( empty($this->server) )
		{
			if	( empty($this->error) )
				$this->error = 'Unable to locate OpenId-Server in URL';
			return false;
		}
		
		if	( !$this->serverOk() )
			return false; // Server nicht vertrauenswuerdig.
		
		if	( empty($this->identity) )
			// Falls die Identity bis hierher nicht deligiert wurde...
			// Lt. Spezifikation mit Prefix "http://".
			$this->identity = 'http://'.$this->user;
		
		return true;
	}
	
	
	
	/**
	 * Erzeugt einen HTTP-Redirect auf den OpenId-Provider.
	 */
	function redirect()
	{
		global $conf;
		
		$this->handle = md5(microtime().session_id());

		$redirHttp = new Http($this->server);
		
		if	( $this->supportOpenId2_0 )
			$redirHttp->requestParameter['openid.ns'       ] = 'http://specs.openid.net/auth/2.0';
			
		$redirHttp->requestParameter['openid.mode'         ] = 'checkid_setup';
		$redirHttp->requestParameter['openid.identity'     ] = $this->identity;
		
		if	( $this->supportOpenId2_0 )
			$redirHttp->requestParameter['openid.claimed_id'] = $this->identity;
		

		// Profilangaben anfordern. E-Mail wird ben�tigt, Name und Sprache sind optional.
		
		if	( $this->supportAX )
		{
			Logger::info("Server is using OpenID Attribute Exchange 1.0");
			$redirHttp->requestParameter['openid.ns.ax'            ] = 'http://openid.net/srv/ax/1.0';
			$redirHttp->requestParameter['openid.ax.mode'          ] = 'fetch_request';
			$redirHttp->requestParameter['openid.ax.type.email'    ] = 'http://axschema.org/contact/email';
			$redirHttp->requestParameter['openid.ax.type.username' ] = 'http://axschema.org/namePerson/friendly';
		    $redirHttp->requestParameter['openid.ax.type.fullname' ] = 'http://axschema.org/namePerson';
		    $redirHttp->requestParameter['openid.ax.type.language' ] = 'http://axschema.org/pref/language';
		    $redirHttp->requestParameter['openid.ax.required'      ] = 'username,email';
		    $redirHttp->requestParameter['openid.ax.if_available'  ] = 'language,fullname';
		}
		
		if	( $this->supportSREG )
		{
			Logger::info("Server is using OpenID Simple Registration Extension 1.0");
			$redirHttp->requestParameter['openid.ns.sreg'      ] = 'http://openid.net/sreg/1.0';
			$redirHttp->requestParameter['openid.sreg.required'] = 'email,nickname';
			$redirHttp->requestParameter['openid.sreg.optional'] = 'fullname,language';
		}
		
		$trustRoot = @$conf['security']['openid']['trust_root'];
		$server = Http::getServer();
		if	( empty($trustRoot) )
			$trustRoot = $server;
			
		$redirHttp->requestParameter['openid.trust_root'   ] = slashify($trustRoot);
		$redirHttp->requestParameter['openid.return_to'    ] = slashify($server).'openid.'.PHP_EXT;
		//$redirHttp->requestParameter['openid.realm'        ] = slashify($server).'openid.'.PHP_EXT;
		$redirHttp->requestParameter['openid.assoc_handle' ] = $this->handle;

		$redirHttp->sendRedirect(); // Browser umleiten.
		exit;                       // Ende.
	}
	
	
	
	/**
	 * Ermittelt OpenId-Server und OpenId-Identity aus Yadis-Dokument.<br>
	 *
	 * @return unknown
	 */
	function getIdentityFromYadis()
	{
		$http = new Http($this->user);
//		$http->url['host'] = $this->user;

		$http->header[] = 'Accept: application/xrds+xml';
		if	( ! $http->request() )
		{
			$this->error = 'Unable to get XML delegate information';
			return false;
		}
		
		//die();
		$p = xml_parser_create();
		$ok = xml_parse_into_struct($p, $http->body, $vals, $index);
		xml_parser_free($p);

		foreach( $vals as $tag )
		{
			if	( strtolower($tag['tag']) == 'type' )
			{
				if	( $tag['value'] == 'http://openid.net/srv/ax/1.0' )
					$this->supportAX = true;
					
				if	( $tag['value'] == 'http://openid.net/sreg/1.0' )
					$this->supportSREG = true;
					
				if	( $tag['value'] == 'http://openid.net/signon/1.1' )
					$this->supportOpenId1_1 = true;
					
				if	( $tag['value'] == 'http://specs.openid.net/auth/2.0/server' )
					$this->supportOpenId2_0 = true;
			}
			
			if	( strtolower($tag['tag']) == 'uri' )
			{
				$this->server = $tag['value'];
			}

			if	( strtolower($tag['tag']) == 'openid:delegate' )
			{
				$this->identity = $tag['value'];
			}
		}
		
		if	( !$this->supportOpenId1_1 && !$this->supportOpenId2_0 )
		{
			$this->error = 'Only OpenId 1.1 and 2.0 is supported but this identity-provider does not seem to support any of these.';
			return false;
		}
		if	( !$this->supportAX && !$this->supportSREG )
		{
			$this->error = 'The identity-provider must support either Attribute-Exchange (AX) oder Simple-Registration (SREG), but it does not seem to support any of these.';
			return false;
		}
	}

	
	/**
	 * Ermittelt OpenId-Server und OpenId-Identity aus HTML Meta-Tags.<br>
	 */
	function getIdentityFromHtmlMetaData()
	{
		$http = new Http($this->user);
//		$http = new Http();
//		$http->url['host'] = $this->user;
		$http->header[] = 'Accept: text/html';

		if	( ! $http->request() )
		{
			$this->error = 'Unable to get HTML delegate information';
			return false;
		}
		
		$seite = $http->body;
		
		// Die Meta-Tags mit regul�rem Ausdruck auslesen.
		$treffer = array();
		preg_match('/rel="openid.server"\s+href="(\S+)"/',$seite,$treffer);
		if	( count($treffer) >= 1 )
			$this->server = $treffer[1];

		$treffer = array();
		preg_match('/rel="openid.delegate"\s+href="(\S+)"/',$seite,$treffer);
		if	( count($treffer) >= 1 )
			$this->identity = $treffer[1];
	}
	

	/**
	 * Ermittelt den Hostnamen aus der Identity.
	 *
	 * @return String
	 */
	function getUserFromIdentiy()
	{
		if	( $this->provider == 'identity' )
		{
			$http = new Http($this->identity);
			return $http->url['host'];
		}
		else
		{
			$attribute_name = config('provider.'.$this->provider.'.map_attribute');
			return $this->info[$attribute_name];
		}
	}
		
	
	/**
	 * Open-Id Login, �berpr�fen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zur�ck.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Best�tigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	function checkAuthentication()
	{
		global $REQ,
		       $conf;
		       
		if	( $REQ['openid_invalidate_handle'] != $this->handle )
		{
			$this->error = 'Association-Handle mismatch.';
			return false;
		}

		if	( $REQ['openid_mode'] != 'id_res' )
		{
			$this->error ='Open-Id: Unknown mode:'.$REQ['openid_mode'];
			return false;
		}
		
		if	( $this->provider=='identity' && $REQ['openid_identity'] != $this->identity )
		{
			$this->error ='Open-Id: Identity mismatch. Wrong identity:'.$REQ['openid_identity'];
			return false;
		}
		

		$params = array();
		
		if	( $this->supportAX )
			foreach( $REQ as $request_key=>$request_value )
				if	(  substr($request_key,0,10)=='openid_ns_' && $request_value == 'http://openid.net/srv/ax/1.0' )
					$axPrefix = substr($request_key,10);
		
		foreach( $REQ as $request_key=>$request_value )
		{
			// Benutzer-Attribute ermitteln.
			if	( $this->supportSREG && substr($request_key,0,12)=='openid_sreg_' )
			{
				$this->info[ substr($request_key,12) ] = $request_value;
			}			
			elseif	( $this->supportAX && substr($request_key,0,14+strlen($axPrefix))=='openid_'.$axPrefix.'_value_' )
			{
				$this->info[ substr($request_key,14+strlen($axPrefix)) ] = $request_value;
			}
						
			// Uebelstes Gefrickel. Grund dafuer ist, dass PHP die Punkte in Request-Variablen durch Unterstriche ersetzt. Und wir müssen das
			// hier zurücksetzen.
			// TODO: Original-Request-Variable ermitteln?
			if	( substr($request_key,0,7)=='openid_' )
				if	( $this->supportAX && substr($request_key,0,8+strlen($axPrefix))=='openid_'.$axPrefix.'_')
					$params[ str_replace('_','.',$request_key) ] = $request_value;
				elseif( $this->supportAX && $request_key == 'openid_ns_'.$axPrefix)
					$params[ str_replace('_','.',$request_key) ] = $request_value;
				else
					$params['openid.'.substr($request_key,7) ] = $request_value;			
		}
		$params['openid.mode'] = 'check_authentication';
		
		$checkRequest = new Http($this->server);
		
		$checkRequest->method = 'POST'; // Spezifikation verlangt POST.
		$checkRequest->header['Accept'] = 'text/plain';
		$checkRequest->requestParameter = $params;
		
		if	( ! $checkRequest->request() )
		{
			// Der HTTP-Request ging in die Hose.
			$this->error = $checkRequest->error;
			return false;
		}
		//Html::debug($checkRequest);
		
		// Analyse der HTTP-Antwort, Parsen des BODYs.
		// Die Anmeldung ist best�tigt, wenn im BODY die Zeile "is_valid:true" vorhanden ist.
		// Siehe Spezifikation Kapitel 4.4.2
		$result = array();
		foreach( explode("\n",$checkRequest->body) as $line )
		{
			$pair = explode(':',trim($line));
			if	(count($pair)==2)
				$result[strtolower($pair[0])] = strtolower($pair[1]);
		}
		
		if	( !array_key_exists('is_valid',$result) )
		{
			// Zeile nicht gefunden.
			$this->error = 'Undefined Open-Id response: "is_valid" expected, but not found';
			return false;
		}
		elseif	( $result['is_valid'] == 'true' )
		{
			// Anmeldung wurde mit "is_valid:true" best�tigt.
			return true;
		}
		else
		{
			// Bestaetigung wurde durch den OpenId-Provider abgelehnt.
			$this->error = 'Server refused login.';
			return false;
		}
	}
	
	
	/**
	 * Liefert die Query-Parameter aus der aktuellen URL.<br>
	 * <br>
	 * PHP hat leider die sehr bescheuerte Angewohnheit, Punkte und Leerzeichen in Request-Variablen
	 * durch Unterstriche zu ersetzen. Diese Funktion liefert die GET-Parameter ohne diese Ersetzung.
	 * 
	 * @return Parameter der aktuellen URL
	 */
	function getQueryParamList()
	{
		// Quelle: php.net
		$str = $_SERVER['QUERY_STRING'];
		$op = array();
		$pairs = explode("&", $str);
		foreach ($pairs as $pair)
		{
			list($k, $v) = array_map("urldecode", explode("=", $pair));
			$op[$k] = $v;
		}
		
		return $op;
	}

	
}

?>