<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
 * Action-Klasse zum Bearbeiten des Benutzerprofiles
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ProfileAction extends Action
{
	var $user;
	var $defaultSubAction = 'edit';

	/**
	 * Konstruktor.
	 * Setzen der Benutzer-Objektes.
	 */
	function ProfileAction()
	{
		$this->user = Session::getUser();
	}


	/**
	 * Abspeichern des Profiles
	 */
	function saveprofile()
	{
		$this->user->fullname = $this->getRequestVar('fullname');
		$this->user->tel      = $this->getRequestVar('tel'     );
		$this->user->desc     = $this->getRequestVar('desc'    );
		$this->user->style    = $this->getRequestVar('style'   );
		
		$this->setStyle( $this->user->style ); // Style sofort anwenden
		
		if	( !empty($this->user->fullname) )
		{
			$this->user->save();
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('fullname');
			$this->callSubAction('edit');
		}
	}

	
	
	/**
	 * Benutzer-Einstellungen anzeigen.
	 * Diese Einstellungen werden im Cookie gespeichert.
	 */
	function settingsView()
	{
		foreach( array('always_edit','ignore_ok_notices','timezone_offset','language') as $name )
			$this->setTemplateVar($name,Text::clean(isset($_COOKIE['or_'.$name])?$_COOKIE['or_'.$name]:'','abcdefghijklmnopqrstuvwxyz0123456789 .'));
			
		//Html::debug(Text::clean($_COOKIE['or_'.$name],'0123456789 .'));
		$timezone_list = array();
		//$timezone_list[ '' ] = 'SERVER ('.(date('Z')>=0?'+':'').intval(date('Z')/3600).':00)';
		
		global $conf;
		$tzlist = $conf['date']['timezone'];
		if	( !is_array($tzlist))$tzlist = array();
		foreach ($tzlist as $offset=>$name)
			$timezone_list[$offset] = $name.' ('.vorzeichen(intval($offset/60)).':00)'.($offset==date('Z')/60?' *':'');
			
		$this->setTemplateVar('timezone_list',$timezone_list);
		$languages = explode(',',$conf['i18n']['available']);
		foreach($languages as $id=>$name)
		{
			unset($languages[$id]);
			$languages[$name] = $name;
		}
		$this->setTemplateVar('language_list',$languages);
	}

	

	/**
	 * Speichern der Benutzereinstellungen.
	 */
	function settingsAction()
	{
		foreach( array('always_edit','ignore_ok_notices','timezone_offset','language') as $name )
		{
			// Prüfen, ob Checkbox aktiviert wurde.
			if	( $this->hasRequestVar($name))
			{
				// Cookie setzen
				setcookie('or_'.$name,$this->getRequestVar($name,OR_FILTER_ALPHANUM),time()+(60*60*24*30*12*2));
				$_COOKIE['or_'.$name] = $this->getRequestVar($name,OR_FILTER_ALPHANUM);
			}
			else
			{
				// Cookie loeschen
				setcookie('or_'.$name,'', time()-3600);
				unset($_COOKIE['or_'.$name]);
			}
		}
		
		$this->addNotice('user',$this->user->name,'SAVED','ok');
	}
	
	
	
	/**
	 * Anzeigen einer Maske zum Ändern des Kennwortes.
	 */
	function pwchange()
	{
	}
	
	

	/**
	 * Anzeige einer Maske zum Ändern der E-Mail-Adresse
	 */
	function mail()
	{
	}
	
	
	
	/*
	 * Es wird eine E-Mail mit einem Freischaltcode an die eingegebene Adresse geschickt.
	 */
	function mailcode()
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
				$this->callSubAction('mail');
				return;
			}
		}
	}

	
	
	/**
	 * Anzeige einer Maske, in die der Freischaltcode für das
	 * Ändern der E-Mail-Adresse eingetragen werden muss.
	 */
	function confirmmail()
	{
	}
	
	

	/**
	 * Abspeichern der neuen E-Mail-Adresse
	 */
	function savemail()
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
			$this->callSubAction('confirmmail');
		}
		
	}
	
	
	
	function savepw()
	{
		if	( ! $this->user->checkPassword( $this->getRequestVar('act_password') ) )
		{
			$this->addValidationError('act_password');
			$this->callSubAction('pwchange');
		}
		elseif	( $this->getRequestVar('password1') == '' )
		{
			$this->addValidationError('password1');
			$this->callSubAction('pwchange');
		}
		elseif ( $this->getRequestVar('password1') != $this->getRequestVar('password2') )
		{
			$this->addValidationError('password2','PASSWORDS_DO_NOT_MATCH');
			$this->callSubAction('pwchange');
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
	function edit()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
	}

	
	
	/**
	 * Anzeige aller Gruppen des angemeldeten Benutzers.
	 *
	 */
	function groups()
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
	
}