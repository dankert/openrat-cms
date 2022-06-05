<?php


namespace cms\generator;


use cms\base\Configuration;
use cms\base\Configuration as C;
use cms\base\DB;
use cms\base\Startup;
use cms\generator\dsl\DslConsole;
use cms\generator\dsl\DslDocument;
use cms\generator\dsl\DslHttp;
use cms\generator\dsl\DslJson;
use cms\generator\dsl\DslPage;
use cms\generator\dsl\DslWrite;
use cms\macros\MacroRunner;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\File;
use cms\model\Folder;
use cms\model\Image;
use cms\model\Language;
use cms\model\Link;
use cms\model\Page;
use cms\model\PageContent;
use cms\model\Project;
use cms\model\Template;
use cms\model\Value;
use dsl\DslException;
use dsl\executor\DslInterpreter;
use logger\Logger;
use LogicException;
use util\Code;
use util\exception\GeneratorException;
use util\exception\ObjectNotFoundException;
use util\exception\PublisherException;
use util\Html;
use util\Http;
use util\Request;
use util\Text;
use util\Transformer;
use util\YAML;


/**
 * Generates a value.
 */
class ValueGenerator extends BaseGenerator
{

	const CODE_PHP = 'php';
	const CODE_SCRIPT = 'js';
	const CODE_MUSTACHE  = 'mustache';

	const INFO_DB_ID   = 'db_id';
	const INFO_DB_NAME = 'db_name';
	const INFO_PROJECT_ID = 'project_id';
	const INFO_PROJECT_NAME = 'project_name';
	const INFO_LANGUAGE_ID = 'language_id';
	const INFO_LANGUAGE_ISO = 'language_iso';
	const INFO_LANGUAGE_NAME = 'language_name';
	const INFO_PAGE_ID = 'page_id';
	const INFO_PAGE_NAME = 'page_name';
	const INFO_PAGE_DESC = 'page_desc';
	const INFO_PAGE_FULLFILENAME = 'page_fullfilename';
	const INFO_PAGE_FILENAME = 'page_filename';
	const INFO_PAGE_EXTENSION = 'page_extension';
	const INFO_EDIT_URL = 'edit_url';
	const INFO_EDIT_FULLURL = 'edit_fullurl';
	const INFO_LASTCHANGE_USER_USERNAME = 'lastch_user_username';
	const INFO_LASTCHANGE_USER_FULLNAME = 'lastch_user_fullname';
	const INFO_LASTCHANGE_USER_MAIL = 'lastch_user_mail';
	const INFO_LASTCHANGE_USER_DESC = 'lastch_user_desc';
	const INFO_LASTCHANGE_USER_TEL = 'lastch_user_tel';
	const INFO_CREATION_USER_USERNAME = 'create_user_username';
	const INFO_CREATION_FULLNAME = 'create_user_fullname';
	const INFO_CREATION_MAIL = 'create_user_mail';
	const INFO_CREATION_DESC = 'create_user_desc';
	const INFO_CREATION_TEL = 'create_user_tel';
	const INFO_ACT_USERNAME = 'act_user_username';
	const INFO_ACT_FULLNAME = 'act_user_fullname';
	const INFO_ACT_MAIL = 'act_user_mail';
	const INFO_ACT_DESC = 'act_user_desc';
	const INFO_ACT_TEL = 'act_user_tel';
	const INFO_PUB_USERNAME = 'pub_user_username';
	const INFO_PUB_FULLNAME = 'pub_user_fullname';
	const INFO_PUB_MAIL = 'pub_user_mail';
	const INFO_PUB_DESC = 'pub_user_desc';
	const INFO_PUB_TEL = 'pub_user_tel';
	const INFO_FILENAME = 'filename';
	const INFO_FULL_FILENAME = 'full_filename';

	const COORD_OLC = 'olc';
	const COORD_COORDINATES = 'coordinates';

	const INFO_DATE_PUBLISHED = 'date_published';
	const INFO_DATE_SAVED = 'date_saved';
	const INFO_DATE_CREATED = 'date_created';

	const INSERT_SSI = 'ssi';
	const INSERT_INLINE = 'inline';


	const LINK_FILE_ = 'file';
	const LINK_IMAGE = 'image';
	const LINK_IMAGE_DATE_URI = 'image_data_uri';
	const LINK_PAGE = 'page';
	const LINK_FOLDER = 'folder';
	const LINK_LINK = 'link';

	const LINKINFO_WIDTH = 'width';
	const LINKINFO_HEIGHT = 'height';
	const LINKINFO_ID = 'id';
	const LINKINFO_NAME = 'name';
	const LINKINFO_DESCRIPTION = 'description';
	const LINKINFO_MIME_TYPE = 'mime_type';


	/**
	 * Constructor.
	 *
	 * @param $valueContext ValueContext
	 */
	public function __construct($valueContext )
	{
		$this->context = $valueContext;
	}



	protected function generate()
	{
		return $this->generateValue();
	}




	/**
	 * Generating a page value.
	 *
	 * @return string
	 */
	private function generateValue()
	{
		$pageContext = $this->context->pageContext;
		$page = new Page( $pageContext->objectId );
		$page->load();

		$element = new Element( $this->context->elementid );
		$element->load();

		$pageContent = new PageContent();

		$pageContent->pageId     = $page->pageid;
		$pageContent->elementId  = $this->context->elementid;
		$pageContent->languageid = $pageContext->languageId;
		$pageContent->load();

		$value = new Value();
		$value->contentid = $pageContent->contentId;

		if   ( $this->context->scheme == Producer::SCHEME_PREVIEW )
			$value->load();
		else
			$value->loadPublished();

		if	( ! $this->isValueHasContent( $value,$element ) )
		{
			$pageForDefaultValue = $page->getPageAsDefault();

			if   ( $pageForDefaultValue ) {

				$pageContext = clone $this->context->pageContext;
				$pageContext->objectId = $pageForDefaultValue->objectid;

				$valueContext = clone $this->context;
				$valueContext->pageContext = $pageContext;

				$generator = new ValueGenerator( $valueContext );

				return $generator->getCache()->get();
			}
		}

		$inhalt = '';

		switch( $element->typeid )
		{
			case Element::ELEMENT_TYPE_INSERT:

				$objectid = $value->linkToObjectId;

				if   ( intval($objectid) == 0 )
					$objectid = $element->defaultObjectId;

				if	( ! BaseObject::available( $objectid) )
					return;

				$object = new BaseObject( $objectid );
				$object->objectLoadRaw();

				if	( $object->isFolder )
				{
					if   ( false&&$value->publisher->isSimplePreview() ) // FIXME
					{
						$f = new Folder( $objectid );
						$f->load();
						$inhalt = $f->filename;
						unset( $f );
					}
					else
					{
						if	( $objectid != $page->objectid ) // Rekursion vermeiden
						{
							$f = new Folder( $objectid );
							foreach( $f->getObjectIds() as $oid )
							{
								if	( $oid != $page->objectid )  // Rekursion vermeiden
								{
									switch( $element->subtype )
									{
										case '':
										case self::INSERT_INLINE:
											$o = new BaseObject( $oid );
											$o->load();
											switch( $o->typeid )
											{
												case BaseObject::TYPEID_PAGE:
													$newPageContext = clone $pageContext;
													$newPageContext->objectId = $oid;
													$pageGenerator = new PageGenerator( $newPageContext );

													$inhalt = $pageGenerator->getCache()->get();
													//$inhalt = $oid;

													break;
												case BaseObject::TYPEID_LINK:
													$l = new Link( $oid );
													$l->load();
													$op = new BaseObject( $l->linkedObjectId );
													$op->load();
													if	( $op->isPage )
													{
														$newPageContext = clone $pageContext;
														$newPageContext->objectId = $l->linkedObjectId;
														$pageGenerator = new PageGenerator( $newPageContext );

														$inhalt .= $pageGenerator->getCache()->get();
													}
													break;
											}
											break;

										case self::INSERT_SSI:
											$linkScheme = $pageContext->getLinkScheme();
											$inhalt .= '<!--#include virtual="'.$linkScheme->linkToObject( $page,new BaseObject($oid)).'" -->';
											break;

										default:
											$inhalt = '?'.$element->subtype.'?';
									}
								}
								else throw new \LogicException('FATAL: recursion detected');
							}
						}
						else throw new LogicException('FATAL: recursion detected');
					}
				}
				elseif	( $object->isPage )
				{
					if   ( false&&$value->publisher->isSimplePreview() )
					{
						$p = new Page( $objectid );
						$p->load();
						$inhalt = $p->filename;
						unset( $p );
					}
					else
					{
						if	( $objectid != $page->objectid ) // Rekursion vermeiden
						{
							switch( $element->subtype )
							{
								case '':
								case 'inline':
									$newPageContext = clone $pageContext;
									$newPageContext->objectId = $objectid;
									$pageGenerator = new PageGenerator( $newPageContext );

									$inhalt = $pageGenerator->getCache()->get();
									unset( $p );
									break;

								case 'ssi':
									$linkScheme = $pageContext->getLinkScheme();
									$inhalt = '<!--#include virtual="'.$linkScheme->linkToObject( $page,new BaseObject($objectid)).'" -->';
									break;

								default:
									$inhalt = '?'.$element->subtype.'?';
									break;
							}
						}
						else throw new LogicException('FATAL: recursion detected');
					}
				}

				if	( false&& $value->publisher->isSimplePreview() )
				{
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}

				break;


			case Element::ELEMENT_TYPE_LINK:

				$objectid = $value->linkToObjectId;
				if   ( intval($objectid) == 0 )
					$objectid = $element->defaultObjectId;

				if   ( $objectid==0 )
				{
					// Link noch nicht gefuellt
					$inhalt = '';
				}
				elseif	 ( ! BaseObject::available($objectid) )
				{
					$inhalt = /*$value->publisher->isSimplePreview()?'-':*/'';
				}
				elseif   ( /*$value->publisher->isSimplePreview()*/false )
				{
					$o = new BaseObject( $objectid );
					$o->load();
					$inhalt = $o->filename;
				}
				elseif	($element->subtype == self::LINK_IMAGE_DATE_URI )
				{
					$context = new FileContext( $objectid,Producer::SCHEME_PUBLIC );
					$generator = new FileGenerator( $context );
					$file = new File($objectid);
					$file->load();
					$inhalt = 'data:'.$generator->getMimeType().';base64,'.base64_encode($generator->getCache()->get());
				}
				else
				{
					$sourcePage = new Page( $pageContext->sourceObjectId ); // the source page
					$target     = new BaseObject( $objectid );
					$target->load();

					$linkScheme = $pageContext->getLinkScheme();
					$inhalt     = $linkScheme->linkToObject( $sourcePage, $target );
				}

				break;


			case Element::ELEMENT_TYPE_COPY:

				list($linkElementName,$targetElementName) = explode('%',$element->name.'%');

				if	( empty($targetElementName) )
					break;

				// TODO: missing element-id
				$element = new Element();
				$element->name = $linkElementName;
				$element->load();

				if	( intval($element->elementid)==0 )
					break;

				// TODO: does not work
				$linkValue = new Value();
				$linkValue->load();

				if	( !BaseObject::available( $linkValue->linkToObjectId ) )
					break;

				$linkedPage = new Page( $linkValue->linkToObjectId );
				$linkedPage->load();

				$linkedPageTemplate = new Template( $linkedPage->templateid );
				$targetElementId = array_search( $targetElementName, $linkedPageTemplate->getElementNames() );

				if	( intval($targetElementId)==0 )
					break;

				$valueContext = new ValueContext( $pageContext );
				$valueContext->elementid = $targetElementId;

				$value = new ValueGenerator($valueContext);
				$inhalt = $value->getCache()->get();

				break;


			case Element::ELEMENT_TYPE_LINKINFO:

				@list( $linkElementName, $name ) = explode('%',$element->name);
				if	( is_null($name) )
					break;

				$template = new Template( $page->templateid );
				$elementId = array_search( $linkElementName, $template->getElementNames() );


				$element = new Element($elementId);
				$element->load();

				$pageContent = new PageContent();
				$pageContent->pageId     = $page->pageid;
				$pageContent->languageid = $pageContext->languageId;
				$pageContent->elementId  = $elementId;
				$pageContent->load();

				$linkValue = new Value();
				$linkValue->contentid = $pageContent->contentId;
				$linkValue->load();

				$objectid = $linkValue->linkToObjectId;

				if   ( intval($objectid) == 0 )
					$objectid = $element->defaultObjectId;

				if	( !BaseObject::available( $objectid ) )
					break;

				$linkedObject = new BaseObject( $objectid );
				$linkedObject->load();

				switch( $element->subtype )
				{
					case self::LINKINFO_WIDTH:
						$f = new Image( $objectid );
						$f->load();
						if	( $f->typeid == BaseObject::TYPEID_IMAGE )
						{
							$f->getImageSize();
							$inhalt = $f->width;
						}
						unset($f);
						break;

					case self::LINKINFO_HEIGHT:
						$f = new Image( $objectid );
						$f->load();
						if	( $f->typeid == BaseObject::TYPEID_IMAGE )
						{
							$f->getImageSize();
							$inhalt = $f->height;
						}
						unset($f);
						break;

					case self::LINKINFO_ID:
						$inhalt = $objectid;
						break;

					case self::LINKINFO_NAME:
						$inhalt = $linkedObject->getDefaultName()->getName();
						break;

					case self::LINKINFO_DESCRIPTION:
						$inhalt = $linkedObject->getDefaultName()->description;
						break;

					case self::INFO_CREATION_DESC:
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->desc;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_CREATION_FULLNAME:
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->fullname;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_CREATION_MAIL:
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->mail;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_CREATION_TEL:
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->tel;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_CREATION_USER_USERNAME:
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->name;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_LASTCHANGE_USER_DESC:
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->desc;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_LASTCHANGE_USER_FULLNAME:
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->fullname;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_LASTCHANGE_USER_MAIL:
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->mail;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::INFO_LASTCHANGE_USER_TEL:
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->tel;
						}
						catch( ObjectNotFoundException $e )
						{
						}

						break;

					case self::INFO_LASTCHANGE_USER_USERNAME:
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->name;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;

					case self::LINKINFO_MIME_TYPE:
						if	( $linkedObject->isFile || $linkedObject->isImage || $linkedObject->isText  )
						{
							$context = new FileContext( $objectid,Producer::SCHEME_PUBLIC );
							$generator = new FileGenerator( $context );
							$inhalt = $generator->getMimeType();
							unset($f);
						}
						break;

					case self::INFO_FILENAME:
						$inhalt = $linkedObject->filename();
						break;

					case self::INFO_FULL_FILENAME:
						$inhalt = $linkedObject->full_filename();
						break;

					default:
						$inhalt = '';
						Logger::error('Subtype for linkinfo not implemented:'.$element->subtype); // should not happen
				}

				break;

			case Element::ELEMENT_TYPE_LINKDATE:

				@list( $linkElementName, $name ) = explode('%',$element->name);
				if	( is_null($name) )
					break;

				$template = new Template( $page->templateid );
				$elementId = array_search( $linkElementName, $template->getElementNames() );

				$element = new Element($elementId);
				$element->load();

				$pageContent = new PageContent();
				$pageContent->pageId     = $page->pageid;
				$pageContent->languageid = $pageContext->languageId;
				$pageContent->elementId  = $elementId;
				$pageContent->load();

				$linkValue = new Value();
				$linkValue->contentid = $pageContent->contentId;
				$linkValue->load();

				$objectid = $linkValue->linkToObjectId;

				if   ( intval($objectid) == 0 )
					$objectid = $element->defaultObjectId;

				if	( !BaseObject::available( $objectid ) )
					break;

				$linkedObject = new BaseObject( $objectid );
				$linkedObject->load();


				switch( $element->subtype )
				{
					case self::INFO_DATE_PUBLISHED:
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = Startup::getStartTime();
						break;

					case self::INFO_DATE_SAVED:
						$date = $linkedObject->lastchangeDate;
						break;

					case self::INFO_DATE_CREATED:
						$date = $linkedObject->createDate;
						break;

					default:
						Logger::warn('element:'.$element->name.', '.
							'type:'.$element->typeid.', '.
							'unknown subtype:'.$element->subtype);
						$date = Startup::getStartTime();
				}

				if	( strpos($element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $element->dateformat,$date );
				else
					$inhalt = date    ( $element->dateformat,$date );
				break;

			case Element::ELEMENT_TYPE_LONGTEXT:
			case Element::ELEMENT_TYPE_TEXT:
			case Element::ELEMENT_TYPE_SELECT:

				$inhalt = $value->text;
				$format = $value->format;

				// Wenn Inhalt leer, dann versuchen, den Inhalt der Default-Sprache zu laden.
				if   ( $inhalt == '' && Configuration::subset(['content','language'])->is('use_default_language',true) )
				{
					$project = new Project($page->projectid);

					$otherPageContent = new PageContent();
					$otherPageContent->elementId  = $pageContent->elementId;
					$otherPageContent->pageId     = $pageContent->pageId;
					$otherPageContent->languageid = $project->getDefaultLanguageId();
					$otherPageContent->load();

					if   ( $otherPageContent->isPersistent() ) {
						$otherValue = new Value();
						$otherValue->contentid = $pageContent->contentId;
						$otherValue->load();
						$inhalt = $otherValue->text;
					}
				}

				// Wenn Inhalt leer, dann Vorbelegung verwenden
				if   ( $inhalt == '' )  {

					$inhalt = $element->defaultText;
					$format = $element->format;
				}

				// Wenn HTML nicht erlaubt und Wiki-Formatierung aktiv, dann einfache HTML-Tags in Wiki umwandeln
				$pageIsHtml = $this->isHtml( (new PageGenerator( $this->context->pageContext ))->getMimeType());

				//
				switch( $format )
				{
					case Element::ELEMENT_FORMAT_TEXT:
					case Element::ELEMENT_FORMAT_HTML:

						if   ( !$element->html )
						{
							// HTML not allowed.
							$inhalt = Text::encodeHtml( $inhalt );
							$inhalt = Text::encodeHtmlSpecialChars( $inhalt );
						}

						break;

					case Element::ELEMENT_FORMAT_WIKI:

						$wikiConfig = C::subset('editor')->subset('wiki');

						if   ( $wikiConfig->is('convert_bbcode',false ) )
							$inhalt = Text::bbCode2Wiki( $inhalt );

						if   ( !$element->html && $wikiConfig->is('convert_html',true) && $pageIsHtml)
							$inhalt = Text::html2Wiki( $inhalt );

						$transformer = new Transformer();
						$transformer->text    = $inhalt;
						$transformer->page    = $page;
						$transformer->pageContext = $pageContext;
						$transformer->element = $element;

						$transformer->transform();
						$inhalt = $transformer->text;
						break;

					case Element::ELEMENT_FORMAT_MARKDOWN:

						$mdConfig = C::Conf()->subset('editor')->subset('markdown');

						$parser = new \util\Parsedown();
						$parser->setUrlsLinked( $mdConfig->is('urls-linked',true));
						$parser->setMarkupEscaped( !$element->html );

						$inhalt = $parser->parse( $inhalt );
						break;

					default:
						throw new \LogicException('Unknown format: '.$value->format );
				}

				/*if   ( $value->publisher->isSimplePreview() )
				{
					// Simple Preview with bare text.
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}*/

				// "__OID__nnn__" ersetzen durch einen richtigen Link
				foreach( Text::parseOID($inhalt) as $oid=>$t )
				{
					$linkFormat = $pageContext->getLinkScheme();
					$target = new BaseObject($oid);
					$target->load();

					$sourcePage = new Page( $pageContext->sourceObjectId );
					$url        = $linkFormat->linkToObject($sourcePage,$target);

					foreach( $t as $match )
						$inhalt = str_replace($match,$url,$inhalt);
				}

				break;


			// Zahl
			//
			// wird im entsprechenden Format angezeigt.
			case Element::ELEMENT_TYPE_CHECKBOX:

				$inhalt = boolval($value->number);
				break;

			case Element::ELEMENT_TYPE_NUMBER:


				if   ( $value->number == 0 )
				{
					// Zahl ist gleich 0, dann Default-Text
					$inhalt = $element->defaultText;
					break;
				}

				$number = $value->number / pow(10,$element->decimals);
				$inhalt = number_format( $number,$element->decimals,$element->decPoint,$element->thousandSep );


				$inhalt = $this->filterValue( $inhalt, $element->code );


				break;


			// Datum
			case Element::ELEMENT_TYPE_DATE:

				$date = $value->date;

				if   ( intval($date) == 0 )
				{
					// Datum wurde noch nicht eingegeben
					$inhalt = $element->defaultText;
					break;
				}

				// Datum gemaess Elementeinstellung formatieren
				if	( strpos($element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $element->dateformat,$date );
				else
					$inhalt = date    ( $element->dateformat,$date );
				break;


			// Programmcode (PHP)
			case Element::ELEMENT_TYPE_CODE:

				switch( $element->subtype ) {
					case self::CODE_PHP:
						// Die Ausführung von benutzer-erzeugtem PHP-Code kann in der
						// Konfiguration aus Sicherheitsgründen deaktiviert sein.
						if	( Configuration::subset('security')->is('disable_dynamic_code',false) )
						{
							Logger::warn("Execution of dynamic code elements is disabled by configuration. Set security/disable_dynamic_code to true to allow this");
							break;
						}

						$page->load();

						// Das Ausführen geschieht über die Klasse "Code".
						// In dieser wird der Code in eine Datei geschrieben und
						// von dort eingebunden.
						$code = new Code();
						$code->setPageContext($this->context->pageContext );
						$code->code = $element->code;

						ob_start();

						// Jetzt ausfuehren des temporaeren PHP-Codes
						$code->execute();

						$output = ob_get_contents();
						ob_end_clean();

						// Ausgabe ermitteln.
						$inhalt = $output;
						break;

					case self::CODE_SCRIPT:
						$executor = new DslInterpreter();
						$executor->addContext( [
							'console'  => new DslConsole(),
							'http'     => new DslHttp(),
							'json'     => new DslJson(),
							'page'     => new DslPage( $page ),
						]);

						try {
							$executor->runCode( $element->code );
						}
						catch( DslException $e ) {
							Logger::warn( $e );
							if   ( $pageContext->scheme == Producer::SCHEME_PREVIEW )
								$inhalt = $e->getMessage();
							break;
						}

						// Ausgabe ermitteln.
						$inhalt = $executor->getOutput();

						break;
					case self::CODE_MUSTACHE:
						// TODO
					default:
				}


				break;


			// Makros (dynamische Klassen)
			case Element::ELEMENT_TYPE_DYNAMIC:

				/*if   ( $value->publisher->isSimplePreview() )
					break;*/

				$page->load();
				$macroName     = $element->subtype;
				$macroSettings = $element->getDynamicParameters();

				$runner = new MacroRunner();
				try {
					$inhalt .= $runner->executeMacro( $macroName, $macroSettings,$page, $pageContext );
				}
				catch( \Exception $e ) {
					throw new GeneratorException("Macro ".$macroName.' in value '.$value->__toString().' could not executed',$e);
				}

				// Wenn HTML-Ausgabe, dann Sonderzeichen in HTML �bersetzen
				if   ( $this->isHtml( (new PageGenerator( $this->context->pageContext ))->getMimeType()))
					$inhalt = Text::encodeHtmlSpecialChars( $inhalt );

				break;


			// Info-Feld als Datum
			case Element::ELEMENT_TYPE_INFODATE:

				/*if   ( $value->publisher->isSimplePreview() )
					break;*/

				switch( $element->subtype )
				{
					case self::INFO_DATE_PUBLISHED:
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = Startup::getStartTime();
						break;

					case self::INFO_DATE_SAVED:
						$date = $page->lastchangeDate;
						break;

					case self::INFO_DATE_CREATED:
						$date = $page->createDate;
						break;

					default:
						throw new PublisherException('element:'.$element->name.', '.
							'type:'.$element->type.', '.
							'unknown subtype:'.$element->subtype);
						/*if	( !$value->publisher->isPublic() )
							$inhalt = \cms\base\Language::lang('ERROR_IN_ELEMENT');*/
				}

				if	( strpos($element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $element->dateformat,$date );
				else
					$inhalt = date    ( $element->dateformat,$date );

				break;


			// Info-Feld
			case Element::ELEMENT_TYPE_INFO:

				/*if   ( $value->publisher->isSimplePreview() )
					break;*/

				switch( $element->subtype )
				{
					case self::INFO_DB_ID:
						$inhalt = DB::get()->id;
						break;
					case self::INFO_DB_NAME:
						$inhalt = @DB::get()->getLabel();
						break;
					case self::INFO_PROJECT_ID:
						$inhalt = $page->projectid;
						break;
					case self::INFO_PROJECT_NAME:
						$inhalt = Project::create( $page->projectid )->load()->name;
						break;
					case self::INFO_LANGUAGE_ID:
						$inhalt = $pageContext->languageId;
						break;
					case self::INFO_LANGUAGE_ISO:
						$language = new Language( $pageContext->languageId );
						$language->load();
						$inhalt = $language->isoCode;
						break;
					case self::INFO_LANGUAGE_NAME:
						$language = new Language( $pageContext->languageId );
						$language->load();
						$inhalt = $language->name;
						break;
					case self::INFO_PAGE_ID:
						$inhalt = $page->objectid;
						break;
					case self::INFO_PAGE_NAME:
						$inhalt = $page->getNameForLanguage( $pageContext->languageId )->name;
						break;
					case self::INFO_PAGE_DESC:
						$inhalt = $page->getNameForLanguage( $pageContext->languageId )->description;
						break;
					case self::INFO_PAGE_FULLFILENAME:
						$inhalt = $this->getPublicFilename();
						break;
					case self::INFO_PAGE_FILENAME:
						$inhalt = $page->filename();
						break;
					case self::INFO_PAGE_EXTENSION:
						$inhalt = '';
						break;
					case self::INFO_EDIT_URL:
						$raw = true;
						$inhalt = Html::locationUrl('page',$page->objectid );
						break;
					case self::INFO_EDIT_FULLURL:
						$raw = true;
						$inhalt = Http::getServer();

						$inhalt .= Html::locationUrl('page',$page->objectid );
						break;
					case self::INFO_LASTCHANGE_USER_USERNAME:
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->name;
						break;
					case self::INFO_LASTCHANGE_USER_FULLNAME:
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->fullname;
						break;
					case self::INFO_LASTCHANGE_USER_MAIL:
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->mail;
						break;
					case self::INFO_LASTCHANGE_USER_DESC:
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->desc;
						break;
					case self::INFO_LASTCHANGE_USER_TEL:
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->tel;
						break;

					case self::INFO_CREATION_USER_USERNAME:
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->name;
						break;
					case self::INFO_CREATION_FULLNAME:
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->fullname;
						break;
					case self::INFO_CREATION_MAIL:
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->mail;
						break;
					case self::INFO_CREATION_DESC:
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->desc;
						break;
					case self::INFO_CREATION_TEL:
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->tel;
						break;

					case self::INFO_ACT_USERNAME:
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->name;
						break;
					case self::INFO_ACT_FULLNAME:
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->fullname;
						break;
					case self::INFO_ACT_MAIL:
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->mail;
						break;
					case self::INFO_ACT_DESC:
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->desc;
						break;
					case self::INFO_ACT_TEL:
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->tel;
						break;
					default:
						Logger::warn('element:'.$element->name.', '.
							'type:'.$element->getTypeName().', '.
							'unknown subtype:'.$element->subtype);
					// Keine Fehlermeldung in erzeugte Seite schreiben.
				}

				break;

			case Element::ELEMENT_TYPE_COORD:
				$inhalt = $value->text;
				break;

			case Element::ELEMENT_TYPE_DATA:

				try {
					$data = YAML::parse( $value->text );
				} catch ( \Exception $e ) {
					if   ( $this->context->pageContext->scheme == Producer::SCHEME_PREVIEW )
						$inhalt = 'Invalid YAML: '.$e->getMessage();
					break;
				}

				$inhalt = $this->filterValue( $data, $element->code );

				if   ( is_array($inhalt) )
					$inhalt = YAML::dump( $inhalt );

				break;
			default:
				// this should never happen in production.
				// inform the user.
				throw new GeneratorException( 'Error in element '.$element->name.': '.
					'unknown type: '.$element->typeid.'');

		}


		switch( $element->typeid )
		{
			case Element::ELEMENT_TYPE_LONGTEXT:
			case Element::ELEMENT_TYPE_TEXT:
			case Element::ELEMENT_TYPE_SELECT:

				if	( Configuration::subset('publish')->is('encode_utf8_in_html') )
					// Wenn HTML-Ausgabe, dann UTF-8-Zeichen als HTML-Code uebersetzen
					if   ( $this->isHtml( (new PageGenerator( $this->context->pageContext ))->getMimeType()) )
						$inhalt = Text::translateutf8tohtml($inhalt);
				break;

			default:
		}



		if   ( $this->context->pageContext->scheme == Producer::SCHEME_PREVIEW && $element->withIcon && $this->isHtml( (new PageGenerator( $this->context->pageContext ))->getMimeType()) )
		{
			// Anklickbaren Link voranstellen.
			$iconLink = '<a href="javascript:parent.Openrat.Workbench.openNewAction(\''.$element->name.'\',\'pageelement\',\''.$page->objectid.'_'.$element->elementid.'\');" title="'.$element->desc.'">&rarr;<i class="or-image-icon or-image-icon--el-'.$element->getTypeName().'"></i></a>';
			$inhalt   = $iconLink.$inhalt;
		}

		return $inhalt;
	}


	/**
	 * Determines if the value has meaningful content
	 *
	 * @param $value Value
	 */
	protected function isValueHasContent( $value,$element ) {

		return in_array($element->typeid,[
				Element::ELEMENT_TYPE_TEXT,
				Element::ELEMENT_TYPE_LONGTEXT,
				Element::ELEMENT_TYPE_SELECT,
				Element::ELEMENT_TYPE_DATA,
				Element::ELEMENT_TYPE_COORD,
			]) && $value->text != '' && $value->text != null ||
			in_array($element->typeid,[
				Element::ELEMENT_TYPE_NUMBER
			]) && $value->number != null ||
			in_array($element->typeid,[
				Element::ELEMENT_TYPE_LINK,
				Element::ELEMENT_TYPE_INSERT,
			]) && $value->linkToObjectId != null && $value->linkToObjectId != 0 ||
			in_array($element->typeid,[
				Element::ELEMENT_TYPE_DATE,
			]) && $value->date != null && $value->date != 0 ||
			in_array($element->typeid,[
				Element::ELEMENT_TYPE_CODE,
				Element::ELEMENT_TYPE_COPY,
				Element::ELEMENT_TYPE_DYNAMIC,
				Element::ELEMENT_TYPE_INFO,
				Element::ELEMENT_TYPE_INFODATE,
				Element::ELEMENT_TYPE_LINKDATE,
				Element::ELEMENT_TYPE_LINKINFO,
			]);
	}


	/**
	 * A pure value does not have a public filename. Therefor, this method returns nothing.
	 * @return string
	 */
	public function getPublicFilename()
	{
		return null;
	}


	/**
	 * @return string always blank
	 */
	public function getMimeType()
	{
		return ''; // Values does not have a mime type.
	}


	protected function isHtml( $mimeType )
	{
		return $mimeType == 'text/html';
	}

	/**
	 * @param $inhalt mixed
	 * @param $code string
	 * @return mixed|string
	 */
	protected function filterValue( $inhalt, $code)
	{
		$executor = new DslInterpreter();

		$executor->addContext( [
			'console'  => new DslConsole(),
			'value'    => $inhalt,
			'http'     => new DslHttp(),
			'json'     => new DslJson(),
		]);

		try {
			$result = $executor->runCode( $code );
		}
		catch( DslException $e ) {
			Logger::warn($e);
			if   ( $this->context->pageContext->scheme == Producer::SCHEME_PREVIEW )
				return $e->getMessage();
			else
				return '';
		}

		if   ( $result != null )
			return $result;
		else
			return $inhalt;
	}

}