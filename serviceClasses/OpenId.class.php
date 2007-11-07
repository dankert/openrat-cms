<?php


/**
 * Open-Id Authentisierung gemäß OpenId-Spezifikation 1.0.
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
	 * Neue Open-Id Anfrage.
	 *
	 * @param String $user
	 * @return OpenId
	 */
	function OpenId( $user='' )
	{
		$this->user = $user;
	}

	
	/**
	 * Stellt fest, ob der Server vertrauenswürdig ist.
	 *
	 * @return true, wenn vertrauenswürdig.
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
			return false; // Server nicht vertrauenswürdig.
		
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
		
		$openid_handle = md5(microtime().session_id());
		Session::set('openid_user'    ,$this->user     );
		Session::set('openid_server'  ,$this->server   );
		Session::set('openid_identity',$this->identity );
		Session::set('openid_handle'  ,$openid_handle  );

		$redirHttp = new Http($this->server);
		$redirHttp->requestParameter['openid.mode'         ] = 'checkid_setup';
		$redirHttp->requestParameter['openid.identity'     ] = $this->identity;

		// Profilangaben anfordern. E-Mail wird benötigt, Name und Sprache sind optional.
		$redirHttp->requestParameter['openid.sreg.required'] = 'email';
		$redirHttp->requestParameter['openid.sreg.optional'] = 'fullname,language';
		
		$trustRoot = @$conf['security']['openid']['trust_root'];
		$server = Http::getServer();
		if	( empty($trustRoot) )
			$trustRoot = $server;
			
		$redirHttp->requestParameter['openid.trust_root'   ] = slashify($trustRoot);
		$redirHttp->requestParameter['openid.return_to'    ] = slashify($server).'openid.'.PHP_EXT;
		$redirHttp->requestParameter['openid.assoc_handle' ] = $openid_handle;

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
		
//		Html::debug(htmlentities($http->body));
		$p = xml_parser_create();
		$ok = xml_parse_into_struct($p, $http->body, $vals, $index);
		xml_parser_free($p);

		foreach( $vals as $tag )
		{
			if	( strtolower($tag['tag']) == 'uri' )
			{
				$this->server = $tag['value'];
			}

			if	( strtolower($tag['tag']) == 'openid:delegate' )
			{
				$this->identity = $tag['value'];
			}
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
		
		// Die Meta-Tags mit regulärem Ausdruck auslesen.
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
		$http = new Http($this->identity);
		return $http->url['host'];
	}
		
	
	/**
	 * Open-Id Login, Überprüfen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zurück.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Bestätigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	function checkAuthentication()
	{
		global $REQ,
		       $conf;
		       
		$this->user      = Session::get('openid_user'    );
		$this->server    = Session::get('openid_server'  );
		$this->identity  = Session::get('openid_identity');
		$openid_handle   = Session::get('openid_handle'  );

		if	( $REQ['openid_invalidate_handle'] != $openid_handle )
		{
			$this->error = 'Association-Handle mismatch.';
			return false;
		}

		if	( $REQ['openid_identity'] != $this->identity )
		{
			$this->error ='Open-Id: Identity mismatch. Wrong identity:'.$REQ['openid_identity'];
			return false;
		}
		

		$params = array();
		
		foreach( $REQ as $request_key=>$request_value )
		{
			if	( substr($request_key,0,12)=='openid_sreg_' )
			{
				$params['openid.sreg.'.substr($request_key,12) ] = $request_value;			
				$this->info[ substr($request_key,12) ] = $request_value;
			}			
			elseif	( substr($request_key,0,7)=='openid_' )
				$params['openid.'.substr($request_key,7) ] = $request_value;			
		}
		$params['openid.mode'] = 'check_authentication';
		
		$checkRequest = new Http($this->server);
		
		$checkRequest->method = 'POST'; // Spezifikation verlangt POST.
		$checkRequest->requestParameter = $params;
		
		if	( ! $checkRequest->request() )
		{
			// Der HTTP-Request ging in die Hose.
			$this->error = $checkRequest->error;
			return false;
		}

		// Analyse der HTTP-Antwort, Parsen des BODYs.
		// Die Anmeldung ist bestätigt, wenn im BODY die Zeile "is_valid:true" vorhanden ist.
		// Siehe Spezifikation Kapitel 4.4.2
		$valid = null;
		foreach( explode("\n",$checkRequest->body) as $line )
		{
			$pair = explode(':',trim($line));
			if	(count($pair)==2 && strtolower($pair[0])=='is_valid')
				$valid = (strtolower($pair[1])=='true');
		}
		
		if	( is_null($valid) )
		{
			// Zeile nicht gefunden.
			$this->error = 'Undefined Open-Id response: '.$response;
			return false;
		}
		elseif	( $valid )
		{
			// Anmeldung wurde mit "is_valid:true" bestätigt.
			return true;
		}
		else
		{
			// Bestätigung wurde durch den OpenId-Provider abgelehnt.
			$this->error = 'Server refused login.';
			return false;
		}
	}
}

?>