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
// Revision 1.2  2006-06-16 21:26:29  dankert
// Methode maxAge(), setzen von Expires-Headern im HTTP-Header.
//
// Revision 1.1  2006/01/11 22:38:33  dankert
// Neue Aktionsklassen f?r neue Darstellungsart
//
// Revision 1.21  2005/04/16 21:35:23  dankert
// Uebergabe von Loginfehlern als normale Hinweismeldung
//
// Revision 1.20  2005/03/13 16:39:00  dankert
// Neue Methoden, um Baum ein- und auszublenden
//
// Revision 1.19  2005/02/17 19:21:00  dankert
// Titelanzeige geaendert
//
// Revision 1.18  2005/01/27 00:03:57  dankert
// Variable "nopublish" an das Template liefern
//
// Revision 1.17  2005/01/23 11:13:54  dankert
// Schalter "nologin" beruecksichtigen
//
// Revision 1.16  2005/01/14 21:41:23  dankert
// Aufruf von lastModified() fuer Conditional-GET
//
// Revision 1.15  2005/01/04 21:42:09  dankert
// Uebertragen von MOTD
//
// Revision 1.14  2004/12/29 20:19:55  dankert
// Korrektur
//
// Revision 1.13  2004/12/28 22:58:39  dankert
// Fuellen Variablen logo* fuer Loginmaske
//
// Revision 1.12  2004/12/26 20:20:17  dankert
// Bei Logout entfernen aller Session-Variablen
//
// Revision 1.11  2004/12/26 18:49:58  dankert
// Projektname im Seiten-Titel
//
// Revision 1.10  2004/12/25 22:11:20  dankert
// Logo-Bild ueber Parameter
//
// Revision 1.9  2004/12/19 21:57:02  dankert
// Korrektur bei direktem Objektaufruf in object()
//
// Revision 1.8  2004/12/19 14:54:31  dankert
// language() und model() korrigiert
//
// Revision 1.7  2004/12/18 00:16:26  dankert
// language_read() entfernt
//
// Revision 1.6  2004/12/15 23:23:27  dankert
// div. neue Methoden
//
// Revision 1.5  2004/11/28 18:26:15  dankert
// Anpassen an neue Sprachdatei-Konventionen
//
// Revision 1.4  2004/11/15 21:34:05  dankert
// Korrektur fuer Administrationsmodus
//
// Revision 1.3  2004/11/10 22:36:45  dankert
// Laden von Projektklassen und Lesen/Schreiben von/nach Session
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse fuer Hintergrund
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class BackgroundAction extends Action
{
	var $defaultSubAction = 'show';

	function show()
	{
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();

		// Seite �ndert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

		$this->setTemplateVar( 'stylesheet',$user->style );
		$this->setTemplateVar( 'css_body_class','background' );

		$this->maxAge( 4*60*60 ); // 1 Stunde Browsercache
	}
}

?>