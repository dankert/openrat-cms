<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use cms\model\Value;

class PageFormAction extends PageAction implements Method {


    public function view() {
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


    public function post() {
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
						$value->add();
					}
				}
				else
				{
					// sonst nur 1x speichern (fuer die aktuelle Sprache)
					$value->languageid = $this->getRequestVar(RequestParams::PARAM_LANGUAGE_ID);
					$value->add();
				}
			}
		}
		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		if	( $this->hasRequestVar('publish') )
			$this->callSubAction( 'pubnow' );
		else
			$this->callSubAction( 'el' );
    }
}
