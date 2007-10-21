<?php

class OpenId
{
	/**
	 * Open-Id Server, an den die Authentisierungsanfrage gestellt wird.
	 *
	 * @var String
	 */
	var $server;
	
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
	function OpenId( $user )
	{
		$this->user = $user;
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
			$this->error = 'Unable to locate a OpenId-Server in URL';
			return false;
		}
		
		if	( empty($this->identity) )
			// Falls die Identity bis hierher nicht deligiert wurde...
			// Lt. Spezifikation mit Prefix "http://".
			$this->identity = 'http://'.$openid_user;
		
		return true;
	}
	
	
	
	/**
	 * Erzeugt einen HTTP-Redirect auf den OpenId-Provider.
	 */
	function redirect()
	{
		global $conf;
		
		$openid_handle = md5(microtime().session_id());
		Session::set('openid_user'    ,$this->identity );
		Session::set('openid_server'  ,$this->server   );
		Session::set('openid_delegate',$this->identity );
		Session::set('openid_handle'  ,$openid_handle  );

		$redirHttp = new Http($this->server);
		$redirHttp->requestParameter['openid.mode'         ] = 'checkid_setup';
		$redirHttp->requestParameter['openid.identity'     ] = $this->identity;
		
		$redirHttp->requestParameter['openid.sreg.required'] = 'email';
		$redirHttp->requestParameter['openid.sreg.optional'] = 'fullname,language';
		$trustRoot = @$conf['security']['openid']['trust_root'];
		$server = Http::getServer();
		if	( empty($trustRoot) )
			$trustRoot = $server.'/';
		$redirHttp->requestParameter['openid.trust_root'   ] = $trustRoot;
		$redirHttp->requestParameter['openid.return_to'    ] = $server.'/openid.'.PHP_EXT;
		$redirHttp->requestParameter['openid.assoc_handle' ] = $openid_handle;

		$redirHttp->sendRedirect();
	}
	
	
	
	/**
	 * Ermittelt OpenId-Server und OpenId-Identity aus Yadis-Dokument.<br>
	 *
	 * @return unknown
	 */
	function getIdentityFromYadis()
	{
		$http = new Http();
		$http->url['host'] = $this->user;

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
		$http = new Http();
		$http->url['host'] = $this->user;
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
			$this->identity = $treffer[1];

		$treffer = array();
		preg_match('/rel="openid.delegate"\s+href="(\S+)"/',$seite,$treffer);
		if	( count($treffer) >= 1 )
			$this->identity = $treffer[1];
	}
		
}

?>