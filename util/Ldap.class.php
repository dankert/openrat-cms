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
 * Bereitstellen von LDAP-Funktionen.
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Ldap
{
	var $connection;
	var $timeout;
	var $aliases;
	
	
	/**
	 * 
	 */
	function Ldap()
	{
		global $conf;
		
		$this->timeout = intval($conf['ldap']['search']['timeout']);

		if	( $conf['ldap']['search']['aliases'] )
			$this->aliases = LDAP_DEREF_ALWAYS;
		else
			$this->aliases = LDAP_DEREF_NEVER;
	}
	
	
	
	/**
	 * Verbindung �ffnen. 
	 */
	function connect()
	{
		global $conf;
		
		$ldapHost = $conf['ldap']['host'];
		$ldapPort = $conf['ldap']['port'];

		// Verbindung zum LDAP-Server herstellen
		$this->connection = @ldap_connect( $ldapHost,$ldapPort );
		
		// siehe http://bugs.php.net/bug.php?id=15637
		// Unter bestimmten Bedingungen wird trotz nicht erreichbarem LDAP-Server eine PHP-Resource
		// zurueck gegeben. Dann erscheint zwar keine Fehlermeldung, aber zumindestens misslingt
		// der nachfolgende Bind-Befehl.
		if	( !is_resource($this->connection) || $this->connection === false )
		{
			Logger::error( "connect to ldap server '$ldapHost:$ldapPort' failed" );
			// Abbruch, wenn LDAP-Server nicht erreichbar
			die( "Connection failed to $ldapHost:$ldapPort (".ldap_errno().'/'.ldap_error().'). Please contact your administrator.' );
		}
		
		// Protokollversion setzen.
		$j = ldap_set_option( $this->connection, LDAP_OPT_PROTOCOL_VERSION,intval($conf['ldap']['protocol']) );
		if	( ! $j )
			die( 'LDAP error while setting protocol version'.ldap_errno().'/'.ldap_error().')' );
		
	}	
	
	
	
	/**
	 * Ein Binding auf den LDAP-Server durchf�hren.
	 */
	function bind( $user,$pw )
	{
		return @ldap_bind( $this->connection,$user,$pw);
	}
	
	
	
	/**
	 * Ein Binding auf den LDAP-Server durchf�hren.
	 */
	function bindAnonymous()
	{
		return @ldap_bind( $this->connection );
	}
	
	
	
	/**
	 * Das Bindung wird entfernt.
	 */
	function unbind()
	{
		ldap_unbind( $this->connection );
	}
	
	
	
	/**
	 * Eine Suche auf den LDAP-Server durchf�hren.
	 */
	function searchUser( $username )
	{
		global $conf;
		
		$techUser = $conf['ldap']['search']['user'];
		$techPass = $conf['ldap']['search']['password'];
		
		if	( $conf['ldap']['search']['anonymous'] )
			$this->bindAnonymous();
		else
			$this->bind( $techUser, $techPass );

		$dn      = $conf['ldap']['search']['basedn'];
		$filter  = $conf['ldap']['search']['filter'];
		$filter  = str_replace('{user}', $username, $filter);

		$s = @ldap_search( $this->connection,$dn,$filter,array(),0,1,$this->timeout,$this->aliases );
		
		if	( ! is_resource($s) )
			return null;
			
		$dn = @ldap_get_dn($this->connection, ldap_first_entry($this->connection,$s) );
		
		return $dn;
	}



	/**
	 * Ein Binding auf den LDAP-Server durchf�hren.
	 */
	function searchAttribute( $filter,$attr )
	{
		global $conf;
		
		$timeout = intval($conf['ldap']['search']['timeout']);

		if	( $conf['ldap']['search']['aliases'] )
			$aliases = LDAP_DEREF_ALWAYS;
		else
			$aliases = LDAP_DEREF_NEVER;
			
		
		$base_dn = $conf['ldap']['search']['basedn'];
		$s = ldap_search( $this->connection,$base_dn,$filter,array(),0,0,$this->timeout,$this->aliases );
		$ergebnisse = ldap_get_entries($this->connection,$s);
		
		$liste = array();
//		Html::debug($ergebnisse);
		for( $i=0; $i<=$ergebnisse['count']-1; $i++ )
			$liste[] = $ergebnisse[$i][$attr][0];

		return $liste;
	}
	
	
	
	/**
	 * Verbindung schlie�en.
	 */	
	function close()
	{
		// Verbindung zum LDAP-Server brav beenden
		ldap_close( $this->connection );
	}	
}

?>