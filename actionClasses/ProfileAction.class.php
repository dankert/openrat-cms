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
		$this->user->save();

		$this->addNotice('user',$this->user->name,'SAVED','ok');
	}


	function pwchange()
	{
	}
	
	
	
	function mail()
	{
	}
	
	
	
	function confirmmail()
	{
		srand ((double)microtime()*1000003);
		$code = rand();
		$newMail = $this->getRequestVar('mail');
		Session::set('mailChangeCode',$code   );
		Session::set('mailChangeMail',$newMail);
		
		// E-Mail an die neue Adresse senden.
		$mail = new Mail( $newMail,'mail_change_code' );
		$mail->setVar('code',$code                 );
		$mail->setVar('name',$this->user->getName());
		$mail->send();
		
		$this->addNotice('user',$newUser->name,'mail_sent','ok'); // Meldung
	}
	
	
	
	function savemail()
	{
		$sessionCode       = Session::get('mailChangeCode');
		$newMail           = Session::get('mailChangeMail');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $sessionCode == $inputRegisterCode )
		{
			// Bestätigungscode stimmt überein.
			// E-Mail-Adresse ändern.	
			$this->user->mail = $newMail;
			$this->user->save();
			
			$this->addNotice('user',$newUser->name,'user_saved','ok');
		}
		else
		{
			// Bestätigungscode stimmt nicht.
			$this->addNotice('user',$newUser->name,'mailcode_not_match','error');
		}		
		
	}
	
	
	
	function savepw()
	{
		if	( $this->getRequestVar('password1') != '' &&
			  $this->getRequestVar('password1') == $this->getRequestVar('password2') )
		{
			$ok = $this->user->checkPassword( $this->getRequestVar('act_password') );

			if	( !$ok )
			{
				$this->addNotice('user',$this->user->name,'ERROR','error');
			}
			else
			{
				$this->user->setPassword( $this->getRequestVar('password1') );
				
				// E-Mail mit dem neuen Kennwort an Benutzer senden
				if	( $this->hasRequestVar('mail') && !empty($this->user->mail) )
				{
					// Text der E-Mail zusammenfuegen
					$text = wordwrap(lang('USER_MAIL_PREFIX'),70,"\n")."\n\n".$this->getRequestVar('password1')."\n\n".wordwrap(lang('USER_MAIL_SUFFFIX'),70,"\n");

					// Mail versenden
					mail($this->user->mail,lang('USER_MAIL_SUBJECT'),$text);
				}

				$this->addNotice('user',$this->user->name,'SAVED','ok');
			}
		}

	}



	function edit()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
	}
}