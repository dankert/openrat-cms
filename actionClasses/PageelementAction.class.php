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


/**
 * Action-Klasse zum Bearbeiten eines Seitenelementes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class PageelementAction extends Action
{
	var $defaultSubAction = 'edit';


	/**
	 * Enthaelt das Seitenobjekt
	 * @type Object
	 */
	var $page;
	
	/**
	 * Enthaelt das Elementobjekt
	 * @type Object
	 */
	var $element;
	
	
	/**
	 * Enthält den Inhalt
	 *
	 * @var Object
	 */
	var $value;



	/**
	 * Konstruktor
	 */
	function PageelementAction()
	{
		$this->value = new Value();

		$this->page = Session::getObject();
		
		if	( $this->getRequestId() != 0  )
		{
			$this->page = new Page( $this->getRequestId() );
			$this->page->load();
			Session::setObject( $this->page );
		}
		else
		{
			$this->page = Session::getObject();
		}

		if	( $this->hasRequestVar('elementid') )
		{
			$this->element = new Element( $this->getRequestVar('elementid') );
			Session::setElement( $this->element );
		}
		else
		{
			$this->element = Session::getElement();
		}
	}



	function show()
	{
		$language = Session::getProjectLanguage();
		$this->value->languageid = $language->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->publish = false;
		$this->value->load();

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );
		$this->setTemplateVar('elementid',$this->value->element->elementid);
		$this->setTemplateVar('type'     ,$this->value->element->type     );




		$this->value->generate();
		$this->setTemplateVar('value',$this->value->value);
	}


	/**
	 * Ein Element der Seite bearbeiten
	 *
	 * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
	 */
	function advanced()
	{
		$language = Session::getProjectLanguage();
		$this->value->languageid = $language->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->publish = false;

		if	( intval($this->value->valueid)!=0 )
			$this->value->loadWithId();
		else	$this->value->load();

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );
		$this->setTemplateVar('elementid',$this->value->element->elementid);
		$this->setTemplateVar('type'     ,$this->value->element->type     );
		
		$funktionName = 'advanced'.$this->value->element->type;
		$this->$funktionName();
	}
	
	
	
	/**
	 * Ein Element der Seite bearbeiten
	 *
	 * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
	 */
	function edit()
	{
		$language = Session::getProjectLanguage();
		$this->value->languageid = $language->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->publish = false;

		if	( intval($this->value->valueid)!=0 )
			$this->value->loadWithId();
		else	$this->value->load();

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );
		$this->setTemplateVar('elementid',$this->value->element->elementid);
		$this->setTemplateVar('type'     ,$this->value->element->type     );
		
		$funktionName = 'edit'.$this->value->element->type;
		$this->$funktionName();
	}
	
	
	
	function editdate()
	{
		$date =  $this->value->date;

		// Wenn Datum nicht vorhanden, dann aktuelles Datum verwenden
		if	( $date == 0 )
			$date = intval(time()/60)*60;

		$this->setTemplateVar('ansidate',date( 'Y-m-d H:i:s',$date ) );
		$this->setTemplateVar('date'    ,$date);

		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);		
	}
	
	
	
	function advanceddate()
	{
		global $conf;
		$date = $this->value->date;

		// Wenn Datum nicht vorhanden, dann aktuelles Datum verwenden
		if	( $date == 0 )
			$date = time();

		if   ( $this->hasRequestVar('year') )
		{
			$date = mktime( $this->getRequestVar('hour'),
			                $this->getRequestVar('minute'),
			                $this->getRequestVar('second'),
			                $this->getRequestVar('month'),
			                $this->getRequestVar('day'),
			                $this->getRequestVar('year')    );
		}
		$year   = date('Y',$date);
		$month  = date('n',$date);
		$day    = date('j',$date);
		$hour   = date('G',$date);
		$minute = date('i',$date);
		$second = date('s',$date);
		$this->setTemplateVar('year'  ,$year   );
		$this->setTemplateVar('month' ,$month  );
		$this->setTemplateVar('day'   ,$day    );
		$this->setTemplateVar('hour'  ,$hour   );
		$this->setTemplateVar('minute',$minute );
		$this->setTemplateVar('second',$second );

		$this->setTemplateVar('monthname',lang('DATE_MONTH'.date('n',$date)) );
		$this->setTemplateVar('yearname' ,date('Y',$date) );


		// Zwischenberechnungen		
		$heuteTag         = intval(date('j'));
		$monatLetzterTag  = intval(date('t',$date));
		$monatErsterDatum = $date-(($day-1)*86400);
		$wocheNr          = date( 'W',$monatErsterDatum );
		$wochentagErster  = date( 'w',$monatErsterDatum );


		$weekdayOffset = intval($conf['editor']['calendar']['weekday_offset']);
		
		// Alle Wochentage
		$weekdays = array();
		for  ( $i=0; $i<=6; $i++ )
		{
			$wday = ($i+$weekdayOffset)%7;
			$weekdays[$wday] = lang('DATE_WEEKDAY'.$wday);
		}
			
		$this->setTemplateVar('weekdays',$weekdays);
		

		$monat = array();
		$d = 0;
		$begin = false;
		do
		{
			$woche = array(); // Neue Woche
			
			for  ( $i=0; $i<=6; $i++ ) // Alle Wochentage der Woche
			{
				$wday = ($i+$weekdayOffset)%7;
				$tag = array(); // Neuer Tag
				
				if   (!$begin && $wday == $wochentagErster)
					$begin = true;
				
				if   ( $begin && $d < $monatLetzterTag )
				{
					$d++;
					$tag['nr']    = $d;
					$tag['today'] = ($year==date('Y') && $month==date('n') && $d==$heuteTag);
					if   ($d != $day)
						$tag['url'] = Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>$year  ,
						                               'month' =>$month ,
						                               'day'   =>$d     ,
						                               'hour'  =>$hour  ,
						                               'minute'=>$minute,
						                               'second'=>$second  ) );
					else
						$tag['url'] = '';
				}
				else
				{
					$tag['nr'    ]='';
					$tag['today' ]=false;
					$tag['url'   ]='';
				}
				$woche[] = $tag;
				
			}
			$monat[$wocheNr] = $woche;
			$wocheNr++;
		}
		while( $d < $monatLetzterTag-1 );
//		Html::debug($monat);
		$this->setTemplateVar('weeklist',$monat);
		
		$this->setTemplateVar('actdate' ,date( lang('DATE_FORMAT'),$date ) );
		$this->setTemplateVar('todayurl',Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>date('Y'),
						                               'month' =>date('n'),
						                               'day'   =>date('j'),
						                               'hour'  =>date('G'),
						                               'minute'=>date('i'),
						                               'second'=>date('s') ) ) );
		$this->setTemplateVar('lastyearurl',Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>$year-1,
						                               'month' =>$month ,
						                               'day'   =>$day   ,
						                               'hour'  =>$hour  ,
						                               'minute'=>$minute,
						                               'second'=>$second  ) ) );
		$this->setTemplateVar('nextyearurl',Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>$year+1 ,
						                               'month' =>$month ,
						                               'day'   =>$day   ,
						                               'hour'  =>$hour  ,
						                               'minute'=>$minute,
						                               'second'=>$second  ) ) );
		$this->setTemplateVar('lastmonthurl',Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>$year  ,
						                               'month' =>$month-1,
						                               'day'   =>$day   ,
						                               'hour'  =>$hour  ,
						                               'minute'=>$minute,
						                               'second'=>$second  ) ) );
		$this->setTemplateVar('nextmonthurl',Html::url( 'pageelement','advanced','',
						                         array('elementid'=>$this->element->elementid,
						                               'year'  =>$year  ,
						                               'month' =>$month+1,
						                               'day'   =>$day   ,
						                               'hour'  =>$hour  ,
						                               'minute'=>$minute,
						                               'second'=>$second  ) ) );
						                               
//		$this->setTemplateVar('date'    ,$date);



		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );



		$all_years   = array();
		$all_months  = array();
		$all_days    = array();
		$all_hours   = array();
		$all_minutes = array();
		for( $i=$year-100; $i<=$year+100;$i++ ) $all_years  [$i] = $i; 
		for( $i=1;    $i<=12;  $i++ ) $all_months [$i] = lang('DATE_MONTH'.$i); 
		for( $i=1;    $i<=31;  $i++ ) $all_days   [$i] = str_pad($i,2,'0',STR_PAD_LEFT); 
		for( $i=0;    $i<=23;  $i++ ) $all_hours  [$i] = str_pad($i,2,'0',STR_PAD_LEFT); 
		for( $i=0;    $i<=59;  $i++ ) $all_minutes[$i] = str_pad($i,2,'0',STR_PAD_LEFT);
	
		$this->setTemplateVar('all_years'  ,$all_years  );
		$this->setTemplateVar('all_months' ,$all_months );
		$this->setTemplateVar('all_days'   ,$all_days   );
		$this->setTemplateVar('all_hours'  ,$all_hours  );
		$this->setTemplateVar('all_minutes',$all_minutes);
		$this->setTemplateVar('all_seconds',$all_minutes);
	}
	
	
	
	function asdfasdf()
	{
		// Auswahl ueber alle Elementtypen
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
//						$f->load();
						
						$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
						$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
						$objects[ $id ] .= FILE_SEP.$o->name;
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
					
					$objects[ $id ]  = lang( 'GLOBAL_'.$f->getType() ).': '; 
					$objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
				}
		
				asort( $objects ); // Sortieren
		
				$this->setTemplateVar('objects'         ,$objects);
				$this->setTemplateVar('act_linkobjectid',$this->value->linkToObjectId);

				break;
		

			case 'select':
				$this->setTemplateVar( 'items',$this->value->element->getSelectItems() );
				$this->setTemplateVar( 'text' ,$this->value->text                      );

				break;
		

			case 'number':
				$this->setTemplateVar('number',$this->value->number / pow(10,$this->value->element->decimals) );
				break;


			case 'longtext':

				// Ermitteln aller verlinkbaren Objekte (fuer Editor)
				$objects = array();
		
				foreach( Folder::getAllObjectIds() as $id )
				{
					$o = new Object( $id );
					$o->load();
					
					if	( $o->getType() != 'folder' )
					{ 
						$f = new Folder( $o->parentid );
						$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
						$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
						$objects[ $id ] .= FILE_SEP.$o->name;
					} 
				}
				asort( $objects ); // Sortieren

				$this->setTemplateVar( 'objects',$objects );
				$this->setTemplateVar( 'images' ,$objects );

			case 'text':
				$this->setTemplateVar( 'html',$this->value->element->html );
				$this->setTemplateVar( 'wiki',$this->value->element->wiki );
				$this->setTemplateVar( 'text',$this->value->text          );
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
		
				$this->setTemplateVar('title' ,lang('DATE_MONTH'.date('n',$date)).' '.date('Y',$date) );
				
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
				for( $i=1;    $i<=12;  $i++ ) $all_months [$i] = lang('DATE_MONTH'.$i); 
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
				// Unbekannter Typ, Abbruch
				die( 'unknown element type: '.$this->value->element->type );
		}
	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function editlink()
	{

		// Ermitteln, welche Objekttypen verlinkt werden dürfen.
		if	( empty($this->value->element->subtype) )
			$types = array('page','file','link'); // Fallback: Alle erlauben :)
		else
			$types = explode(',',$this->value->element->subtype );

//		Html::debug($this->value->element,'Element');
//		Html::debug($types,'Typen1');
		$objects = array();

		foreach( Folder::getAllObjectIds($types) as $id )
		{
			$o = new Object( $id );
			$o->load();
			
//			if	( in_array( $o->getType(),$types ))
//			{ 
				$f = new Folder( $o->parentid );
//					$f->load();
				
				$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
				$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
				$objects[ $id ] .= FILE_SEP.$o->name;
//			} 
		}

		asort( $objects ); // Sortieren

		$this->setTemplateVar('objects'         ,$objects);
		$this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function link()
	{
		$language = Session::getProjectLanguage();
		$this->value->languageid = $language->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->publish = false;
		$this->value->load();

		// Ermitteln, welche Objekttypen verlinkt werden dürfen.
		if	( empty($this->value->element->subtype) )
			$types = array('page','file','link'); // Fallback: Alle erlauben :)
		else
			$types = explode(',',$this->value->element->subtype );

//		Html::debug($this->value->element,'Element');
//		Html::debug($types,'Typen1');
		$objects = array();

		$t = new Template( $this->page->templateid );
		
		foreach( $t->getDependentObjectIds() as $id )
		{
			$o = new Object( $id );
			$o->load();
			
//			if	( in_array( $o->getType(),$types ))
//			{ 
				$f = new Folder( $o->parentid );
//					$f->load();
				
				$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
				$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
				$objects[ $id ] .= FILE_SEP.$o->name;
//			} 
		}

		asort( $objects ); // Sortieren

		$this->setTemplateVar('objects'         ,$objects);
//		Html::debug($this->value,'Value');
		$this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function editselect()
	{
		$this->setTemplateVar( 'items',$this->value->element->getSelectItems() );
		$this->setTemplateVar( 'text' ,$this->value->text                      );

	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function editlist()
	{
		// Auswahl ueber alle Elementtypen
		$objects = array();
		foreach( Folder::getAllFolders() as $id )
		{
			$f = new Folder( $id );
			$f->load();
			
			$objects[ $id ]  = lang( 'GLOBAL_'.$f->getType() ).': '; 
			$objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
		}

		asort( $objects ); // Sortieren

		$this->setTemplateVar('objects'         ,$objects);
		$this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function editnumber()
	{
		$this->setTemplateVar('number',$this->value->number / pow(10,$this->value->element->decimals) );

		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		$this->forward('pageelement_edit_'.$this->value->element->type);
	}



	function advancedlongtext() 
	{
		$this->editlongtext();
	}
	
	
	
	/**
	 * Ein Element der Seite bearbeiten
	 *
	 * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
	 */
	function editlongtext()
	{
		// Ermitteln aller verlinkbaren Objekte (fuer Editor)
		$objects = array();

		foreach( Folder::getAllObjectIds() as $id )
		{
			$o = new Object( $id );
			$o->load();
			
			if	( $o->getType() != 'folder' )
			{ 
				$f = new Folder( $o->parentid );
				$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
				$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
				$objects[ $id ] .= FILE_SEP.$o->name;
			} 
		}
		asort( $objects ); // Sortieren

		$this->setTemplateVar( 'objects',$objects );
		$this->setTemplateVar( 'images' ,$objects );

		if	($this->value->element->html)
			$this->setTemplateVar( 'editor','html' );
		elseif	($this->value->element->wiki)
			$this->setTemplateVar( 'editor','wiki' );
		else
			$this->setTemplateVar( 'editor','text' );

		$this->setTemplateVar( 'text',$this->value->text          );
	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );
	}



	/**
	 * Ein Element der Seite bearbeiten
	 *
	 * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
	 */
	function edittext()
	{
		$this->setTemplateVar( 'text',$this->value->text          );
	
		if	( $this->getSessionVar('pageaction') != '' )
			$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else	$this->setTemplateVar('old_pageaction','show'                            );

		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'release',$this->value->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->value->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );
	}



	/**
	 * Benutzen eines alten Inhaltes
	 */
	function usevalue()
	{
		$this->value->valueid = $this->getRequestVar('valueid');
		
		// Das ausgew?hlte Element fuer die Bearbeitung verwenden
		//$this->callSubAction('edit');
	}



	/**
	 * Freigeben eines Inhaltes
	 */
	function release()
	{
		$this->value->valueid = intval($this->getRequestVar('valueid'));
		$this->value->loadWithId();
		
		if	( $this->value->pageid != $this->page->pageid )
			die( 'cannot release, bad page' );

		// Pruefen, ob Berechtigung zum Freigeben besteht
		if	( !$this->page->hasRight(ACL_RELEASE) )
			die( 'cannot release, no right' );
		
		// Inhalt freigeben
		$this->value->release();
		
		// Versionen anzeigen
		$this->callSubAction('archive');
	}


	/**
	 * Erzeugt eine Liste aller Versionsst?nde zu diesem Inhalt
	 */
	function archive()
	{
		$this->page->public = true;
		$this->page->simple = true;
		$this->page->load();
		$this->value->page = &$this->page;

		$this->value->simple = true;
		$language = Session::getProjectLanguage();
		$this->value->languageid = $language->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
		$this->value->element    = &$this->element;
		$this->value->element->load();

		$list         = array();
//		$version_list = array();
		$lfd_nr       = 0;

		foreach( $this->value->getVersionList() as $value )
		{
			$lfd_nr++;
			$value->element = &$this->element;
			$value->page    = &$this->page;
			$value->simple  = true;
			$value->generate();
			

//			$date = date( lang('DATE_FORMAT'),$value->lastchangeTimeStamp);
			
//			if	( in_array(	$this->element->type,array('text','longtext') ) )
//				$version_list[ $value->valueid ] = '('.$lfd_nr.') '.$date;

			$zeile = array(  'value'     => Text::maxLaenge( 50,$value->value),
			                 'date'      => $value->lastchangeTimeStamp,	
			                 'lfd_nr'    => $lfd_nr,	
			                 'id'        => $value->valueid,	
			                 'user'      => $value->lastchangeUserName );

			// Nicht aktive Inhalte können direkt bearbeitet werden und sind
			// nach dem Speichern dann wieder aktiv (natürlich als nächster/neuer Inhalt) 
			if	( ! $value->active )
				$zeile['useUrl'] = Html::url('pageelement','usevalue',$this->page->objectid,array('valueid'  =>$value->valueid));

			// Freigeben des Inhaltes.
			// Nur das aktive Inhaltselement kann freigegeben werden. Natürlich auch nur,
			// wenn es nicht schon freigegeben ist.
			if	( ! $value->publish && $value->active )
				$zeile['releaseUrl'] = Html::url('pageelement','release',$this->page->objectid,array('valueid'  =>$value->valueid ));

			$zeile['public'] = $value->publish;
			$zeile['active'] = $value->active;

			$list[$lfd_nr] = $zeile;
			             
		}

		
		$this->setTemplateVar('compareid',$list[$lfd_nr-1]['id']);
		$this->setTemplateVar('withid'   ,$list[$lfd_nr  ]['id']);
		$this->setTemplateVar('name'     ,$value->element->name);
		$this->setTemplateVar('el'       ,$list);
		
//		Html::debug( $this->templateVars);
//		$this->setTemplateVar('version_list',$version_list);
	}


	/**
	 * Vergleicht 2 Versionen eines Inhaltes
	 */
	function diff()
	{
		$value1id = $this->getRequestVar('compareid');
		$value2id = $this->getRequestVar('withid'   );

		// Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
		if	( $value1id == $value2id )
		{
			$this->addValidationError('compareid'   );
			$this->addValidationError('withid'   ,'');
			$this->callSubAction('archive');
			return;
		}

		// Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
		if	( $value1id > $value2id )
			list($value1id,$value2id) = array( $value2id,$value1id );

		
		$value1 = new Value( $value1id );
		$value2 = new Value( $value2id );
		$value1->valueid = $value1id;
		$value2->valueid = $value2id;
		
		$value1->loadWithId();
		$value2->loadWithId();

		$this->setTemplateVar('date_left' ,$value1->lastchangeTimeStamp);
		$this->setTemplateVar('date_right',$value2->lastchangeTimeStamp);
		
		$text1 = explode("\n",$value1->text);
		$text2 = explode("\n",$value2->text);

		$res_diff = $this->textdiff($text1,$text2);

		list( $text1,$text2 ) = $res_diff;

		$diff = array();
		$i = 0;
      	while( isset($text1[$i]) || isset($text2[$i]) )
      	{
      		$line = array();

      		if	( isset($text1[$i]['text']) )
      			$line['left'] = $text1[$i];

      		if	( isset($text2[$i]['text']) )
      			$line['right'] = $text2[$i];

      		$i++;
      		$diff[] = $line;
		}
		$this->setTemplateVar('diff',$diff );
	}


	/**
	 * Vergleicht 2 Text-Arrays und ermittelt eine Darstellung der Unterschiede
	 *
	 */
	function textdiff( $from_text,$to_text )
	{
		// Zaehler pro Textarray
		$pos_from = -1;
		$pos_to   = -1;

		// Ergebnis-Arrays
		$from_out = array();
		$to_out   = array();

		while( true )
		{
			$pos_from++;
			$pos_to  ++;

			if	( !isset($from_text[$pos_from]) &&
				  !isset($to_text  [$pos_to  ]) )
			{
				// Text in ist 'neu' und 'alt' zuende. Ende der Schleife.
				break;
			}
			elseif
				(  isset($from_text[$pos_from]) &&
				  !isset($to_text  [$pos_to]) )
			{
				// Text in 'neu' ist zuende, die Restzeilen von 'alt' werden ausgegeben
				while( isset($from_text[$pos_from]) )
				{
					$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'old');  
					$to_out  [] = array();
					$pos_from++;
				}
				break;  
			}
			elseif
				( !isset($from_text[$pos_from]) &&
				   isset($to_text  [$pos_to]) )
			{
				// Umgekehrter Fall: Text in 'alt' ist zuende, Restzeilen aus 'neu' werden ausgegeben
				while( isset($to_text[$pos_to]) )
				{
					$from_out[] = array();  
					$to_out  [] = array('text'=>$to_text[$pos_to],'line'=>$pos_to+1,'type'=>'new');  
					$pos_to++;
				}
				break;  
			}
			elseif
				( rtrim($from_text[$pos_from]) != rtrim($to_text[$pos_to]) )
			{
				// Zeilen sind vorhanden, aber ungleich
				// Wir suchen jetzt die naechsten beiden Zeilen, die gleich sind.
				$max_entf = min(count($from_text)-$pos_from-1,count($to_text)-$pos_to-1);

				#echo "suche start, max_entf=$max_entf, pos_from=$pos_from, pos_to=$pos_to<br/>";
				
				for ( $a=0; $a<=$max_entf; $a++ )
				{
					#echo "a ist $a<br/>";
					for	( $b=0; $b<=$max_entf; $b++ )
					{
						#echo "b ist $b<br/>";
						if	( trim($from_text[$pos_from+$b]) != '' &&
							  $from_text[$pos_from+$b] == $to_text[$pos_to+$a] )
						{
							$pos_gef_from = $pos_from+$b;
							$pos_gef_to   = $pos_to  +$a;
							break;
						}

						if	( trim($from_text[$pos_from+$a]) != ''  &&
							  $from_text[$pos_from+$a] == $to_text[$pos_to+$b] )
						{
							$pos_gef_from = $pos_from+$a;
							$pos_gef_to   = $pos_to  +$b;
							break;
						}
					}

					if	( $b <=$max_entf)
					{
						break;
					}
				}

				if	( $a<=$max_entf )
				{
					// Gleiche Zeile gefunden
					#echo "gefunden, pos_gef_from=$pos_gef_from, pos_gef_to=$pos_gef_to<br/>";
					
					if	( $pos_gef_from - $pos_from == 0 )
						$type = 'new';
					elseif
						( $pos_gef_to - $pos_to == 0 )
						$type = 'old';
					else
						$type = 'notequal';

					while( $pos_gef_from - $pos_from > 0 &&
					       $pos_gef_to   - $pos_to   > 0    )
					{
						$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>$type);
						$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>$type);
						
						$pos_from++;
						$pos_to++;
					}

					while( $pos_gef_from - $pos_from > 0 )
					{
						$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>$type);
						$to_out  [] = array();
						$pos_from++;
					}

					while( $pos_gef_to - $pos_to   > 0 )
					{
						$from_out[] = array();
						$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>$type);
						$pos_to++;
					}
					$pos_from--;
					$pos_to--;
				}
				else
				{
					// Keine gleichen Zeilen gefunden
					#echo "nicht gefunden, i=$i, j=$j, pos_from war $pos_from, pos_to war $pos_to<br/>";

					while( true )
					{
						if	( !isset($from_text[$pos_from]) &&
						      !isset($to_text  [$pos_to  ]) )
						{
							break;
						}
						elseif
							(  isset($from_text[$pos_from]) &&
							  !isset($to_text  [$pos_to  ]) )
						{
							$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'notequal');  
							$to_out  [] = array();
						}
						elseif
							( !isset($from_text[$pos_from]) &&
							   isset($to_text  [$pos_to  ]) )
						{
							$from_out[] = array();  
							$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'notequal');
						}
						else
						{
							$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'notequal');  
							$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'notequal');
						}
						$pos_from++;  
						$pos_to++;
					}
				}
			}
			else
			{
				// Zeilen sind gleich
				$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'equal');  
				$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'equal');  
			}
		}
		
		return( array($from_out,$to_out) );
	}



	/**
	 * Ein Element der Seite speichern.
	 */
	function save()
	{
		$this->element->load();
		$type = $this->element->type;
		if	( empty($type))
			die('Error: No element type available.');
		$funktionName = 'save'.$type;
		Logger::debug('save: '.$this->element->type);
		$this->$funktionName();
	}
	
	
	
	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savetext()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		if   ( $this->hasRequestVar('linkobjectid') )
			$value->linkToObjectId = $this->getRequestVar('linkobjectid');
		else
			$value->text           = $this->getRequestVar('text');

		$this->afterSave($value);
	}



	/**
	 * Nach dem Speichern weitere Dinge ausfuehren.<br>
	 * - Inhalt freigeben<br>
	 * - Seite veroeffentlichen<br>
	 * - Inhalt fuer andere Sprachen speichern<br>
	 * - Hinweis ueber erfolgtes Speichern ausgeben<br>
	 * <br>
	 * Nicht zu verwechseln mit <i>Aftershave</i> :)
	 */
	function afterSave( $value )
	{
		$value->page = new Page( $value->objectid );
		$value->page->load();
		

		// Inhalt sofort freigegeben, wenn
		// - Recht vorhanden
		// - Freigabe gewuenscht
		if	( $value->page->hasRight( ACL_RELEASE ) && $this->getRequestVar('release')!='' )
			$value->publish = true;
		else
			$value->publish = false;

		// Inhalt speichern
		
		// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
		// fuer jede Sprache einzeln gespeichert.
		if	( $value->element->allLanguages )
		{
			$project = Session::getProject();
			foreach( $project->getLanguageIds() as $languageid )
			{
				$value->languageid = $languageid;
				$value->save();
			}
		}
		else
		{
			// sonst nur 1x speichern (fuer die aktuelle Sprache)
			$value->save();
		}

		$this->addNotice('pageelement',$value->element->name,'SAVED','ok');
		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

//		// Falls ausgewaehlt die Seite sofort veroeffentlichen
//		if	( $this->hasRequestVar('publish') )
//			$this->callSubAction( 'pubnow' ); // Weiter zum veroeffentlichen
//		else
//			$this->callSubAction( 'el' ); // Element-Liste anzeigen
	}


	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savelongtext()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();


		if   ( $this->hasRequestVar('linkobjectid') )
			$value->linkToObjectId = $this->getRequestVar('linkobjectid');
		else
			$value->text           = $this->getRequestVar('text');

		// Vorschau anzeigen
		if	( $value->element->type=='longtext' && ($this->hasRequestVar('preview')||$this->hasRequestVar('addmarkup')) )
		{
			if	( $this->hasRequestVar('preview') )
			{
				$value->page             = $this->page;
				$value->simple           = false;
				$value->page->languageid = $value->languageid;
				$value->page->load();
				$value->generate();
				$this->setTemplateVar('preview_text',$value->value );
			}

			if	( $this->hasRequestVar('addmarkup') )
			{
				$addText = $this->getRequestVar('addtext');

				if	( !empty($addText) ) // Nur, wenn ein Text eingegeben wurde
				{
					$addText = $this->getRequestVar('addtext');

					if	( $this->hasRequestVar('strong') )
						$value->text .= '*'.$addText.'*';

					if	( $this->hasRequestVar('emphatic') )
						$value->text .= '_'.$addText.'_';

					if	( $this->hasRequestVar('link') )
						$value->text .= '"'.$addText.'"->"'.$this->getRequestVar('objectid').'"';
				}

				if	( $this->hasRequestVar('table') )
					$value->text .= "|$addText  |  |\n|$addText  |  |\n|$addText  |  |\n";

				if	( $this->hasRequestVar('list') )
					$value->text .= "\n- ".$addText."\n".'- '.$addText."\n".'- '.$addText."\n";

				if	( $this->hasRequestVar('numlist') )
					$value->text .= "\n# ".$addText."\n".'# '.$addText."\n".'# '.$addText."\n";

				if	( $this->hasRequestVar('image') )
					$value->text .= '{'.$this->getRequestVar('objectid').'}';
			}

			// Ermitteln aller verlinkbaren Objekte (fuer Editor)
			$objects = array();
	
			foreach( Folder::getAllObjectIds() as $id )
			{
				$o = new Object( $id );
				$o->load();
				
				if	( $o->getType() != 'folder' )
				{ 
					$f = new Folder( $o->parentid );
					$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': '; 
					$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
					$objects[ $id ] .= FILE_SEP.$o->name;
				} 
			}
			asort($objects);
			$this->setTemplateVar( 'objects' ,$objects );
	
			$this->setTemplateVar( 'release' ,$this->page->hasRight(ACL_RELEASE) );
			$this->setTemplateVar( 'publish' ,$this->page->hasRight(ACL_PUBLISH) );
			$this->setTemplateVar( 'html'    ,$value->element->html );
			$this->setTemplateVar( 'wiki'    ,$value->element->wiki );
			$this->setTemplateVar( 'text'    ,$value->text          );
			$this->setTemplateVar( 'name'    ,$value->element->name );
			$this->setTemplateVar( 'desc'    ,$value->element->desc );
			$this->setTemplateVar( 'objectid',$this->page->objectid );
			$this->forward( 'pageelement_edit_longtext' );
		}
	
		$this->afterSave($value);
	}


	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savedate()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		if   ( $this->hasRequestVar('linkobjectid') )
			$value->linkToObjectId = $this->getRequestVar('linkobjectid');
		elseif   ( $this->getRequestVar('ansidate') != $this->getRequestVar('ansidate_orig') )
			// Wenn ein ANSI-Datum eingegeben wurde, dann dieses verwenden
			$value->date = strtotime($this->getRequestVar('ansidate') );
		else
			// Sonst die Zeitwerte einzeln zu einem Datum zusammensetzen
			$value->date = mktime( $this->getRequestVar('hour'  ),
			                       $this->getRequestVar('minute'),
			 	                   $this->getRequestVar('second'),
			 	                   $this->getRequestVar('month' ),
				                   $this->getRequestVar('day'   ),
				                   $this->getRequestVar('year'  ) );
		
		$this->afterSave($value);
	}



	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function saveselect()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		$value->text           = $this->getRequestVar('text');

		$this->afterSave($value);
	}



	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savelink()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		$value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));

		$this->afterSave($value);
	}




	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savelist()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		$value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));

		$this->afterSave($value);
	}
	
	
	
	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function savenumber()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		if   ( $this->hasRequestVar('linkobjectid') )
			$value->linkToObjectId = $this->getRequestVar('linkobjectid');
		else
			$value->number         = $this->getRequestVar('number') * pow(10,$value->element->decimals);
		
		$this->afterSave($value);
	}
	
	
	function exportlongtext()
	{
		$types = array();
		
		foreach( array('odf','plaintext') as $type )
		{
			$types[$type] = lang('FILETYPE_'.$type);
		}
		
		$this->setTemplateVar('types',$types);
	}	


	function importlongtext()
	{
		$types = array();
		
		foreach( array('odf','plaintext') as $type )
		{
			$types[$type] = lang('FILETYPE_'.$type);
		}
		$this->setTemplateVar('types',$types);
	}	
	
	
	function doexportlongtext()
	{
		$type = $this->getRequestVar('type');
		switch($type)
		{
			case 'odf':
			
				// Angabe Content-Type
//				header('Content-Type: '.$this->file->mimeType());
//				header('X-File-Id: '.$this->file->fileid);
		
//				header('Content-Disposition: inline; filename='.$this->id.'.odt');
				header('Content-Transfer-Encoding: binary');
//				header('Content-Description: '.$this->file->name);
		
				echo $this->createOdfDocument();
				
				exit;
				
			default:
		}

		exit;		
	}
	
	
	function createOdfDocument()
	{
		$transformer = new Transformer();
		$transformer->text = $this->value->text;
		$transformer->type = 'odf';
		$transformer->transform();
		return $transformer->text;
	}
	
	
	function checkMenu( $name )
	{
		$type = $this->value->element->type;
		
		switch( $name )
		{
			case 'show':
			case 'edit':
				return true;
				
			case 'archive':
				if	( is_object($this->value) )
					return $this->value->getCountVersions() > 0;
				else
					return true;

			case 'link':
				return in_array($type,array('date','text','longtext','number'));

			case 'advanced':
				return in_array($type,array('date','longtext','number'));

			default:
				return false;
		}
	}
	
}

?>