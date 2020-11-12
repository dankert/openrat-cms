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
use cms\base\Configuration;
use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\User;
use language\Language;
use language\Messages;
use logger\Logger;
use LogicException;
use security\Password;
use util\exception\ValidationException;
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
		
		
		Session::setUser( $this->user );
		
		if	( !empty($this->user->fullname) )
		{
			$this->user->save();
			$this->addNoticeFor( $this->user,Messages::SAVED);
		}
		else
		{
			$this->addValidationError('fullname');
		}
		
		
		// Ausgewählte Sprache sofort verwenden.
		$l = $this->getRequestVar('language');

		if   ( $l )
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
		$pwchangePossible = $user->type == User::AUTH_TYPE_INTERNAL;
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
			throw new ValidationException('mail');
		}
		else
		{
			// Der Freischaltcode wird in der Sitzung gespeichert.
			Session::set( Session::KEY_MAIL_CHANGE_CODE,$code   );
			Session::set( Session::KEY_MAIL_CHANGE_MAIL,$newMail);
			
			// E-Mail an die neue Adresse senden.
			$mail = new Mail( $newMail,'mail_change_code' );
			$mail->setVar('code',$code                 );
			$mail->setVar('name',$this->user->getName());
			
			if	( $mail->send() )
			{
				$this->addNoticeFor( $this->user, Messages::MAIL_SENT);
			}
			else
			{
				Logger::warn('Mail could not be sent: '.$mail->error);
				$this->addNoticeFor($this->user, Messages::MAIL_NOT_SENT,[],$mail->error); // Meldung
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
		$sessionCode       = Session::get( Session::KEY_MAIL_CHANGE_CODE );
		$newMail           = Session::get( Session::KEY_MAIL_CHANGE_MAIL );
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $sessionCode == $inputRegisterCode )
		{
			// Best�tigungscode stimmt �berein.
			// E-Mail-Adresse �ndern.	
			$this->user->mail = $newMail;
			$this->user->save();
			
			$this->addNoticeFor( $this->user,Messages::SAVED );
		}
		else
		{
			// Validation code does not match
			throw new ValidationException('code',Messages::CODE_NOT_MATCH );
		}
		
	}
	
	
	
	public function pwPost()
	{
		$pwMinLength = Configuration::subset(['security','password'])->get('min_length',10);

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
		elseif ( strlen($this->getRequestVar('password1'))<$pwMinLength )
		{
			$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=> $pwMinLength));
		}
		else
		{
			$this->user->setPassword( $this->getRequestVar('password1') );
			$this->addNotice('user', 0, $this->user->name, 'SAVED', 'ok');
		}
	}



	/**
	 * Anzeige aller Benutzer-Eigenschaften.
	 */
	function editView()
	{
	    $issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];
	    
	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(hex2bin($this->user->otpSecret));
	    $counter = $this->user->hotpCount;
	    
	    $this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
		$this->setTemplateVar('timezone_list',timezone_identifiers_list() );
		
		$languageList = [];

		foreach( Messages::$AVAILABLE_LANGUAGES as $languageIsoCode)
		{
			$language = (new Language)->getLanguage($languageIsoCode);
			$label    = $language[ Messages::SELF_NAME ];
		    $languageList[ $languageIsoCode ] = $label;
		}
		$this->setTemplateVar('language_list',$languageList );
		
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
     * Setzt eine Sprache für den Benutzer.
     *
     * @param $l string Sprache
     */
    public function setLanguage($l)
    {
        $conf = Session::getConfig();
        $language = new Language();
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


		$defaultStyleConfig     = Configuration::Conf()->get('style-default',[]); // default style config
		$userStyleConfig = Configuration::subset('style')->get($currentStyle,[]); // user style config

		if ( $userStyleConfig )
			$defaultStyleConfig = array_merge($defaultStyleConfig, $userStyleConfig ); // Merging user style into default style
		else
			; // Unknown style name, we are ignoring this.

		// Theme base color for smartphones colorizing their status bar.
		$this->setTemplateVar('theme-color', UIUtils::getColorHexCode($defaultStyleConfig['title_background_color']));
	}


	/**
	 * All UI settings.
	 */
	public function uisettingsView() {

		$this->setTemplateVar('settings',Configuration::Conf()->get('ui') );
	}


	/**
	 * The user-dependent language codes.
	 */
	public function languageView() {

    	$this->setTemplateVar('language',Configuration::Conf()->get('language') );
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
		if  ( $user && Configuration::subset('style')->has($user->style))
			$style = $user->style;
		else
			$style = Configuration::subset(['interface','style'])->get('default','');

		return $style;
	}


}