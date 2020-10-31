<?php

namespace cms\action;

use cms\base\Configuration;
use cms\base\Startup;
use cms\model\Acl;
use cms\model\User;
use cms\model\Project;
use cms\model\Group;
use cms\model\BaseObject;
use cms\model\Language;


use language\Messages;
use util\exception\ValidationException;
use util\Http;
use security\Base2n;
use \security\Password;
use util\Session;
use util\Html;
use util\Mail;

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
class UserAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;

    /**
     * @var User
     */
	private $user;


    /**
     * UserAction constructor.
     * @throws \util\exception\ObjectNotFoundException
     */
    function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->user = new User( $this->getRequestId() );
		$this->user->load();
		$this->setTemplateVar('userid',$this->user->userid);
	}


	public function propPost()
	{
		if	( ! $this->getRequestVar('name') )
            throw new \util\exception\ValidationException( 'name');

        // Benutzer speichern
        $this->user->name     = $this->getRequestVar('name'    );
        $this->user->fullname = $this->getRequestVar('fullname');
        $this->user->isAdmin  = $this->hasRequestVar('is_admin');
        $this->user->tel      = $this->getRequestVar('tel'     );
        $this->user->desc     = $this->getRequestVar('desc'    );
        $this->user->language = $this->getRequestVar('language');
        $this->user->timezone = $this->getRequestVar('timezone');
        $this->user->hotp     = $this->hasRequestVar('hotp'    );
        $this->user->totp     = $this->hasRequestVar('totp'    );

        $conf = Configuration::rawConfig();
        if	( @$conf['security']['user']['show_admin_mail'] )
            $this->user->mail = $this->getRequestVar('mail'    );

        $this->user->style    = $this->getRequestVar('style'   );

        $this->user->save();
        $this->addNotice('user', 0, $this->user->name, 'SAVED', 'ok');
	}



	function removeView()
	{
		$this->setTemplateVars( $this->user->getProperties() );
	}
	
	
	
	public function removePost()
	{
		$this->user->delete();
		$this->addNoticeFor( $this->user ,Messages::DELETED);
	}


	public function addgrouptouserPost()
	{
		$group = new Group( $this->request->getRequiredRequestId('groupid' ) );
		$group->load();

		$this->user->addGroup( $group->groupid );

		$this->addNoticeFor( $this->user, Messages::ADDED);
	}


	function addgroup()
	{
		// Alle hinzufuegbaren Gruppen ermitteln
		$this->setTemplateVar('groups',$this->user->getOtherGroups());
	}


	function delgroup()
	{
		$this->user->delGroup( $this->getRequestVar('groupid') );

		$this->addNotice('user', 0, $this->user->name, 'DELETED', 'ok');
	}


	/**
	 * Das Kennwort wird an den Benutzer geschickt
	 *
	 * @access private
	 */
	protected function mailPw( $pw )
	{
		$to   = $this->user->fullname.' <'.$this->user->mail.'>';
		$mail = new Mail($to,'USER_MAIL');

		$mail->setVar('username',$this->user->name      );
		$mail->setVar('password',$pw                    );
		$mail->setVar('name'    ,$this->user->getName() );

		$mail->send();
	}


	/**
	 * Change password for user.
	 */
	public function pwPost()
	{
		$password = $this->getRequestVar('password');

		if   ( !$password )
			$password = $this->getRequestVar('password_proposal');

		if ( strlen($password) < Configuration::subset(['security','password'])->get('min_length',8) )
			throw new ValidationException('password',Messages::PASSWORD_MINLENGTH );

		$this->user->setPassword($password,!$this->hasRequestVar('timeout') ); // Kennwort setzen
		
		// E-Mail mit dem neuen Kennwort an Benutzer senden
		if	( $this->hasRequestVar('email') &&
			  $this->user->mail                      && // user has an e-mail.
			  Configuration::subset('mail')->is('enabled',true)
			) {
		    $this->mailPw( $password );
			$this->addNoticeFor( $this->user, Messages::MAIL_SENT);
		}

		$this->addNoticeFor($this->user, Messages::SAVED);

	}



	function listingView()
	{
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
		    /* @var $user User */
			$list[$user->userid]         = $user->getProperties();
		}
		$this->setTemplateVar('el',$list);
	}	
		

	/**
	 * Eigenschaften des Benutzers ermitteln.
	 */
	public function propView()
	{
	    $conf = Configuration::rawConfig();
	    
	    $issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];

	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(@hex2bin($this->user->otpSecret));
	    
	    $counter = $this->user->hotpCount;
	    
		$this->setTemplateVars(
		    $this->user->getProperties() +
		    array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
		          'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
		    )
		    + array('totpToken'=>Password::getTOTPCode($this->user->otpSecret))
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
	 * Eigenschaften des Benutzers anzeigen
	 */
	function infoView()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$gravatarConfig = Configuration::subset(['interface','gravatar'] );
		

		if	( $gravatarConfig->is('enabled',true) &&  $this->user->mail )
		{
			$url = 'http://www.gravatar.com/avatar/'.md5($this->user->mail).'?';

			$url .= '&s='.$gravatarConfig->get('size'   ,80 );
			$url .= '&d='.$gravatarConfig->get('default',404);
			$url .= '&r='.$gravatarConfig->get('rating' ,'g');

			$this->setTemplateVar( 'image', $url );
		} else {
			$this->setTemplateVar( 'image', 'about:blank' );
		}




        $issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
        $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];

        $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
        $secret = $base32->encode(@hex2bin($this->user->otpSecret));

        $counter = $this->user->hotpCount;

        $this->setTemplateVars(
            $this->user->getProperties() +
            array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
                'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
            )
            + array('totpToken'=>Password::getTOTPCode($this->user->otpSecret))
        );

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
				$this->addNotice('group', 0, $name, 'ADDED');
				$aenderung = true;
			}

			if	( $hasGroup && !$this->hasRequestVar('group'.$id) )
			{
				$this->user->delGroup($id);
				$this->addNotice('group', 0, $name, 'DELETED');
				$aenderung = true;
			}
		}
		
		if	( ! $aenderung )
				$this->addNotice('group', 0, $name, 'NOTHING_DONE');
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
     * @throws \util\exception\ObjectNotFoundException
     */
	function rightsView()
	{
        $rights = $this->user->getAllAcls();

        $projects = array();

        foreach( $rights as $acl )
        {
            /* @var $acl Acl */
            if	( !isset($projects[$acl->projectid]))
			{
                $p = Project::create( $acl->projectid );

                $projects[$acl->projectid] = array();
                $projects[$acl->projectid]['projectname'] = $p->load()->name;
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
				$right['languagename'] = \cms\base\Language::lang('ALL_LANGUAGES');
			}
			
			
			$o = new BaseObject($acl->objectid);
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
			    ;
				// Berechtigung fuer "alle".
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
			$this->addNotice('user', 0, $this->user->name, 'ADMIN_NEEDS_NO_RIGHTS', Action::NOTICE_WARN);
	}
	
	
    /**
     * Wechselt zu einem ausgewählten User.
     * @throws \util\exception\ObjectNotFoundException
     */
	public function switchPost()
	{
		// User laden...
		$user = new User( $this->getRequestId() );
		$user->load();
		
		// Und in der Sitzung speichern.
		Session::setUser( $user );
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
	
				
}