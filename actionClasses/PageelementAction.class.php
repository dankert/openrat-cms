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
// Revision 1.4  2004-05-02 12:00:26  dankert
// Funktion release() zum freigeben von Inhalten
//
// Revision 1.3  2004/05/02 11:40:00  dankert
// Freigabestatus der Seiteninhalte verarbeiten
//
// Revision 1.2  2004/04/30 20:52:11  dankert
// Schalter $release setzen
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Seitenelementes
 * @author $Author$
 * @version $Revision$
 */
class PageelementAction extends Action
{
	var $defaultSubAction = 'edit';


	/**
	 * Enthält das Seitenobjekt
	 * @type Object
	 */
	var $page;
	
	/**
	 * Enthält das Elementobjekt
	 * @type Object
	 */
	var $element;


	/**
	 * Konstruktor
	 */
	function PageelementAction()
	{
		$this->value = new Value();
	}


	function edit()
	{
		$this->value->languageid = $this->getSessionVar('languageid');
		$this->value->objectid   = $this->getSessionVar('objectid');
		$this->value->pageid     = Page::getPageIdFromObjectId( $this->getSessionVar('objectid') );
		$this->value->element = new Element( $this->getSessionVar('elementid') );
		$this->value->element->load();
		$this->value->publish = false;

		if	( intval($this->value->valueid)!=0 )
			$this->value->loadWithId();
		else	$this->value->load();

		$this->setTemplateVar('name',$this->value->element->name);
		$this->setTemplateVar('desc',$this->value->element->desc);

		switch( $this->value->element->type )
		{

			case 'link':

				$objects = array();
		
				foreach( Folder::getAllObjectIds() as $id )
				{
					$o = new Object( $id );
					$o->load();
					
					if	( $o->getType() != 'folder' )
					{ 
						$f = new Folder( $o->parentid );
						$f->load();
						
						$objects[ $id ]  = lang( $o->getType() ).': '; 
						$objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
						$objects[ $id ] .= ' &raquo; '.$o->name;
					} 
				}

				asort( $objects ); // Sortieren
		
				$this->setTemplateVar('objects'         ,$objects);
				$this->setTemplateVar('act_linkobjectid',$this->value->linkToObjectId);

				break;
		
			case 'list':

				$objects = array();
				foreach( Folder::getAllFolders() as $id )
				{
					$f = new Folder( $id );
					$f->load();
					
					$objects[ $id ]  = lang( $f->getType() ).': '; 
					$objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
				}
		
				asort( $objects ); // Sortieren
		
				$this->setTemplateVar('objects'         ,$objects);
				$this->setTemplateVar('act_linkobjectid',$this->value->linkToObjectId);

				break;
		

			case 'number':
				$this->setTemplateVar('number',$this->value->number / pow(10,$this->value->element->decimals) );
				break;
			
			case 'longtext':
			case 'text':
				$this->setTemplateVar('text',$this->value->text);
				break;
		
			case 'date':

				$date =  $this->value->date;

				// Wenn Datum nicht vorhanden, dann aktuelles Datum verwenden
				if	( $date == 0 )
					$date = time();
	
				if   ( $this->getRequestVar('year') != '' )
				{
					$date = mktime( $this->getRequestVar('hour'),
					                $this->getRequestVar('minute'),
					                $this->getRequestVar('second'),
					                $this->getRequestVar('month'),
					                $this->getRequestVar('day'),
					                $this->getRequestVar('year')    );
				}
				$this->setTemplateVar('year'  ,date('Y',$date) );
				$this->setTemplateVar('month' ,date('n',$date) );
				$this->setTemplateVar('day'   ,date('j',$date) );
				$this->setTemplateVar('hour'  ,date('G',$date) );
				$this->setTemplateVar('minute',date('i',$date) );
				$this->setTemplateVar('second',date('s',$date) );
		
				$this->setTemplateVar('days'  ,date('t',$date) );
		
				$this->setTemplateVar('title' ,lang('MONTH'.date('n',$date)).' '.date('Y',$date) );
				
				// Wochentag des 1. des Monats ermitteln
				$wday1 = date( 'w',$date );
				$wday1 -= date('j',$date)-1;
				while( $wday1 < 0 ) $wday1+=7;
				$this->setTemplateVar('first_weekday',$wday1);
				
				$this->setTemplateVar('actdate' ,date( lang('DATE_FORMAT'),$date ) );
				$this->setTemplateVar('todayurl','?year='.date('Y').'&month='.date('m').'&day='.date('d').'&hour='.date('H').'&minute='.date('i').'&second='.date('s') );
				$this->setTemplateVar('ansidate',date( 'Y-m-d H:i:s',$date ) );
				$this->setTemplateVar('date'    ,$date);

				$all_years   = array();
				$all_months  = array();
				$all_days    = array();
				$all_hours   = array();
				$all_minutes = array();
				for( $i=1850; $i<=2100;$i++ ) $all_years  [$i] = $i; 
				for( $i=1;    $i<=12;  $i++ ) $all_months [$i] = lang('MONTH'.$i); 
				for( $i=1;    $i<=31;  $i++ ) $all_days   [$i] = str_pad($i,2,'0',STR_PAD_LEFT); 
				for( $i=0;    $i<=23;  $i++ ) $all_hours  [$i] = str_pad($i,2,'0',STR_PAD_LEFT); 
				for( $i=0;    $i<=59;  $i++ ) $all_minutes[$i] = str_pad($i,2,'0',STR_PAD_LEFT);
			
				$this->setTemplateVar('all_years'  ,$all_years  );
				$this->setTemplateVar('all_months' ,$all_months );
				$this->setTemplateVar('all_days'   ,$all_days   );
				$this->setTemplateVar('all_hours'  ,$all_hours  );
				$this->setTemplateVar('all_minutes',$all_minutes);
				$this->setTemplateVar('all_seconds',$all_minutes);
				
				break;
				
			default:
				$this->message('ERROR','unknown element type: '.$this->value->element->type );
		}
	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page = new Page( $this->getSessionVar('objectid') );
		if	( $this->value->page->hasRight('release') )
			$this->setTemplateVar( 'release',true  );
		else	$this->setTemplateVar( 'release',false );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}


	/**
	 * Benutzen eines alten Inhaltes
	 */
	function usevalue()
	{
		$this->value->valueid = $this->getRequestVar('valueid');
		
		// Das ausgewählte Element für die Bearbeitung verwenden
		$this->callSubAction('edit');
	}


	/**
	 * Freigeben eines Inhaltes
	 */
	function release()
	{
		$this->value->languageid = $this->getSessionVar('languageid');
		$this->value->objectid   = $this->getSessionVar('objectid');
		$this->value->pageid     = Page::getPageIdFromObjectId( $this->getSessionVar('objectid') );
		$this->value->element = new Element( $this->getSessionVar('elementid') );

		$this->value->valueid = $this->getRequestVar('valueid');
		$this->value->release();
		
		// Versionen anzeigen
		$this->callSubAction('archive');
	}


	/**
	 * Erzeugt eine Liste aller Versionsstände zu diesem Inhalt
	 */
	function archive()
	{
		$this->value->page = new Page( $this->getSessionVar('objectid') );
		$this->value->page->load();
		$this->value->page->public = true;
		$this->value->page->simple = true;

		$this->value->simple = true;
		$this->value->languageid = $this->getSessionVar('languageid');
		$this->value->objectid   = $this->getSessionVar('objectid'  );
		$this->value->pageid     = Page::getPageIdFromObjectId( $this->getSessionVar('objectid') );
		$this->value->element    = new Element( $this->getSessionVar('elementid') );
		$this->value->element->load();

		$list = array();

		foreach( $this->value->getVersionList() as $valueid )
		{
			$this->value->valueid = $valueid;
			$this->value->loadWithId();
			$this->value->generate();

			if	( $this->value->lastchangeTimeStamp != 0 )
				$date = date( lang('DATE_FORMAT'),$this->value->lastchangeTimeStamp);
			else $date = '&nbsp;';

			if	( ! $this->value->active )
				$useUrl = Html::url(array('action'   =>'pageelement',
			                                            'subaction'=>'usevalue',
			                                            'valueid'  =>$valueid ));
			else	$useUrl = '';

			if	( ! $this->value->publish && $this->value->active )
				$releaseUrl = Html::url(array('action'   =>'pageelement',
			                                                'subaction'=>'release',
			                                                'valueid'  =>$valueid ));
			else	$releaseUrl = '';

			if	( $this->value->publish )
				$public = true;
			else $public = false;

			if	( $this->value->active )
				$active = true;
			else $active = false;

			$list[] = array( 'value'     => Text::maxLaenge( 50,$this->value->value),
			                 'date'      => $date,	
			                 'user'      => User::getUserName($this->value->lastchangeUserId),
			                 'useUrl'    => $useUrl,
			                 'public'    => $public,  
			                 'active'    => $active,  
			                 'releaseUrl'=> $releaseUrl );
		}

		$this->setTemplateVar('name',$this->value->element->name);
		$this->setTemplateVar('el',$list);
		$this->forward('pageelement_archive');
	}
}

?>