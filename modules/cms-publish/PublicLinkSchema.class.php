<?php

namespace cms\publish;

use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\Url;

define('OR_LINK_SCHEMA_ABSOLUTE',1);
define('OR_LINK_SCHEMA_RELATIVE',2);


/**
 * User: dankert
 * Date: 10.08.18
 * Time: 23:47
 */

class PublicLinkSchema
{
    /**
     * @param $from \cms\model\Page
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( $from, $to ) {

        if  ( config('publish','url') == 'relative')
            $schema = OR_LINK_SCHEMA_RELATIVE;
        else
            $schema = OR_LINK_SCHEMA_ABSOLUTE;


        switch( $to->typeid )
        {
            case OR_TYPEID_FILE:
            case OR_TYPEID_IMAGE:
            case OR_TYPEID_TEXT:

                $f = new File( $to->objectid );

                $p = Project::create( $to->projectid )->load();
                $f->content_negotiation = $p->content_negotiation;

                $f->load();
                $filename = $f->filename;
                if  ( !empty($f->extension))
                    $filename .= '.'.$f->extension;
                break;

            case OR_TYPEID_PAGE:

                $p = new Page( $to->objectid );
                $p->languageid          = $from->languageid;
                $p->modelid             = $from->modelid;
                $p->cut_index           = $from->cut_index;
                $p->content_negotiation = $from->content_negotiation;
                $p->withLanguage        = $from->withLanguage;
                $p->withModel           = $from->withModel;
                $p->load();
                $filename = $p->getFilename();
                break;

            case OR_TYPEID_LINK:
                $link = new Link( $to->objectid );
                $link->load();

                $linkedObject = new BaseObject( $link->linkedObjectId );
                $linkedObject->objectLoad();

                switch( $linkedObject->typeid )
                {
                    case OR_TYPEID_FILE:
                        $f = new File( $link->linkedObjectId );
                        $f->load();
                        $f->content_negotiation = $from->content_negotiation;
                        $filename = $f->filename;
                        $to = $f;
                        break;

                    case OR_TYPEID_PAGE:
                        $p = new Page( $link->linkedObjectId );
                        $p->languageid          = $from->languageid;
                        $p->modelid             = $from->modelid;
                        $p->cut_index           = $from->cut_index;
                        $p->content_negotiation = $from->content_negotiation;
                        $p->withLanguage        = $from->withLanguage;
                        $p->withModel           = $from->withModel;
                        $p->load();
                        $filename = $p->getFilename();
                        $to = $p;
                        break;
                    default:
                        throw new \LogicException("Unknown Type ".$linkedObject->getType());
                }
                break;

            case OR_TYPEID_URL:
                $url = new Url( $to->objectid );
                $url->load();
                return $url->url;
            default:
                throw new \LogicException("Unknown Type ".$to->typeid);
        }


        if	( $from->projectid != $to->projectid )
        {
            // Target object is in another project.
            // we have to use absolute URLs.
            $schema = OR_LINK_SCHEMA_ABSOLUTE;

            // Target is in another Project. So we have to create an absolute URL.
            $targetProject = Project::create( $to->projectid )->load();
            $prefix = $targetProject->url;

            if   ( ! strpos($prefix,'//' ) === FALSE ) {
                // No protocol in hostname. So we have to prepend the URL with '//'.
                $prefix = '//'.$prefix;
            }
        }
        else {
            $prefix = '';
        }




        if  ( $schema == OR_LINK_SCHEMA_RELATIVE )
        {
            $folder = new Folder( $from->parentid );
            $folder->load();
            $fromPathFolders = $folder->parentObjectFileNames(false,true);


            $folder = new Folder($to->parentid);

            $toPathFolders = $folder->parentObjectFileNames(false, true);

            // Shorten the relative URL
            // if the actual page is /path/folder1/page1
            // and the target page is /path/folder2/page2
            // we shorten the link from ../../path/folder2/page2
            //                     to   ../folder2/page2
            foreach( $fromPathFolders as $folderId ) {
                if   ( count($toPathFolders) >= 1 && array_keys($toPathFolders)[0] == $folderId ) {
                    unset( $fromPathFolders[$folderId] );
                    unset( $toPathFolders  [$folderId] );
                }else {
                    break;
                }

            }

            $path = str_repeat( '../',count($fromPathFolders) );
            $path .= implode('/',$toPathFolders);
            $path .= '/';
        }
        else {
            // Absolute Pfadangaben
            $folder = new Folder($to->parentid);
            $toPathFolders = $folder->parentObjectFileNames(false, true);

            $path = implode('/',$toPathFolders);
            $path = '/'.$path.'/';
        }


        $uri = $prefix . $path . $filename;

        if( empty($uri)) $uri = '.';

        return $uri;
    }
}