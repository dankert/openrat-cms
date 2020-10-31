<?php

namespace cms\action;

use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\Acl;
use cms\model\Project;
use cms\model\Value;
use cms\model\Element;
use cms\model\Template;
use cms\model\Page;
use cms\model\Folder;
use cms\model\BaseObject;
use cms\model\Language;
use cms\generator\PageContext;
use configuration\Config;
use util\Html;
use logger\Logger;
use util\Session;


/**
 * Action-Klasse zum Bearbeiten einer Seite
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class PageAction extends ObjectAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Page
     */
	private $page;


	function __construct()
	{
	    parent::__construct();

    }


    public function init()
    {
        $page = new Page( $this->getRequestId() );
        //$context = new PageContext();
        //$context->sourceObjectId = $page->objectid;

//		if  ( $this->request->hasLanguageId())
//			$context->languageId = $this->request->getLanguageId();
//
//		if  ( $this->request->hasModelId())
//			$context->modelId = $this->request->getModelId();

		$page->load();
//
//        if  ( !$context->languageId )
//			$context->languageId = $page->getProject()->getDefaultLanguageId();
//
//        if  ( !$context->modelId )
//			$context->modelId = $page->getProject()->getDefaultModelId();

//        $page->languageid = $context->languageId;
//        $page->modelid    = $context->modelId
//        $page->context = $context;

		// Hier kann leider nicht das Datum der letzten Änderung verwendet werden,
		// da sich die Seite auch danach ändern kann, z.B. durch Includes anderer
		// Seiten oder Änderung einer Vorlage oder Änderung des Dateinamens einer
		// verlinkten Datei.
		$this->lastModified( time() );

		$this->setBaseObject($page);
    }



	protected function setBaseObject($folder ) {

		$this->page = $folder;

		parent::setBaseObject( $folder );
	}


	/**
	 * Alle Daten aus dem Formular speichern
	 */
	function formPost()
	{
		foreach( $this->page->getElements() as $elementid=>$name )
		{
			if   ( $this->hasRequestVar('saveid'.$elementid) )
			{
				$value = new Value();
				$value->objectid   = $this->page->objectid;
				$value->pageid     = Page::getPageIdFromObjectId( $value->objectid );
				$value->element = new Element( $elementid );
				$value->element->load();
				$value->load();

				// Eingegebenen Inhalt aus dem Request lesen
				$inhalt  = $this->getRequestVar( 'id'.$elementid );

				// Den Inhalt speichern.
				switch( $value->element->type )
				{
					case 'number':
						$value->number = $inhalt * pow(10,$value->element->decimals);
						break;

					case 'date':
						$value->date = strtotime( $inhalt );
						break;

					case 'text':
					case 'longtext':
					case 'select':
						$value->text = $inhalt;
						break;

					case 'link':
					case 'list':
					case 'insert':
						$value->linkToObjectId = intval($inhalt);
						break;
				}

				$value->page = &$this->page;

				// Ermitteln, ob Inhalt sofort freigegeben werden kann und soll
				if	( $this->page->hasRight( Acl::ACL_RELEASE ) && $this->hasRequestVar('release') )
					$value->publish = true;
				else
					$value->publish = false;

//				Html::debug($inhalt,'Eingabe');
//				Html::debug($value,'Inhalt');

				// Inhalt speichern.
				// Inhalt in allen Sprachen gleich?
				if	( $value->element->allLanguages )
				{
					// Inhalt fuer jede Sprache einzeln speichern.
					$p = new Project();
					foreach( $p->getLanguageIds() as $languageid )
					{
						$value->languageid = $languageid;
						$value->save();
					}
				}
				else
				{
					// sonst nur 1x speichern (fuer die aktuelle Sprache)
					$value->languageid = $this->getRequestVar(RequestParams::PARAM_LANGUAGE_ID);
					$value->save();
				}
			}
		}
		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		if	( $this->hasRequestVar('publish') )
			$this->callSubAction( 'pubnow' );
		else
			$this->callSubAction( 'el' );
	}


	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function editPost()
	{
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

			$this->setTemplateVar( 'release' ,$this->page->hasRight(Acl::ACL_RELEASE) );
			$this->setTemplateVar( 'publish' ,$this->page->hasRight(Acl::ACL_PUBLISH) );
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
		if	( $value->page->hasRight( Acl::ACL_RELEASE ) && $this->getRequestVar('release')!='' )
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
				$value->save();
			}
		}
		else
		{
			// sonst nur 1x speichern (fuer die aktuelle Sprache)
			$value->save();
		}

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		// Falls ausgewaehlt die Seite sofort veroeffentlichen
		if	( $this->hasRequestVar('publish') )
			$this->callSubAction( 'pubnow' ); // Weiter zum veroeffentlichen
		else
			$this->callSubAction( 'el' ); // Element-Liste anzeigen
	}



	/**
	 * Die Eigenschaften der Seite anzeigen
	 */
	function infoView()
	{
		$this->setTemplateVar('id',$this->page->objectid);

		parent::infoView();
		$this->page->load();

		$this->setTemplateVars( $this->page->getProperties() );

        $alias = $this->page->getAliasForLanguage(null);
        $this->setTemplateVar( 'alias', $alias->full_filename() );

        $languages = $this->page->getProject()->getLanguages();
        $languagesVars = array();

        foreach( $languages as $id => $name )
        {
            $this->page->languageid = $id;
            $this->page->load();

            $languagesVar = $this->page->getProperties();
            $languagesVar['languagename'] = $name;
            $languagesVar['languageid'  ] = $id;
            $alias = $this->page->getAliasForLanguage( $id );
            $languagesVar['alias'       ] = $alias->full_filename();

            $languagesVars[] = $languagesVar;
        }

        $this->setTemplateVar('languages',$languagesVars );

        if   ( $this->userIsProjectAdmin() )
		{
			$this->setTemplateVar('templateid',$this->page->templateid);
		}

		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name );

		$generator = new PageGenerator( $this->createPageContext( Producer::SCHEME_PUBLIC) );

		$this->setTemplateVar('tmp_filename' ,$generator->getPublicFilename() );
	}




	/**
	 * Die Eigenschaften der Seite anzeigen
	 */
	function nameView()
	{
        $this->page->load();

        $this->setTemplateVars( $this->page->getProperties() );
        $this->setTemplateVar( 'languageid', $this->page->languageid );

        $alias = $this->page->getAliasForLanguage( $this->page->languageid );

        $this->setTemplateVar( 'alias_filename', $alias->filename );
        $this->setTemplateVar( 'alias_folderid', $alias->parentid );

        $project = Project::create( $this->page->projectid );
        $this->setTemplateVar( 'folders' , $project->getAllFlatFolders() );
    }




    function namePost() {

	    parent::namePost(); // Save name and description

        $alias = $this->page->getAliasForLanguage( $this->getRequestId('languageid'));

        $alias->filename = BaseObject::urlify( $this->getRequestVar( 'alias_filename') );
        $alias->parentid = $this->getRequestId('alias_folderid');

        // If no alias, remove the alias
        if   ( ! $alias->filename ) {

            $alias->delete();
            $this->addNotice($alias->getType(), 0, '', 'DELETED', 'ok');
        }
        else
        {
            $alias->save();
            $this->addNotice($alias->getType(), 0, $alias->filename, 'SAVED', 'ok');
        }

    }


	/**
	 * Austauschen der Vorlage vorbereiten
	 *
	 * Es wird ein Formualar erzeugt, in dem der Benutzer auswaehlen kann, welche Elemente
	 * in welches Element uebernommen werden sollen
	 */
	public function changetemplateselectelementsView()
	{
		$newTemplateId = $this->getRequestVar( 'newtemplateid' );

		if   ( $newTemplateId != 0  )
		{
			$this->setTemplateVar('newtemplateid',$newTemplateId );

			$oldElements = array();
			$oldTemplate = new Template( $this->page->templateid );
			$newTemplate = new Template( $newTemplateId );

			foreach( $oldTemplate->getElementIds() as $elementid )
			{
				$e = new Element( $elementid );
				$e->load();

				if	( !$e->isWritable() )
					continue;

				$oldElement = array();
				$oldElement['name'] = $e->name.' - '.\cms\base\Language::lang('EL_'.$e->type );
				$oldElement['id'  ] = $e->elementid;

				$newElements = Array();
				$newElements[0] = \cms\base\Language::lang('ELEMENT_DELETE_VALUES');

				foreach( $newTemplate->getElementIds() as $newelementid )
				{
					$ne = new Element( $newelementid );
					$ne->load();

					// Nur neue Elemente anbieten, deren Typ identisch ist
					if	( $ne->type == $e->type )
						$newElements[$newelementid] = \cms\base\Language::lang('ELEMENT').': '.$ne->name.' - '.\cms\base\Language::lang('EL_'.$e->type );
				}
				$oldElement['newElementsName'] = 'from'.$e->elementid;
				$oldElement['newElementsList'] = $newElements;
				$oldElements[$elementid] = $oldElement;
			}
			$this->setTemplateVar('elements',$oldElements );
		}
		else
		{
			$this->callSubAction('prop');
		}
	}



	/**
	 * Die Vorlage der Seite austauschen
	 *
	 * Die Vorlage wird ausgetauscht, die Inhalte werden gemaess der Benutzereingaben kopiert
	 */
	public function changetemplateselectelementsPost()
	{
		$newTemplateId = $this->getRequestVar('newtemplateid');
		$replaceElementMap = Array();

		$oldTemplate = new Template( $this->page->templateid );
		foreach( $oldTemplate->getElementIds() as $elementid )
			$replaceElementMap[$elementid] = $this->getRequestVar('from'.$elementid);

		if	( $newTemplateId != 0  )
		{
			$this->page->replaceTemplate( $newTemplateId,$replaceElementMap );
			$this->addNotice('page', 0, $this->page->name, 'SAVED', Action::NOTICE_OK);
		}
		else
			$this->addNotice('page', 0, $this->page->name, 'NOT_SAVED', Action::NOTICE_WARN);
	}




	/**
	 * Alle Elemente der Seite anzeigen
	 */
	function editView()
	{
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


	/**
	 * Alle editierbaren Felder in einem Formular bereitstellen
	 */
	function formView()
	{
		$list = array();

		foreach( $this->page->values as $id=>$value )
		{
			if   ( $value->element->isWritable() )
			{
				$list[$id] = array();
				$list[$id]['name']        = $value->element->name;
				$list[$id]['desc']        = $value->element->desc;
				$list[$id]['type']        = $value->element->type;
				$list[$id]['id'  ]        = 'id'.$value->element->elementid;
				$list[$id]['saveid']      = 'saveid'.$value->element->elementid;

				switch( $value->element->type )
				{
					case 'text':
					case 'longtext':
						$list[$id]['value'] = $value->text;
						break;

					case 'date':
						$list[$id]['value'] = date( 'Y-m-d H:i:s',$value->date );
						break;

					case 'number':
						$list[$id]['value'] = $value->number / pow(10,$value->element->decimals);
						break;

					case 'select':
						$list[$id]['list' ] = $value->element->getSelectItems();
						$list[$id]['value'] = $value->text;
						break;

					case 'link':
						$objects = array();

						foreach( Folder::getAllObjectIds() as $oid )
						{
							$o = new BaseObject( $oid );
							$o->load();

							if	( $o->getType() != 'folder' )
							{
								$f = new Folder( $o->parentid );
								$f->load();

								$objects[ $oid ]  = \cms\base\Language::lang( $o->getType() ).': ';
								$objects[ $oid ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) );
								$objects[ $oid ] .= ' &raquo; '.$o->name;
							}
						}

						asort( $objects ); // Sortieren

						$list[$id]['list' ] = $objects;
						$list[$id]['value'] = $value->linkToObjectId;
						break;

					case 'list':
						$objects = array();
						foreach( Folder::getAllFolders() as $oid )
						{
							$f = new Folder( $oid );
							$f->load();

							$objects[ $oid ]  = \cms\base\Language::lang( $f->getType() ).': ';
							$objects[ $oid ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) );
						}

						asort( $objects ); // Sortieren

						$this->setTemplateVar('list' ,$objects);
						$this->setTemplateVar('value',$this->value->linkToObjectId);

						break;
				}
			}
		}

		$this->setTemplateVar( 'release',$this->page->hasRight(Acl::ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->page->hasRight(Acl::ACL_PUBLISH) );

		$this->setTemplateVar('el',$list);
	}



	/**
	 * Seite anzeigen
	 */
	public function previewView()
	{
	    $this->setModelAndLanguage();

		$this->setTemplateVar('preview_url',Html::url('page','show',$this->page->objectid,array(RequestParams::PARAM_LANGUAGE_ID=>$this->page->getProject()->getDefaultLanguageId(),RequestParams::PARAM_MODEL_ID=>$this->page->getProject()->getDefaultModelId()) ) );
	}



	/**
	 * Seite anzeigen
	 */
	function showView()
	{
	    // We must overwrite the CSP here.
        // The output is only shown in an iframe, so there is no security impact to the CMS.
        // But if the template is using inline JS or CSS, we would break this with a CSP-header.
		$pageSettingsConfig =  new Config( $this->page->getTotalSettings() );
        header('Content-Security-Policy: '.$pageSettingsConfig->get('content-security-policy','') );

		$this->page->load();

		$project = $this->page->getProject();

		header('Content-Type: '.$this->page->mimeType().'; charset=UTF-8' );

		// HTTP-Header mit Sprachinformation setzen.
		$language = new Language( $this->page->languageid);
		$language->load();
		header('Content-Language: '.$language->isoCode);

		Logger::debug("Preview page: ".$this->page->__toString() );

		$pageContext = $this->createPageContext( Producer::SCHEME_PREVIEW);
		$generator = new PageGenerator( $pageContext );

		$template = new Template( $this->page->templateid );
		$templateModel = $template->loadTemplateModelFor( $pageContext->modelId );
		$templateModel->load();

		// Executing PHP in Pages.
		if	( ( \cms\base\Configuration::config('publish','enable_php_in_page_content')=='auto' && $templateModel->extension == 'php') ||
		        \cms\base\Configuration::config('publish','enable_php_in_page_content')===true )
        {
            ob_start();
            require( $generator->getCache()->load()->getFilename() );
            $this->setTemplateVar('output',ob_get_contents() );
            ob_end_clean();
        }
		else
            $this->setTemplateVar('output',$generator->getCache()->get());
	}



	/**
	 * Den Quellcode der Seite anzeigen
	 *
	 * Alle HTML-Sonderzeichen werden maskiert
	 */
	public function srcView()
	{
		$project = new Project( $this->page->projectid );
		$this->setModelAndLanguage();

		$pageContext = new PageContext( $this->page->objectid,Producer::SCHEME_PUBLIC);
		$pageContext->languageId = $project->getDefaultLanguageId();
		$pageContext->modelId    = $project->getDefaultModelId();

		$generator = new PageGenerator( $pageContext );

		$this->setTemplateVar('src',$generator->getCache()->get() );
	}




	/**
	 * Die Eigenschaften der Seite anzeigen
	 */
	function changetemplateView()
	{
		$this->page->load();


        $this->setTemplateVars( $this->page->getProperties() );

		if   ( $this->userIsAdmin() )
		{
			$this->setTemplateVar('template_url',Html::url('template','show',$this->page->templateid));
		}

		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name);

		$templates = Array();
        $project = new Project( $this->page->projectid );
		foreach( $project->getTemplates() as $id=>$name )
		{
			if	( $id != $this->page->templateid )
				$templates[$id]=$name;
		}
		$this->setTemplateVar('templates',$templates);
	}





	/**
	 * Seite veroeffentlichen
	 *
	 * Es wird ein Formular angzeigt, mit dem die Seite veroeffentlicht
	 * werden kann
	 */
	function pubView()
	{
	}



	/**
	 * Seite veroeffentlichen
	 *
	 * Die Seite wird generiert.
	 */
	function pubPost()
	{
		if	( !$this->page->hasRight( Acl::ACL_PUBLISH ) )
            throw new \util\exception\SecurityException( 'no right for publish' );

		$project = $this->page->getProject();

		// Nothing is written to the session from this point. so we should free the session.
		Session::close();

		$publisher = new Publisher( $project->projectid );

		foreach( $project->getModelIds() as $modelId ) {

			foreach( $project->getLanguageIds() as $languageId ) {

				$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PUBLIC );
				$pageContext->modelId    = $modelId;
				$pageContext->languageId = $languageId;

				$pageGenerator = new PageGenerator( $pageContext );

				$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), $this->page->lastchangeDate ) );
			}
		}

		$publisher->publish();

		$this->addNoticeFor( $this->page,
		                  'PUBLISHED',
		                  array(),
		                  implode("\n",$publisher->getDestinationFilenames() )
        );
	}




    public function removeView()
    {
        $this->setTemplateVar( 'name',$this->page->filename );
    }


    public function removePost()
    {
        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->page->delete();
            $this->addNotice('page', 0, $this->page->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('page', 0, $this->page->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }

    protected function setModelAndLanguage()
    {
        $this->setTemplateVar('languages' ,$this->page->getProject()->getLanguages());
        $this->setTemplateVar('languageid',$this->page->getProject()->getDefaultLanguageId() );

        $this->setTemplateVar('models'    ,$this->page->getProject()->getModels()   );
        $this->setTemplateVar('modelid'   ,$this->page->getProject()->getDefaultModelId() );
    }



    protected function createPageContext( $scheme ) {

		$context = new PageContext( $this->page->objectid,$scheme );
		$context->sourceObjectId = $this->page->objectid;

		if  ( $this->request->hasLanguageId())
			$context->languageId = $this->request->getLanguageId();

		if  ( $this->request->hasModelId())
			$context->modelId = $this->request->getModelId();

        if  ( !$context->languageId )
			$context->languageId = $this->page->getProject()->getDefaultLanguageId();

        if  ( !$context->modelId )
			$context->modelId = $this->page->getProject()->getDefaultModelId();

        return $context;
	}

}
