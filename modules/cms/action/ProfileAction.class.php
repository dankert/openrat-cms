<?php

namespace cms\action;


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
use cms\model\BaseObject;
use cms\model\User;
use language\Language;
use LogicException;
use util\Mail;
use util\UIUtils;
use security\Base2n;
use util\Session;


/**
 * Action-Klasse zum Bearbeiten des Benutzerprofiles
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ProfileAction extends BaseAction
{
	public $security = Action::SECURITY_USER;
	
	private $user;
	var $defaultSubAction = 'edit';

	/**
	 * Konstruktor.
	 * Setzen der Benutzer-Objektes.
	 */
	function __construct()
	{
        parent::__construct();

        $this->user = Session::getUser();
	}


	/**
	 * Abspeichern des Profiles
	 */
	function editPost()
	{
		$this->user->fullname = $this->getRequestVar('fullname');
		$this->user->tel      = $this->getRequestVar('tel'     );
		$this->user->desc     = $this->getRequestVar('desc'    );
		$this->user->style    = $this->getRequestVar('style'   );
		$this->user->language = $this->getRequestVar('language');
		$this->user->timezone = $this->getRequestVar('timezone');
		$this->user->hotp     = $this->hasRequestVar('hotp'    );
		$this->user->totp     = $this->hasRequestVar('totp'    );
		
		
		$this->setStyle( $this->user->style ); // Style sofort anwenden
		Session::setUser( $this->user );
		
		if	( !empty($this->user->fullname) )
		{
			$this->user->save();
			$this->setStyle($this->user->style);
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('fullname');
		}
		
		
		// Ausgewählte Sprache sofort verwenden.
		$l = $this->getRequestVar('language');

        $this->setLanguage($l);
	}

	
	
	/**
	 * Anzeigen einer Maske zum Ändern des Kennwortes.
	 */
	function pwView()
	{
		// Kennwortänderung funktioniert natürlich nur in der internen Datenbank.
		//
		// Hier wird festgestellt, ob der Benutzer sich über die interne Datenbank angemeldet hat.
		// Nur dann kann man auch sein Kennwort ändern.
		$user             = $this->getUserFromSession();
		$pwchangePossible = in_array( strtolower($user->loginModuleName), array('cookieauth','internal'));
		$this->setTemplateVar('pwchange_enabled', $pwchangePossible);
	}
	
	

	/**
	 * Anzeige einer Maske zum Ändern der E-Mail-Adresse
	 */
	function mailView()
	{
	}
	
	
	
	/*
	 * Es wird eine E-Mail mit einem Freischaltcode an die eingegebene Adresse geschickt.
	 */
	function mailPost()
	{
		srand ((double)microtime()*1000003);
		$code = rand(); // Zufalls-Freischaltcode erzeugen
		$newMail = $this->getRequestVar('mail');

		if	( empty($newMail) )
		{
			// Keine E-Mail-Adresse eingegeben.
			$this->addValidationError('mail');
			return;
		}
		else
		{
			// Der Freischaltcode wird in der Sitzung gespeichert.
			Session::set('mailChangeCode',$code   );
			Session::set('mailChangeMail',$newMail);
			
			// E-Mail an die neue Adresse senden.
			$mail = new Mail( $newMail,'mail_change_code' );
			$mail->setVar('code',$code                 );
			$mail->setVar('name',$this->user->getName());
			
			if	( $mail->send() )
			{
				$this->addNotice('user',$this->user->name,'mail_sent',OR_NOTICE_OK); // Meldung
			}
			else
			{
				$this->addNotice('user',$this->user->name,'mail_not_sent',OR_NOTICE_ERROR,array(),$mail->error); // Meldung
				return;
			}
		}
	}

	
	
	/**
	 * Anzeige einer Maske, in die der Freischaltcode für das
	 * Ändern der E-Mail-Adresse eingetragen werden muss.
	 */
	function confirmmailView()
	{
	}
	
	

	/**
	 * Abspeichern der neuen E-Mail-Adresse
	 */
	function confirmmailPost()
	{
		$sessionCode       = Session::get('mailChangeCode');
		$newMail           = Session::get('mailChangeMail');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $sessionCode == $inputRegisterCode )
		{
			// Best�tigungscode stimmt �berein.
			// E-Mail-Adresse �ndern.	
			$this->user->mail = $newMail;
			$this->user->save();
			
			$this->addNotice('user',$this->user->name,'SAVED',OR_NOTICE_OK);
		}
		else
		{
			// Best�tigungscode stimmt nicht.
			$this->addValidationError('code','code_not_match');
		}
		
	}
	
	
	
	public function pwPost()
	{
		if	( ! $this->user->checkPassword( $this->getRequestVar('act_password') ) )
		{
			$this->addValidationError('act_password');
		}
		elseif	( $this->getRequestVar('password1') == '' )
		{
			$this->addValidationError('password1');
		}
		elseif ( $this->getRequestVar('password1') != $this->getRequestVar('password2') )
		{
			$this->addValidationError('password2','PASSWORDS_DO_NOT_MATCH');
		}
		elseif ( strlen($this->getRequestVar('password1'))<intval(config('security','password','min_length')) )
		{
			$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=>config('security','password','min_length')));
		}
		else
		{
			$this->user->setPassword( $this->getRequestVar('password1') );
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}
	}



	/**
	 * Anzeige aller Benutzer-Eigenschaften.
	 */
	function editView()
	{
	    $issuer  = urlencode(config('application','operator'));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];
	    
	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(hex2bin($this->user->otpSecret));
	    $counter = $this->user->hotpCount;
	    
	    $this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
		$this->setTemplateVar('timezone_list',timezone_identifiers_list() );
		
		$languages = explode(',',config('i18n','available'));
		foreach($languages as $id=>$name)
		{
		    unset($languages[$id]);
		    $languages[$name] = $name;
		}
		$this->setTemplateVar('language_list',$languages);
		
		$this->setTemplateVars(
		    $this->user->getProperties() +
		    array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
		    'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
		    )
		);
		
		
	}

	
	
	/**
	 * Anzeige aller Gruppen des angemeldeten Benutzers.
	 *
	 */
	function membershipsView()
	{
		$this->setTemplateVar( 'groups',$this->user->getGroups() );
	}
	
	
	
	/**
	 * @param String $name Menüpunkt
	 * @return boolean true, falls Menüpunkt zugelassen
	 */
	function checkMenu( $name )
	{
		global $conf;
		
		switch( $name )
		{
			case 'pwchange':
				// Die Funktion "Kennwort setzen" ist nur aktiv, wenn als Authentifizierungs-Backend
				// auch die interne Benutzerdatenbank eingesetzt wird.
				return     @$conf['security']['auth']['type'] == 'database'
				       && !@$conf['security']['auth']['userdn'];
				
			default:
				return true;
		}	
	}

    /**
     * Setzt eine Sprache für den Benutzer.
     *
     * @param $l string Sprache
     */
    public function setLanguage($l)
    {
        $conf = Session::getConfig();
        $language = new \language\Language();
        $conf['language'] = $language->getLanguage($l,PRODUCTION);
        $conf['language']['language_code'] = $l;
        Session::setConfig($conf);
        $this->setCookie('or_language',$l);
    }



    /**
     * Ermittelt die letzten Änderungen, die durch den aktuellen Benutzer in allen Projekten gemacht worden sind.
     */
    public function historyView()
    {
        $lastChanges = $this->user->getLastChanges();

        $timeline = array();

        foreach( $lastChanges as $entry )
        {
            $timeline[ $entry['objectid'] ] = $entry;
            $baseObject = new BaseObject( $entry['objectid']);
            $baseObject->objectLoad();
            $timeline[ $entry['objectid'] ]['type'] = $baseObject->getType();
        }
        $this->setTemplateVar('timeline', $timeline);
    }



    public function userinfoView()
	{

		$user = Session::getUser();

		$currentStyle = $this->getUserStyle($user);
		$this->setTemplateVar('style',$currentStyle);


		$styleConfig     = config('style-default'); // default style config
		$userStyleConfig = config('style', $currentStyle); // user style config

		if (is_array($userStyleConfig))
			$styleConfig = array_merge($styleConfig, $userStyleConfig ); // Merging user style into default style
		else
			; // Unknown style name, we are ignoring this.

		// Theme base color for smartphones colorizing their status bar.
		$this->setTemplateVar('theme-color', UIUtils::getColorHexCode($styleConfig['title_background_color']));
	}


	/**
	 * All UI settings.
	 */
	public function uisettingsView() {

		$this->setTemplateVar('settings',Config()->get('ui') );
	}


	/**
	 * The user-dependent language codes.
	 */
	public function languageView() {

    	$this->setTemplateVar('language',Config()->get('language') );
	}



	public function pingView()
	{
		$this->setTemplateVar('pong',1);
	}



	/**
	 * @param User $user
	 * @return string
	 */
	private function getUserStyle( $user )
	{
		// Theme für den angemeldeten Benuter ermitteln
		if  ( $user && isset(config('style')[$user->style]))
			$style = $user->style;
		else
			$style = config('interface', 'style', 'default');

		return $style;
	}


}