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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.5  2004-11-28 22:46:55  dankert
// Rechte des Benutzers anzeigen
//
// Revision 1.4  2004/11/10 22:42:10  dankert
// *** empty log message ***
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/05/02 14:30:27  dankert
// E-Mail versenden wenn neues Kennwort gesetzt
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// Revision 1.2  2003/10/02 20:56:17  dankert
// Benutzer entfernen
//
// Revision 1.1  2003/09/29 18:18:21  dankert
// erste Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Benutzers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class UserAction extends Action
{
	var $user;
	var $defaultSubAction = 'edit';

	function UserAction()
	{
		$this->user = new User( $this->getSessionVar('userid') );
		$this->user->load();
	}


	function save()
	{
		global $REQ;
	
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->user->delete();
			$this->callSubAction('listing');
		}
		else
		{
			// Benutzer speichern
			$this->user->name     = $REQ['name'];
			$this->user->fullname = $REQ['fullname'];
			$this->user->isAdmin  = isset($REQ['is_admin']);
			$this->user->ldap_dn  = $REQ['ldap_dn'];
			$this->user->tel      = $REQ['tel'];
			$this->user->desc     = $REQ['desc'];
			$this->user->mail     = $REQ['mail'];
			$this->user->style    = $REQ['style'];
			$this->user->save();
		}

		$this->callSubAction('edit');
	}


	/**
	 * Abspeichern des Profiles
	 */
	function saveProfile()
	{
		global $SESS;
		$this->user = new User( $SESS['user']['id'] );
		$this->user->load();

		$this->user->fullname = $this->getRequestVar('fullname');
		$this->user->tel      = $this->getRequestVar('tel'     );
		$this->user->desc     = $this->getRequestVar('desc'    );
		$this->user->mail     = $this->getRequestVar('mail'    );
		$this->user->style    = $this->getRequestVar('style'   );
		$this->user->save();

//		$this->user->setCurrent();

		$this->callSubAction('profile');
	}


	function add()
	{
	
		$this->user->add( $this->getRequestVar('name') );
		$this->setSessionVar('userid',$this->user->userid);
	
		$this->callSubAction('edit');
	}


	function addgroup()
	{
		$this->user->addGroup( $this->getRequestVar('groupid') );
	
		$this->callSubAction('groups');
	}


	function delgroup()
	{
	
		$this->user->delGroup( $this->getRequestVar('groupid') );
	
		$this->callSubAction('groups');
	}


	function pwchange()
	{
		global $SESS;

		if   ($this->getRequestVar('password1') != '' && $this->getRequestVar('password1') == $this->getRequestVar('password2'))
		{
			if   ($SESS['user']['is_admin'] != '1')
				$ok = $this->user->checkPassword( $this->getRequestVar('act_password') );
			else $ok = true;
				
			if	( !$ok )
			{
				message('ERROR_USER_PW','old password not accepted');
			}
			else
			{
				$this->user->setPassword( $this->getRequestVar('password1') );
				
				// E-Mail mit dem neuen Kennwort an Benutzer senden
				if	( $this->getRequestVar('mail') != '' && $this->user->mail != '')
				{
					// Text der E-Mail zusammenfuegen
					$text = wordwrap(lang('USER_MAIL_PREFIX'),70,"\n")."\n\n".$this->getRequestVar('password1')."\n\n".wordwrap(lang('USER_MAIL_SUFFFIX'),70,"\n");

					// Mail versenden
					mail($this->user->mail,lang('USER_MAIL_SUBJECT'),$text);
				}
			}
		}
		else
		{
			message('ERROR_USER_PW','passwords not equal or blank');
		}

		$this->callSubAction('edit');
	}

	function delright()
	{
		if   ($SESS['user']['is_admin'] != '1') die('weah');

		$user->delRight( $this->getRequestVar('aclid') );
	
		// Berechtigungen anzeigen
		$this->callSubAction('rights');
	}


	function addright()
	{
		global $REQ;
		if   ($SESS['user']['is_admin'] != '1') die('go away hacker');
		
		$user->addRight( $REQ );

		// Berechtigungen anzeigen
		$this->callSubAction('rights');
	}


	function listing()
	{
		global $conf_php;

		$list = array();

		foreach( $this->user->listAll() as $userid=>$name )
		{
			$list[$userid]         = array();
			$list[$userid]['url' ] = Html::url(array('action'=>'main','callAction'=>'user','callSubaction'=>'edit','userid'=>$userid));
			$list[$userid]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);

		$this->forward('user_list');
	}	
		

	function profile()
	{
		global $SESS;

		$this->user = new User( $SESS['user']['id'] );
		$this->user->load();

		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->getStyles() );

		$this->forward( 'user_profile' );
	}


	/**
	 * Eigenschaften des Benutzers anzeigen
	 */
	function edit()
	{
		global $SESS;

		if   ( !$SESS['user']['is_admin'] ) exit();

		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->getStyles() );

		$this->forward( 'user_edit' );
	}


	function groups()
	{

		// Alle hinzuf?gbaren Gruppen ermitteln
		$this->setTemplateVar('groups',$this->user->getOtherGroups());
	
		// Mitgliedschaften
		$this->setTemplateVar('memberships',$this->user->getGroups());
		
		$this->forward('user_groups');
	}


	/**
	 * ?ndern des Kennwortes
	 */
	function pw()
	{
		$this->forward('user_pw');
	}


	/**
	 * Anzeigen der Benutzerrechte
	 */
	function rights()
	{
		$rights = $this->user->getAllAcls();

		$rightList  = array();
		$objectList = array();
		
		foreach( $rights as $acl )
		{
			if	( !isset($rightList[$acl->projectid]) )
				$rightList[$acl->projectid]=array();
			$rightList[$acl->projectid][$acl->objectid] = $acl->getProperties();
			
			$o = new Object($acl->objectid);
			$o->objectLoadRaw();
			$objectList[$o->objectid] = $o->getProperties();
		}
		$o = new Object();
		$o->isFolder = true;
		$show = $o->getRelatedAclTypes();
		
		$this->setTemplateVar('projects',$this->user->getReadableProjects() );
		$this->setTemplateVar('rights'  ,$rightList                         );
		$this->setTemplateVar('objects' ,$objectList                        );
		$this->setTemplateVar('show'    ,$show                              );

		$this->forward('user_rights');
	}


	/**
	 * Ermitteln aller zur Verf?gung stehenden Stylesheets
	 */
	function getStyles()
	{
		global $conf_themedir;
		$allstyles = array();
		$handle=opendir( $conf_themedir.'/css' ); 

		while ($file = readdir ($handle))
		{ 
			if ( eregi('\.css$',$file) )
			{ 
				$file = eregi_replace('\.css$','',$file);
				$allstyles[$file] = $file;
			}
		}
		closedir($handle);

		return $allstyles;	
	}
}