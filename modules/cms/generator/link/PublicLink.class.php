<?php

namespace cms\generator\link;

use cms\base\Configuration;
use cms\generator\PageContext;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\TemplateModel;
use cms\model\Url;
use cms\generator\target\Dav;
use cms\generator\target\Fax;
use cms\generator\target\Ftp;
use cms\generator\target\Ftps;
use cms\generator\target\Local;
use cms\generator\target\NoBaseTarget;
use cms\generator\target\Scp;
use cms\generator\target\SFtp;
use cms\generator\target\BaseTarget;
use util\exception\PublisherException;
use util\FileUtils;
use logger\Logger;
use util\exception\UIException;
use util\Session;



/**
 * @author Jan Dankert
 */

class PublicLink implements LinkFormat
{
    const SCHEMA_ABSOLUTE = 1;
    const SCHEMA_RELATIVE = 2;

	const MAX_RECURSIVE_COUNT = 10;

	/**
	 * @var PageContext
	 */
	private $pageContext;

	/**
	 * PublicLink constructor.
	 * @param $pageContext PageContext
	 */
	public function __construct($pageContext)
	{
		$this->pageContext = $pageContext;
	}


	/**
     * @param $from \cms\model\BaseObject
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( BaseObject $from, BaseObject $to ) {

    	$publishConfig = Configuration::subset('publish');

		$from->load();
    	$fromProject = $from->getProject()->load();

        $schema = $fromProject->linkAbsolute?self::SCHEMA_ABSOLUTE:self::SCHEMA_RELATIVE;

		$counter = 0;
        while( $to->typeid == BaseObject::TYPEID_LINK )
		{
			if   ( $counter++ > self::MAX_RECURSIVE_COUNT)
				throw new \LogicException("Too much redirects while following a link. Stopped at #".$to->objectid );

			$link = new Link( $to->objectid );
			$link->load();

			$to = new BaseObject( $link->linkedObjectId );
			$to->objectLoad();
		}

        switch( $to->typeid ) {
			case BaseObject::TYPEID_FILE:
			case BaseObject::TYPEID_IMAGE:
			case BaseObject::TYPEID_TEXT:

				$f = new File($to->objectid);

				$f->load();
				$filename = $f->filename();

				if   ( $fromProject->publishFileExtension && ! $fromProject->content_negotiation )
					// Add file extension
					$filename .= '.'.$f->extension;

				break;

			case BaseObject::TYPEID_PAGE:

				if ($fromProject->cut_index && $to->filename == $publishConfig->get('default','index')) {
					$filename = ''; // Link auf Index-Datei, der Dateiname bleibt leer.
				} else {

					$page = new Page($to->objectid);
					$page->load();

					$parentFolder = new Folder($page->parentid);
					$parentFolder->load();

					$format = $publishConfig->get('format','{filename}{language_sep}{language}{type_sep}{type}');
					$format = str_replace('{filename}', $page->filename(), $format);

					$allLanguages = $fromProject->getLanguageIds();
					$allModels    = $fromProject->getModelIds();

					$withLanguage =
						!$fromProject->content_negotiation  &&
						$fromProject->publishPageExtension  &&
						(count($allLanguages) > 1 || $publishConfig->get('filename_language','auto') == 'always');

					$withModel    =
						! $fromProject->content_negotiation   &&
						! $fromProject->publishPageExtension  &&
						(count($allModels) > 1    || $publishConfig->get('filename_type','always') == 'always');

					$languagePart = '';
					$typePart     = '';

					if ($withLanguage ) {
						$l = new Language($this->pageContext->languageId);
						$l->load();
						$languagePart = $l->isoCode;
					}

					if	( $withModel ) {
						$templateModel = new TemplateModel( $page->templateid, $this->pageContext->modelId );
						$templateModel->load();

						$typePart = $templateModel->extension;
					}

					$languageSep = $languagePart? $publishConfig->get('language_sep','.') :'';
					$typeSep     = $typePart    ? $publishConfig->get('type_sep'    ,'.') :'';

					$format = str_replace('{language}'    ,$languagePart ,$format );
					$format = str_replace('{language_sep}',$languageSep  ,$format );
					$format = str_replace('{type}'        ,$typePart     ,$format );
					$format = str_replace('{type_sep}'    ,$typeSep      ,$format );

					$filename = $format;
				}

                break;

            case BaseObject::TYPEID_URL:
                $url = new Url( $to->objectid );
                $url->load();
                return $url->url;

            default:
                throw new \LogicException("Could not build a link to the unknown Type ".$to->typeid.':'.$to->getType() );
        }


        if	( $from->projectid != $to->projectid )
        {
            // BaseTarget object is in another project.
            // we have to use absolute URLs.
            $schema = self::SCHEMA_ABSOLUTE;

            // BaseTarget is in another Project. So we have to create an absolute URL.
            $targetProject = Project::create( $to->projectid )->load();
            $host = $targetProject->url;

            if   ( ! strpos($host,'//' ) === FALSE ) {
                // No protocol in hostname. So we have to prepend the URL with '//'.
                $host = '//'.$host;
            }
        }
        else {
            $host = '';
        }




        if  ( $schema == self::SCHEMA_RELATIVE )
        {
            $folder = new Folder( $from->getParentFolderId() );
            $folder->load();
            $fromPathFolders = $folder->parentObjectFileNames(false,true);

            $folder = new Folder($to->getParentFolderId() );

            $toPathFolders = $folder->parentObjectFileNames(false, true);

            // Shorten the relative URL
            // if the actual page is /path/folder1/page1
            // and the target page is /path/folder2/page2
            // we shorten the link from ../../path/folder2/page2
            //                     to   ../folder2/page2
            foreach( $fromPathFolders as $folderId => $folderFileName ) {
                if   ( count($toPathFolders) >= 1 && array_keys($toPathFolders)[0] == $folderId ) {
                    unset( $fromPathFolders[$folderId] );
                    unset( $toPathFolders  [$folderId] );
                }else {
                    break;
                }

            }

            if   ( $fromPathFolders )
                $path = str_repeat( '../',count($fromPathFolders) );
            else
                $path = './'; // Just to clarify- this could be blank too.

            if   ( $toPathFolders )
                $path .= implode('/',$toPathFolders).'/';
        }
        else {
            // Absolute Pfadangaben
            $folder = new Folder( $to->getParentFolderId() );
            $toPathFolders = $folder->parentObjectFileNames(false, true);

            $path = '/';

            if   ( $toPathFolders )
                $path .= implode('/',$toPathFolders).'/';
        }


        $uri = $host . $path . $filename;

        if( !$uri )
            $uri = '.';

        return $uri;
    }

}