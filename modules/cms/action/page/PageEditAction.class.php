<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\Value;

class PageEditAction extends PageAction implements Method {
    public function view() {
        $template = new Template( $this->page->templateid );
        $template->load();

        /** @var Element[] $elements */
        $elements = $template->getElements();

        $elements = array_filter(/**
         * @param $element Element
         * @return Element
         */ $elements, function($element ) {
            return $element->isWritable();
        } );

        $elements = array_map( function( $element ) {
            return get_object_vars( $element ) + array('pageelementid'=>$this->page->id.'_'.$element->elementid,'typename'=>$element->getTypeName() );
        }, $elements);

		$this->setTemplateVar('elements',$elements);
    }

    public function post() {
		$value = new Value();
		$value->languageid = $this->page->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( ! $this->hasRequestVar('elementid') )
            $this->addValidationError('elementid' );

        $value->element = new Element( $this->getRequestVar('elementid') );

		$value->element->load();
		$value->load();

		$value->number         = $this->getRequestVar('number') * pow(10,$value->element->decimals);
		$value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));
		$value->text           = $this->getRequestVar('text');

		// Vorschau anzeigen
		if	( $value->element->type=='longtext' && ($this->hasRequestVar('preview')||$this->hasRequestVar('addmarkup')) )
		{
			/*
			if	( $this->hasRequestVar('preview') )
			{
				$value->page             = $this->page;
				$value->simple           = false;
				$value->page->languageid = $value->languageid;
				$value->page->load();
				$value->generate();
				$this->setTemplateVar('preview_text',$value->value );
			}*/

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
				$o = new BaseObject( $id );
				$o->load();

				if	( $o->getType() != 'folder' )
				{
					$f = new Folder( $o->parentid );
					$objects[ $id ]  = \cms\base\Language::lang( ''.$o->getType() ).': ';
					$objects[ $id ] .=  implode( \util\Text::FILE_SEP,$f->parentObjectNames(false,true) );
					$objects[ $id ] .= \util\Text::FILE_SEP.$o->name;
				}
			}
			asort($objects);
			$this->setTemplateVar( 'objects' ,$objects );

			$this->setTemplateVar( 'release' ,$this->page->hasRight(Permission::ACL_RELEASE) );
			$this->setTemplateVar( 'publish' ,$this->page->hasRight(Permission::ACL_PUBLISH) );
			$this->setTemplateVar( 'html'    ,$value->element->html );
			$this->setTemplateVar( 'wiki'    ,$value->element->wiki );
			$this->setTemplateVar( 'text'    ,$value->text          );
			$this->setTemplateVar( 'name'    ,$value->element->name );
			$this->setTemplateVar( 'desc'    ,$value->element->desc );
			$this->setTemplateVar( 'objectid',$this->page->objectid );
			return;
		}

		if	( $this->hasRequestVar('year') ) // Wird ein Datum gespeichert?
		{
			// Wenn ein ANSI-Datum eingegeben wurde, dann dieses verwenden
			if   ( $this->getRequestVar('ansidate') != $this->getRequestVar('ansidate_orig') )
				$value->date = strtotime($this->getRequestVar('ansidate') );
			else
				// Sonst die Zeitwerte einzeln zu einem Datum zusammensetzen
				$value->date = mktime( $this->getRequestVar('hour'  ),
				                       $this->getRequestVar('minute'),
				 	                   $this->getRequestVar('second'),
				 	                   $this->getRequestVar('month' ),
					                   $this->getRequestVar('day'   ),
					                   $this->getRequestVar('year'  ) );
		}
		else $value->date = 0; // Datum nicht gesetzt.

		$value->text = $this->getRequestVar('text');

		$value->page = new Page( $value->objectid );
		$value->page->load();

		// Inhalt sofort freigegeben, wenn
		// - Recht vorhanden
		// - Freigabe gewuenscht
		if	( $value->page->hasRight( Permission::ACL_RELEASE ) && $this->getRequestVar('release')!='' )
			$value->publish = true;
		else
			$value->publish = false;

		// Inhalt speichern

		// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
		// fuer jede Sprache einzeln gespeichert.
		if	( $value->element->allLanguages )
		{
			$project = new Project( $this->page->projectid );
			foreach( $project->getLanguageIds() as $languageid )
			{
				$value->languageid = $languageid;
				$value->add();
			}
		}
		else
		{
			// sonst nur 1x speichern (fuer die aktuelle Sprache)
			$value->add();
		}

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen
    }
}
