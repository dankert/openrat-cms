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
	function OpenId( $user='' )
	{
		$this->user = $user;
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
			return false; // Server nicht vertrauensw�rdig.
		
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
		/*
doodle:
https://www.google.com/accounts/o8/ud?
openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&
openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select
&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select
&openid.mode=checkid_setup
&openid.ns.ext1=http%3A%2F%2Fopenid.net%2Fsrv%2Fax%2F1.0
&openid.ext1.mode=fetch_request
&openid.ext1.type.email=http%3A%2F%2Faxschema.org%2Fcontact%2Femail
&openid.ext1.type.fullname=http%3A%2F%2Faxschema.org%2FnamePerson
&openid.ext1.type.firstname=http%3A%2F%2Faxschema.org%2FnamePerson%2Ffirst
&openid.ext1.type.lastname=http%3A%2F%2Faxschema.org%2FnamePerson%2Flast
&openid.ext1.type.language=http%3A%2F%2Faxschema.org%2Fpref%2Flanguage
&openid.ext1.type.timezone=http%3A%2F%2Faxschema.org%2Fpref%2Ftimezone
&openid.ext1.type.dob=http%3A%2F%2Faxschema.org%2FbirthDate
&openid.ext1.type.gender=http%3A%2F%2Faxschema.org%2Fperson%2Fgender
&openid.ext1.required=email%2Cfullname%2Cfirstname%2Clastname
&openid.ext1.if_available=language%2Ctimezone%2Cdob%2Cgender
&openid.ns.sreg=http%3A%2F%2Fopenid.net%2Fextensions%2Fsreg%2F1.1
&openid.sreg.required=email%2Cfullname
&openid.sreg.optional=language%2Ctimezone%2Cdob%2Cgender
&openid.sreg.policy_url=http%3A%2F%2Fdoodle.com%2Fabout%2Ftos.html
&openid.return_to=https%3A%2F%2Fdoodle.com%2Fmydoodle%2FopenIdAuth
&openid.assoc_handle=AOQobUe2ez4x3-uPrza74M3s6dFXM-guMR8Q8nt6OBZ2Bbr-ehJ1y0n1
&openid.realm=https%3A%2F%2Fdoodle.com
or:
https://www.google.com/accounts/o8/ud?openid.mode=checkid_setup&openid.identity=http%3A%2F%2Fhttp%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fid&openid.sreg.required=email&openid.sreg.optional=fullname%2Clanguage&openid.trust_root=http%3A%2F%2Flocalhost%2F~dankert%2Fcms-test%2F09%2F&openid.return_to=http%3A%2F%2Flocalhost%2F~dankert%2Fcms-test%2F09%2Fopenid.php&openid.assoc_handle=ba1a257963793d3da613012507f8b3dc


https://www.google.com/accounts/o8/ud?openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.mode=checkid_setup&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.sreg.required=email&openid.sreg.optional=fullname%2Clanguage&openid.trust_root=http%3A%2F%2Flocalhost%2F~dankert%2Fcms-test%2F09%2F&openid.return_to=http%3A%2F%2Flocalhost%2F~dankert%2Fcms-test%2F09%2Fopenid.php&openid.assoc_handle=49d81537840793d1c9c6dd81ba87481d


antwort von google an or:
http://localhost/~dankert/cms-test/09/openid.php?openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&openid.mode=id_res
&openid.op_endpoint=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fud&
openid.response_nonce=2010-11-04T23%3A25%3A28ZfqphjoO3sRtDqw
&openid.return_to=http%3A%2F%2Flocalhost%2F~dankert%2Fcms-test%2F09%2Fopenid.php
&openid.invalidate_handle=68190efac8e20589c43ca83abc48a859
&openid.assoc_handle=AOQobUcqrjsOLlzkJgE5QFWdFpikCKcFHbVtGMOG4L3ktOp4jS9NKpi
7&openid.signed=op_endpoint%2Cclaimed_id%2Cidentity%2Creturn_to%2Cresponse_nonce%2Cassoc_handle
&openid.sig=bErVC%2FlYpm%2Bi1HVAIe4vvhSld2g%3D
&openid.identity=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fid%3Fid%3DAItOawn9xVhyM9_Yf-XkfYtSZnSBP5hgXIuVAUA
&openid.claimed_id=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fid%3Fid%3DAItOawn9xVhyM9_Yf-XkfYtSZnSBP5hgXIuVAUA

antwort von google an doodle:
https://doodle.com/mydoodle/openIdAuth?openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&openid.mode=id_res&openid.op_endpoint=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fud&openid.response_nonce=2010-11-05T00%3A07%3A11Z56FFqcL6B5teKQ&openid.return_to=https%3A%2F%2Fdoodle.com%2Fmydoodle%2FopenIdAuth&openid.assoc_handle=AOQobUe2ez4x3-uPrza74M3s6dFXM-guMR8Q8nt6OBZ2Bbr-ehJ1y0n1&openid.signed=op_endpoint%2Cclaimed_id%2Cidentity%2Creturn_to%2Cresponse_nonce%2Cassoc_handle%2Cns.ext1%2Cext1.mode%2Cext1.type.firstname%2Cext1.value.firstname%2Cext1.type.email%2Cext1.value.email%2Cext1.type.lastname%2Cext1.value.lastname&openid.sig=eDdaxAhDl8IOgPLjgJB25pG9hKA%3D&openid.identity=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fid%3Fid%3DAItOawkhGOOFbCs1EsijGYKG_afWsM8AfHedV5s&openid.claimed_id=https%3A%2F%2Fwww.google.com%2Faccounts%2Fo8%2Fid%3Fid%3DAItOawkhGOOFbCs1EsijGYKG_afWsM8AfHedV5s&openid.ns.ext1=http%3A%2F%2Fopenid.net%2Fsrv%2Fax%2F1.0&openid.ext1.mode=fetch_response&openid.ext1.type.firstname=http%3A%2F%2Faxschema.org%2FnamePerson%2Ffirst&openid.ext1.value.firstname=Jan&openid.ext1.type.email=http%3A%2F%2Faxschema.org%2Fcontact%2Femail&openid.ext1.value.email=jandunkerbeck%40googlemail.com&openid.ext1.type.lastname=http%3A%2F%2Faxschema.org%2FnamePerson%2Flast&openid.ext1.value.lastname=Dunkerbeck

*/
		//$this->identity = 'http://specs.openid.net/auth/2.0/identifier_select';
		$openid_handle = md5(microtime().session_id());
		Session::set('openid_user'    ,$this->user     );
		Session::set('openid_server'  ,$this->server   );
		Session::set('openid_identity',$this->identity );
		Session::set('openid_handle'  ,$openid_handle  );

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
		
		//Html::debug(htmlentities($http->body));
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
		$http = new Http($this->identity);
		return $http->url['host'];
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
		       
		$this->user      = Session::get('openid_user'    );
		$this->server    = Session::get('openid_server'  );
		$this->identity  = Session::get('openid_identity');
		$openid_handle   = Session::get('openid_handle'  );

		if	( $REQ['openid_invalidate_handle'] != $openid_handle )
		{
			$this->error = 'Association-Handle mismatch.';
			return false;
		}

		if	( $REQ['openid_mode'] != 'id_res' )
		{
			$this->error ='Open-Id: Unknown mode:'.$REQ['openid_mode'];
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
		// Die Anmeldung ist best�tigt, wenn im BODY die Zeile "is_valid:true" vorhanden ist.
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
			// Anmeldung wurde mit "is_valid:true" best�tigt.
			return true;
		}
		else
		{
			// Best�tigung wurde durch den OpenId-Provider abgelehnt.
			$this->error = 'Server refused login.';
			return false;
		}
	}
}

?>