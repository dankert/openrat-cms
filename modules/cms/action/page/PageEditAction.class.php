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

		$project   = $this->page->getProject();
		$languages = $project->getLanguages();

		$this->setTemplateVar('languages',$languages);
    }

    public function post() {
		$value = new Value();
		$value->languageid = $this->page->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( ! $this->request->has('elementid') )
            $this->addValidationError('elementid' );

        $value->element = new Element( $this->request->getText('elementid') );

		$value->element->load();
		$value->load();

		$value->number         = $this->request->getText('number') * pow(10,$value->element->decimals);
		$value->linkToObjectId = intval($this->request->getText('linkobjectid'));
		$value->text           = $this->request->getText('text');

		// Vorschau anzeigen
		if	( $value->element->type=='longtext' && ($this->request->has('preview')||$this->request->has('addmarkup')) )
		{
			/*
			if	( $this->request->hasRequestVar('preview') )
			{
				$value->page             = $this->page;
				$value->simple           = false;
				$value->page->languageid = $value->languageid;
				$value->page->load();
				$value->generate();
				$this->setTemplateVar('preview_text',$value->value );
			}*/

			if	( $this->request->has('addmarkup') )
			{
				$addText = $this->request->getText('addtext');

				if	( !empty($addText) ) // Nur, wenn ein Text eingegeben wurde
				{
					$addText = $this->request->getText('addtext');

					if	( $this->request->has('strong') )
						$value->text .= '*'.$addText.'*';

					if	( $this->request->has('emphatic') )
						$value->text .= '_'.$addText.'_';

					if	( $this->request->has('link') )
						$value->text .= '"'.$addText.'"->"'.$this->request->getText('objectid').'"';
				}

				if	( $this->request->has('table') )
					$value->text .= "|$addText  |  |\n|$addText  |  |\n|$addText  |  |\n";

				if	( $this->request->has('list') )
					$value->text .= "\n- ".$addText."\n".'- '.$addText."\n".'- '.$addText."\n";

				if	( $this->request->has('numlist') )
					$value->text .= "\n# ".$addText."\n".'# '.$addText."\n".'# '.$addText."\n";

				if	( $this->request->has('image') )
					$value->text .= '{'.$this->request->getText('objectid').'}';
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

		if	( $this->request->has('year') ) // Wird ein Datum gespeichert?
		{
			// Wenn ein ANSI-Datum eingegeben wurde, dann dieses verwenden
			if   ( $this->request->getVar('ansidate') != $this->request->getVar('ansidate_orig') )
				$value->date = strtotime($this->request->getVar('ansidate') );
			else
				// Sonst die Zeitwerte einzeln zu einem Datum zusammensetzen
				$value->date = mktime( $this->request->getVar('hour'  ),
				                       $this->request->getVar('minute'),
				 	                   $this->request->getVar('second'),
				 	                   $this->request->getVar('month' ),
					                   $this->request->getVar('day'   ),
					                   $this->request->getVar('year'  ) );
		}
		else $value->date = 0; // Datum nicht gesetzt.

		$value->text = $this->request->getVar('text');

		$value->page = new Page( $value->objectid );
		$value->page->load();

		// Inhalt sofort freigegeben, wenn
		// - Recht vorhanden
		// - Freigabe gewuenscht
		if	( $value->page->hasRight( Permission::ACL_RELEASE ) && $this->request->getVar('release')!='' )
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
