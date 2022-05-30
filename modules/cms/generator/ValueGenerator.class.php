<?php


namespace cms\generator;


use cms\base\Configuration;
use cms\base\Configuration as C;
use cms\base\DB;
use cms\base\Startup;
use cms\generator\dsl\DslAlert;
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
use dsl\DslParserException;
use dsl\DslRuntimeException;
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


/**
 * Generates a value.
 */
class ValueGenerator extends BaseGenerator
{

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
										case 'inline':
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

										case 'ssi':
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
				elseif	($element->subtype == 'image_data_uri' )
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
					case 'width':
						$f = new Image( $objectid );
						$f->load();
						if	( $f->typeid == BaseObject::TYPE_IMAGE )
						{
							$f->getImageSize();
							$inhalt = $f->width;
						}
						unset($f);
						break;

					case 'height':
						$f = new Image( $objectid );
						$f->load();
						if	( $f->typeid == BaseObject::TYPE_IMAGE )
						{
							$f->getImageSize();
							$inhalt = $f->height;
						}
						unset($f);
						break;

					case 'id':
						$inhalt = $objectid;
						break;

					case 'name':
						$inhalt = $linkedObject->getDefaultName()->getName();
						break;

					case 'description':
						$inhalt = $linkedObject->getDefaultName()->description;
						break;

					case 'create_user_desc':
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

					case 'create_user_fullname':
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

					case 'create_user_mail':
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

					case 'create_user_tel':
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

					case 'create_user_username':
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

					case 'lastch_user_desc':
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

					case 'lastch_user_fullname':
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

					case 'lastch_user_mail':
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

					case 'lastch_user_tel':
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

					case 'lastch_user_username':
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

					case 'mime_type':
						if	( $linkedObject->isFile || $linkedObject->isImage || $linkedObject->isText  )
						{
							$context = new FileContext( $objectid,Producer::SCHEME_PUBLIC );
							$generator = new FileGenerator( $context );
							$inhalt = $generator->getMimeType();
							unset($f);
						}
						break;

					case 'filename':
						$inhalt = $linkedObject->filename();
						break;

					case 'full_filename':
						$inhalt = $linkedObject->full_filename();
						break;

					default:
						$inhalt = '';
						Logger::warn('subtype for linkinfo not implemented:'.$element->subtype);
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
					case 'date_published':
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = Startup::getStartTime();
						break;

					case 'date_saved':
						$date = $linkedObject->lastchangeDate;
						break;

					case 'date_created':
						$date = $linkedObject->createDate;
						break;

					default:
						Logger::warn('element:'.$element->name.', '.
							'type:'.$element->type.', '.
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
			case Element::ELEMENT_TYPE_NUMBER:

				if   ( $value->number == 0 )
				{
					// Zahl ist gleich 0, dann Default-Text
					$inhalt = $element->defaultText;
					break;
				}

				$number = $value->number / pow(10,$element->decimals);
				$inhalt = number_format( $number,$element->decimals,$element->decPoint,$element->thousandSep );

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
					case 'php':
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

					case 'js':
						ob_start();
						$executor = new DslInterpreter();
						$executor->addContext( [
							'console'  => new DslConsole(),
							'document' => new DslDocument(),
							'http'     => new DslHttp(),
							'json'     => new DslJson(),
							'write'    => new DslWrite(),
							'alert'    => new DslAlert(),
							'page'     => new DslPage( $page ),
						]);

						try {
							$executor->runCode( $element->code );
						}
						catch( DslException $e ) {
							if   ( $pageContext->scheme == Producer::SCHEME_PREVIEW )
								echo $e->getMessage();
							Logger::warn( $e );
						}
						$output = ob_get_contents();
						ob_end_clean();

						// Ausgabe ermitteln.
						$inhalt = $output;
						break;
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
					case 'date_published':
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = Startup::getStartTime();
						break;

					case 'date_saved':
						$date = $page->lastchangeDate;
						break;

					case 'date_created':
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
					case 'db_id':
						$inhalt = DB::get()->id;
						break;
					case 'db_name':
						$inhalt = @DB::get()->getLabel();
						break;
					case 'project_id':
						$inhalt = $page->projectid;
						break;
					case 'project_name':
						$inhalt = Project::create( $page->projectid )->load()->name;
						break;
					case 'language_id':
						$inhalt = $pageContext->languageId;
						break;
					case 'language_iso':
						$language = new Language( $pageContext->languageId );
						$language->load();
						$inhalt = $language->isoCode;
						break;
					case 'language_name':
						$language = new Language( $pageContext->languageId );
						$language->load();
						$inhalt = $language->name;
						break;
					case 'page_id':
						$inhalt = $page->objectid;
						break;
					case 'page_name':
						$inhalt = $page->getNameForLanguage( $pageContext->languageId )->name;
						break;
					case 'page_desc':
						$inhalt = $page->getNameForLanguage( $pageContext->languageId )->description;
						break;
					case 'page_fullfilename':
						$inhalt = $this->getPublicFilename();
						break;
					case 'page_filename':
						$inhalt = $page->filename();
						break;
					case 'page_extension':
						$inhalt = '';
						break;
					case 'edit_url':
						$raw = true;
						$inhalt = Html::locationUrl('page',$page->objectid );
						break;
					case 'edit_fullurl':
						$raw = true;
						$inhalt = Http::getServer();

						$inhalt .= Html::locationUrl('page',$page->objectid );
						break;
					case 'lastch_user_username':
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->name;
						break;
					case 'lastch_user_fullname':
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->fullname;
						break;
					case 'lastch_user_mail':
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->mail;
						break;
					case 'lastch_user_desc':
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->desc;
						break;
					case 'lastch_user_tel':
						$user = $page->lastchangeUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->tel;
						break;

					case 'create_user_username':
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->name;
						break;
					case 'create_user_fullname':
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->fullname;
						break;
					case 'create_user_mail':
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->mail;
						break;
					case 'create_user_desc':
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->desc;
						break;
					case 'create_user_tel':
						$user = $page->createUser;
						if   ( $user->userid )
							$user->load();
						$inhalt = $user->tel;
						break;

					case 'act_user_username':
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->name;
						break;
					case 'act_user_fullname':
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->fullname;
						break;
					case 'act_user_mail':
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->mail;
						break;
					case 'act_user_desc':
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->desc;
						break;
					case 'act_user_tel':
						$user = Request::getUser();
						if   ( $user )
							$inhalt = $user->tel;
						break;
					default:
						Logger::warn('element:'.$element->name.', '.
							'type:'.$element->type.', '.
							'unknown subtype:'.$element->subtype);
					// Keine Fehlermeldung in erzeugte Seite schreiben.
				}

				break;

			default:
				// this should never happen in production.
				// inform the user.
				throw new GeneratorException( 'Error in element '.$element->name.': '.
					'unknown type: '.$element->typeid.'');

		}


		switch( $element->type )
		{
			case 'longtext':
			case 'text':
			case 'select':

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

}