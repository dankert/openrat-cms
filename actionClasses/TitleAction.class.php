<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.9  2006-06-01 18:16:03  dankert
// Aufger?umt.
//
// Revision 1.8  2005/03/13 16:39:58  dankert
// Last-Modified vorerst nicht setzen, da letzte Aenderung der Baumeinstellung sonst nicht beruecksichtigt wird
//
// Revision 1.7  2005/02/17 20:08:51  dankert
// Einbau von Baum offen/zu
//
// Revision 1.6  2005/01/14 21:41:23  dankert
// Aufruf von lastModified() fuer Conditional-GET
//
// Revision 1.5  2004/12/19 19:23:20  dankert
// Link auf Profil korrigiert
//
// Revision 1.4  2004/12/15 23:24:23  dankert
// Html::url()-Parameter angepasst
//
// Revision 1.3  2004/11/10 22:40:32  dankert
// Benutzen der Session-Klasse
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Actionklasse zum Anzeigen der Titelleiste
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class TitleAction extends Action
{
	/**
	 * Standard-Subaction
	 * @type String
	 */
	var $defaultSubAction = 'show';


	/**
	 * Fuellen der Variablen und Anzeigen der Titelleiste
	 */
	function show()
	{
		$user = Session::getUser();
//		if	( is_object($user) && isset($user->loginDate) )
//			$this->lastModified( $user->loginDate );

		$this->setTemplateVar('css_body_class','title');

		$db = Session::getDatabase();
		$this->setTemplateVar('dbid'  ,$db->id              ); 
		$this->setTemplateVar('dbname',$db->conf['comment'] );

		$user = Session::getUser();		
		$this->setTemplateVar('username'    ,$user->name    );
		$this->setTemplateVar('userfullname',$user->fullname);
		
		// Urls zum Benutzerprofil und zum Abmelden
		$this->setTemplateVar('profile_url',Html::url( 'profile'         ));
		$this->setTemplateVar('logout_url' ,Html::url( 'index','logout'  ));
		
		if	( Session::get('showtree') )
		{
			$this->setTemplateVar('showtree_url' ,Html::url('index','hidetree') );
			$this->setTemplateVar('showtree_text',lang('GLOBAL_HIDETREE')       );
		}
		else
		{
			$this->setTemplateVar('showtree_url' ,Html::url('index','showtree') );
			$this->setTemplateVar('showtree_text',lang('GLOBAL_SHOWTREE')       );
		}
		
		$this->forward( 'title' );
	}
}

?>