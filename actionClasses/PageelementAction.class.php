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
// Revision 1.9  2004-10-14 21:08:32  dankert
// Vergleichen von Versionen
//
// Revision 1.8  2004/10/13 21:19:50  dankert
// Lesen der Selectitem-Liste ueber Element-Objekt
//
// Revision 1.7  2004/07/07 20:43:48  dankert
// Neuer Elementtyp: select
//
// Revision 1.6  2004/05/30 21:55:21  dankert
// Korrektur Kasten "Freigabe"
//
// Revision 1.5  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.4  2004/05/02 12:00:26  dankert
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
 * @package openrat.actions
 */
class PageelementAction extends Action
{
	var $defaultSubAction = 'edit';


	/**
	 * Enth?lt das Seitenobjekt
	 * @type Object
	 */
	var $page;
	
	/**
	 * Enth?lt das Elementobjekt
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
		

			case 'select':
				$this->setTemplateVar( 'items',$this->value->element->getSelectItems() );
				$this->setTemplateVar( 'text' ,$this->value->text                      );

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

		$this->value->page             = new Page( $this->getSessionVar('objectid') );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

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
		
		// Das ausgew?hlte Element f?r die Bearbeitung verwenden
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
	 * Erzeugt eine Liste aller Versionsst?nde zu diesem Inhalt
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

		$list         = array();
		$version_list = array();
		$lfd_nr       = 0;

		foreach( $this->value->getVersionList() as $valueid )
		{
			$lfd_nr++;
			$this->value->valueid = $valueid;
			$this->value->loadWithId();
			$this->value->generate();

			if	( $this->value->lastchangeTimeStamp != 0 )
				$date = date( lang('DATE_FORMAT'),$this->value->lastchangeTimeStamp);
			else $date = lang('UNKNOWN');
			
			if	( in_array(	$this->value->element->type,array('text','longtext') ) )
				$version_list[ $valueid ] = '('.$lfd_nr.') '.$date;

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
			                 'lfd_nr'    => $lfd_nr,	
			                 'user'      => User::getUserName($this->value->lastchangeUserId),
			                 'useUrl'    => $useUrl,
			                 'public'    => $public,  
			                 'active'    => $active,  
			                 'releaseUrl'=> $releaseUrl );
		}

		$this->setTemplateVar('name'        ,$this->value->element->name);
		$this->setTemplateVar('el'          ,$list);
		$this->setTemplateVar('version_list',$version_list);
		$this->forward('pageelement_archive');
	}


	/**
	 * Vergleicht 2 Versionen eines Inhaltes
	 */
	function diff()
	{
		$value1id = $this->getRequestVar('value1id');
		$value2id = $this->getRequestVar('value2id');

		// Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
		if	( $value1id > $value2id )
			list($value1id,$value2id) = array( $value2id,$value1id );

		
		$value1 = new Value( $value1id );
		$value2 = new Value( $value2id );
		$value1->valueid = $value1id;
		$value2->valueid = $value2id;
		
		$value1->loadWithId();
		$value2->loadWithId();

		Logger::debug( 'comparing value '.$value1id.' with '.$value2id );

		$date1 = date( lang('DATE_FORMAT'),$value1->lastchangeTimeStamp);
		$this->setTemplateVar('title1',$date1);

		$date2 = date( lang('DATE_FORMAT'),$value2->lastchangeTimeStamp);
		$this->setTemplateVar('title2',$date2);
		
		$text1 = explode("\n",$value1->text);
		$text2 = explode("\n",$value2->text);

		$res_diff = $this->textdiff($text1,$text2);
		#echo "<pre>";
		#print_r($res_diff);
		#echo "</pre>";
		list( $text1,$text2 ) = $res_diff;

		$this->setTemplateVar('text1',$text1 );
		$this->setTemplateVar('text2',$text2 );

		$this->forward('pageelement_diff');
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
}

?>