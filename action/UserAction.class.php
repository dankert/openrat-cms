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
 * Action-Klasse zum Bearbeiten eines Benutzers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class UserAction extends Action
{
	public $security = SECURITY_ADMIN;
	
	var $user;
	var $defaultSubAction = 'edit';


	function UserAction()
	{
		$this->user = new User( $this->getRequestId() );
		$this->user->load();
		$this->setTemplateVar('userid',$this->user->userid);
	}


	function editPost()
	{
		if	( $this->getRequestVar('name') != '' )
		{
			// Benutzer speichern
			$this->user->name     = $this->getRequestVar('name'    );
			$this->user->fullname = $this->getRequestVar('fullname');
			$this->user->isAdmin  = $this->hasRequestVar('is_admin');
			$this->user->ldap_dn  = $this->getRequestVar('ldap_dn' );
			$this->user->tel      = $this->getRequestVar('tel'     );
			$this->user->desc     = $this->getRequestVar('desc'    );
			$this->user->language = $this->getRequestVar('language');
			$this->user->timezone = $this->getRequestVar('timezone');
			$this->user->hotp     = $this->hasRequestVar('hotp'    );
			$this->user->totp     = $this->hasRequestVar('totp'    );
			
			global $conf;
			if	( @$conf['security']['user']['show_admin_mail'] )
				$this->user->mail = $this->getRequestVar('mail'    );
				
			$this->user->style    = $this->getRequestVar('style'   );
	
			$this->user->save();
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
	}



	function removeView()
	{
		$this->setTemplateVars( $this->user->getProperties() );
	}
	
	
	
	function removePost()
	{
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->user->delete();
			$this->addNotice('user',$this->user->name,'DELETED','ok');
		}
		else
		{
			$this->addValidationError('confirm');
			return;
		}
	}


	function addgrouptouser()
	{
		$this->user->addGroup( $this->getRequestVar('groupid') );
	
		$this->addNotice('user',$this->user->name,'ADDED','ok');
	}


	function addgroup()
	{
		// Alle hinzufuegbaren Gruppen ermitteln
		$this->setTemplateVar('groups',$this->user->getOtherGroups());
	}


	function delgroup()
	{
		$this->user->delGroup( $this->getRequestVar('groupid') );

		$this->addNotice('user',$this->user->name,'DELETED','ok');
	}


	/**
	 * Das Kennwort wird an den Benutzer geschickt
	 *
	 * @access private
	 */
	function mailPw( $pw )
	{
		$to   = $this->user->fullname.' <'.$this->user->mail.'>';
		$mail = new Mail($to,'USER_MAIL');

		$mail->setVar('username',$this->user->name      );
		$mail->setVar('password',$pw                    );
		$mail->setVar('name'    ,$this->user->getName() );

		$mail->send();
	}


	/**
	 * Aendern des Kennwortes
	 */
	public function pwPost()
	{
		global $conf;

		$pw1 = $this->getRequestVar('password1');
		$pw2 = $this->getRequestVar('password2');

		$type = $this->getRequestVar('type');

		switch( $type )
		{
			case 'input':
				if ( strlen($pw1)<intval($conf['security']['password']['min_length']) )
				{
					$this->addValidationError('password1');
					return;
				}
				elseif	( $pw1 != $pw2 )
				{
					$this->addValidationError('password2');
					return;
				}
				else
				{
					$newPassword = $pw1;
				}
				break;
			case 'proposal';
				$newPassword = $this->getRequestVar('password_proposal');
				break;
			case 'random';
				$newPassword = $this->user->createPassword();
				break;
			default:
				Http::serverError('Type unknown: '.$type);
		}

		// Kennwoerter identisch und lang genug
		$this->user->setPassword($newPassword,!$this->hasRequestVar('timeout') ); // Kennwort setzen
		
		// E-Mail mit dem neuen Kennwort an Benutzer senden
		if	( $this->hasRequestVar('email') && !empty($this->user->mail) && $conf['mail']['enabled'] )
		{
		    $this->mailPw( $newPassword );
			$this->addNotice('user',$this->user->name,'MAIL_SENT','ok');
		}

		$this->addNotice('user',$this->user->name,'SAVED','ok');

	}



	function listingView()
	{
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
			$list[$user->userid]         = $user->getProperties();
			$list[$user->userid]['url' ] = Html::url('main','user',$user->userid,
			                                         array(REQ_PARAM_TARGETSUBACTION=>'edit') );
		}
		$this->setTemplateVar('el',$list);
	}	
		

	/**
	 * Eigenschaften des Benutzers ermitteln.
	 */
	function editView()
	{
	    global $conf;
	    
	    $issuer  = urlencode(config('application','operator'));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];

	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(hex2bin($this->user->otpSecret));
	    
	    $counter = $this->user->hotpCount;
	    
		$this->setTemplateVars(
		    $this->user->getProperties() +
		    array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
		          'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
		    )
		    + array('totpToken'=>$this->getCode())
		);

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
	    $this->setTemplateVar('timezone_list',timezone_identifiers_list() );
	    
        $languages = explode(',',$conf['i18n']['available']);
        foreach($languages as $id=>$name)
        {
            unset($languages[$id]);
            $languages[$name] = $name;
        }
        $this->setTemplateVar('language_list',$languages);
		        
	}

	
	
	
	/**
	 * Calculate the code, with given secret and point in time.
	 *
	 * @param string   $secret
	 * @param int|null $timeSlice
	 *
	 * @return string
	 */
	private function getCode()
	{
	    $codeLength = 6;
        $timeSlice = floor(time() / 30);
	    $secretkey = hex2bin($this->user->otpSecret);
	    // Pack time into binary string
	    $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
	    // Hash it with users secret key
	    $hm = hash_hmac('SHA1', $time, $secretkey, true);
	    // Use last nipple of result as index/offset
	    $offset = ord(substr($hm, -1)) & 0x0F;
	    // grab 4 bytes of the result
	    $hashpart = substr($hm, $offset, 4);
	    // Unpak binary value
	    $value = unpack('N', $hashpart);
	    $value = $value[1];
	    // Only 32 bits
	    $value = $value & 0x7FFFFFFF;
	    $modulo = pow(10, $codeLength);
	    return str_pad($value % $modulo, $codeLength, '0', STR_PAD_LEFT);
	}

	
	
	/**
	 * Eigenschaften des Benutzers anzeigen
	 */
	function infoView()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$gravatarConfig = config('interface','gravatar');
		
		$this->setTemplateVar( 'image', 'about:blank' );
		if	( is_array($gravatarConfig) )
		{
			extract($gravatarConfig);
			
			if	( isset($enable) && $enable && !empty($this->user->mail) )
			{
				$url = 'http://www.gravatar.com/avatar/'.md5($this->user->mail).'?';
				if	( isset($size))
					$url .= '&s='.$size;
				if	( isset($default))
					$url .= '&d='.$default;
				if	( isset($rating))
					$url .= '&r='.$rating;
					
				$this->setTemplateVar( 'image', $url );
			}
		}
	}


	function membershipsView()
	{
		$gruppenListe = array();
		
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		
		foreach( $allGroups as $id=>$name )
		{
			
			$hasGroup = array_key_exists($id,$userGroups);
			$varName  = 'group'.$id;
			$gruppenListe[$id] = array('name'       =>$name,
			                           'id'         =>$id,
			                           'var'        =>$varName,
			                           'member'     =>$hasGroup
			                          );
			$this->setTemplateVar($varName,$hasGroup);
		}
		$this->setTemplateVar('memberships',$gruppenListe);
		
		global $conf;
		if	($conf['security']['authorize']['type']=='ldap')
			$this->addNotice('user',$this->user->name,'GROUPS_MAY_CONFLICT_WITH_LDAP',OR_NOTICE_WARN);
	}


	function membershipsPost()
	{
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		$aenderung = false;
		
		foreach( $allGroups as $id=>$name )
		{
			$hasGroup = array_key_exists($id,$userGroups);
			
			if	( !$hasGroup && $this->hasRequestVar('group'.$id) )
			{
				$this->user->addGroup($id);
				$this->addNotice('group',$name,'ADDED');
				$aenderung = true;
			}

			if	( $hasGroup && !$this->hasRequestVar('group'.$id) )
			{
				$this->user->delGroup($id);
				$this->addNotice('group',$name,'DELETED');
				$aenderung = true;
			}
		}
		
		if	( ! $aenderung )
				$this->addNotice('group',$name,'NOTHING_DONE');
	}


	/**
	 * Aendern des Kennwortes
	 */
	function pwView()
	{
		$this->setTemplateVars( $this->user->getProperties() );
		
		$this->setTemplateVar('password_proposal', $this->user->createPassword() );
	}


	/**
	 * Anzeigen der Benutzerrechte
	 */
	function rightsView()
	{
		$rights = $this->user->getAllAcls();

		$projects = array();
		
		foreach( $rights as $acl )
		{
			if	( !isset($projects[$acl->projectid]))
			{
				$projects[$acl->projectid] = array();
				$p = new Project($acl->projectid);
				$p->load();
				$projects[$acl->projectid]['projectname'] = $p->name;
				$projects[$acl->projectid]['rights'     ] = array();
			}

			$right = array();
			
			if	( $acl->languageid > 0 )
			{
				$language = new Language($acl->languageid);
				$language->load();
				$right['languagename'] = $language->name;
			}
			else
			{
				$right['languagename'] = lang('ALL_LANGUAGES');
			}
			
			
			$o = new Object($acl->objectid);
			$o->objectLoad();
			$right['objectname'] = $o->name;
			$right['objectid'  ] = $o->objectid;
			$right['objecttype'] = $o->getType();
			
			if	( $acl->userid > 0 )
			{
				$user = new User($acl->userid);
				$user->load();
				$right['username'] = $user->name;
			}
			elseif	( $acl->groupid > 0 )
			{
				$group = new Group($acl->groupid);
				$group->load();
				$right['groupname'] = $group->name;
			}
			else
			{
				// Berechtigung f�r "alle".
			}

//			$show = array();
//			foreach( $acl->getProperties() as $p=>$set)
//				$show[$p] = $set;
//				
//			$right['show'] = $show;
			$right['bits'] = $acl->getProperties();
			
			$projects[$acl->projectid]['rights'][] = $right;
		}
		
		$this->setTemplateVar('projects'    ,$projects );
		
		$this->setTemplateVar('show',Acl::getAvailableRights() );
		
		if	( $this->user->isAdmin )
			$this->addNotice('user',$this->user->name,'ADMIN_NEEDS_NO_RIGHTS',OR_NOTICE_WARN);
	}
	
	
	/**
	 * @param String $name Men�punkt
	 * @return boolean
	 */
	function checkMenu( $menu )
	{
		global $conf;

		switch( $menu )
		{
			case 'add':
			case 'remove':
				return !readonly();
					
			case 'addgroup':
				return !readonly() && count($this->user->getOtherGroups()) > 0;

			case 'groups':
				return !readonly() && count(Group::getAll()) > 0;
	
			case 'pw':
				return    !readonly()
					   && @$conf['security']['auth']['type'] == 'database'
				       && !@$conf['security']['auth']['userdn'];
		}
		
		return true;
	}

	
	/**
	 * Wechselt zu einem ausgewählten User.
	 */
	public function switchPost()
	{
		// User laden...
		$user = new User( $this->getRequestId() );
		$user->load();
		
		// Und in der Sitzung speichern.
		Session::setUser( $user );
		
		$this->refresh();
	}
	
	
	/**
	 * Ermittelt die letzten Änderungen, die durch den aktuellen Benutzer in allen Projekten gemacht worden sind.
	 */
	public function historyView()
	{
		$result = $this->user->getLastChanges();
		$this->setTemplateVar('timeline', $result);
	}
	
				
}