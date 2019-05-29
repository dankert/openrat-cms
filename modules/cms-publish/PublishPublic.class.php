<?php

namespace cms\publish;

use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\Url;
use Logger;
use OpenRatException;
use Session;

define('OR_LINK_SCHEMA_ABSOLUTE',1);
define('OR_LINK_SCHEMA_RELATIVE',2);


/**
 * User: dankert
 * Date: 10.08.18
 * Time: 23:47
 */

class PublishPublic extends Publish
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

        // If the target has an alias, use this alias as the target.
        $alias = $to->getAlias();
        if   ( $alias->filename )
            $to = $alias;

        switch( $to->typeid )
        {
            case BaseObject::TYPEID_FILE:
            case BaseObject::TYPEID_IMAGE:
            case BaseObject::TYPEID_TEXT:

                $f = new File( $to->objectid );

                $p = Project::create( $to->projectid )->load();
                $f->content_negotiation = $p->content_negotiation;

                $f->load();
                $filename = $f->filename;
                if  ( !empty($f->extension))
                    $filename .= '.'.$f->extension;
                break;

            case BaseObject::TYPEID_PAGE:

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

            case BaseObject::TYPEID_LINK:
                $link = new Link( $to->objectid );
                $link->load();

                $linkedObject = new BaseObject( $link->linkedObjectId );
                $linkedObject->objectLoad();

                switch( $linkedObject->typeid )
                {
                    case BaseObject::TYPEID_FILE:
                        $f = new File( $link->linkedObjectId );
                        $f->load();
                        $f->content_negotiation = $from->content_negotiation;
                        $filename = $f->filename;
                        $to = $f;
                        break;

                    case BaseObject::TYPEID_PAGE:
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

            case BaseObject::TYPEID_URL:
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





    /**
     * Enthaelt bei Bedarf das FTP-Objekt. N�mlich dann, wenn
     * zu einem FTP-Server veroeffentlicht werden soll.
     * @var Object
     */
    public $ftp;

    /**
     * Flag, ob in das lokale Dateisystem veroeffentlicht werden soll.
     * @var boolean
     */
    public $with_local          = false;

    /**
     * Flag, ob zu einem FTP-Server ver�ffentlicht werden soll.
     * @var boolean
     */
    public $with_ftp            = false;

    public $local_destdir       = '';

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var boolean
     */
    public $content_negotiation = false;

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var boolean
     */
    public $cut_index           = false;

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var String
     */
    public $cmd_after_publish   = '';

    /**
     * Enthaelt am Ende der Ver�ffentlichung ein Array mit den ver�ffentlichten Objekten.
     * @var Array
     */
    public $publishedObjects    = array();

    /**
     * Enthaelt im Fehlerfall (wenn 'ok' auf 'false' steht) eine
     * Fehlermeldung.
     *
     * @var String
     */
    public $log                 = array();

    /**
     * Konstruktor.<br>
     * <br>
     * Oeffnet ggf. Verbindungen.
     *
     * @return Publish
     */
    public function __construct( $projectid )
    {
        $confPublish = config('publish');

        if	( config('security','nopublish') )
        {
            Logger::warn('publishing is disabled.');
            return; // this is no error.
        }

        $project = new Project( $projectid );
        $project->load();

        // Feststellen, ob FTP benutzt wird.
        // Dazu muss FTP aktiviert sein (enable=true) und eine URL vorhanden sein.
        $ftpUrl = '';
        if   ( $confPublish['ftp']['enable'] )
        {
            if	( $confPublish['ftp']['per_project'] && !empty($project->ftp_url) )
                $ftpUrl = $project->ftp_url;
            elseif ( !empty($confPublish['ftp']['host']) )
                $ftpUrl = $project->ftp_url;
        }

        if	( ! empty($ftpUrl) )
        {
            $this->with_ftp = true;
            $this->ftp = new Ftp($project->ftp_url); // Aufbauen einer FTP-Verbindung

            $this->ftp->passive = ( $project->ftp_passive == '1' );
        }

        $localDir = rtrim( $project->target_dir,'/' );

        if	( $confPublish['filesystem']['per_project'] && (!empty($localDir)) )
        {
            $this->local_destdir = $localDir; // Projekteinstellung verwenden.
        }
        else
        {
            if	( empty( $localDir))
                $localDir = $project->name;

            // Konfiguriertes Verzeichnis verwenden.
            $this->local_destdir = $confPublish['filesystem']['directory'].$localDir;
        }


        // Sofort pruefen, ob das Zielverzeichnis ueberhaupt beschreibbar ist.
        if   ( $this->local_destdir != '' )
        {
            if   ( !is_writeable( $this->local_destdir ) )
                throw new OpenRatException('ERROR_PUBLISH','directory not writable: '.$this->local_destdir );

            $this->with_local = true;
        }

        $this->content_negotiation = ( $project->content_negotiation == '1' );
        $this->cut_index           = ( $project->cut_index           == '1' );

        if	( $confPublish['command']['enable'] )
        {
            if	( $confPublish['command']['per_project'] && !empty($project->cmd_after_publish) )
                $this->cmd_after_publish   = $project->cmd_after_publish;
            else
                $this->cmd_after_publish   = @$confPublish['command']['command'];
        }

        // Im Systemkommando Variablen ersetzen
        $this->cmd_after_publish = str_replace('{name}'   ,$project->name                ,$this->cmd_after_publish);
        $this->cmd_after_publish = str_replace('{dir}'    ,$this->local_destdir          ,$this->cmd_after_publish);
        $this->cmd_after_publish = str_replace('{dirbase}',basename($this->local_destdir),$this->cmd_after_publish);
    }



    /**
     * Kopieren einer Datei aus dem tempor�ren Verzeichnis in das Zielverzeichnis.<br>
     * Falls notwenig, wird ein Hochladen per FTP ausgef�hrt.
     *
     * @param String $tmp_filename
     * @param String $dest_filename
     */
    public function copy( $tmp_filename,$dest_filename,$lastChangeDate=null )
    {
        global $conf;
        $source = $tmp_filename;

        if   ( $this->with_local )
        {
            $dest   = $this->local_destdir.'/'.$dest_filename;

            if   (!@copy( $source,$dest ));
            {
                if	( ! $this->mkdirs( dirname($dest) ) )
                    return;  // Fehler bei Verzeichniserstellung, also abbrechen.

                if   (!@copy( $source,$dest ))
                    throw new OpenRatException('ERROR_PUBLISH','failed copying local file:'."\n".
                        'source     : '.$source."\n".
                        'destination: '.$dest);

                // Das Änderungsdatum der Datei auch in der Zieldatei setzen.
                if  ( $conf['publish']['set_modification_date'] )
                    if	( ! is_null($lastChangeDate) )
                        @touch( $dest,$lastChangeDate );

                Logger::debug("published: $dest");
            }

            if	(!empty($conf['security']['chmod']))
            {
                // CHMOD auf der Datei ausfuehren.
                if	( ! @chmod($dest,octdec($conf['security']['chmod'])) )
                    throw new OpenRatException('ERROR_PUBLISH','Unable to CHMOD file '.$dest);
            }
        }

        if   ( $this->with_ftp ) // Falls FTP aktiviert
        {
            $dest = $dest_filename;
            $this->ftp->put( $source,$dest );
        }
    }



    /**
     * Rekursives Anlagen von Verzeichnisse
     * Nett gemacht.
     * Quelle: http://de3.php.net/manual/de/function.mkdir.php
     * Thx to acroyear at io dot com
     *
     * @param String Verzeichnis
     * @return boolean
     */
    private function mkdirs( $strPath )
    {
        global $conf;

        if	( is_dir($strPath) )
            return true;

        $pStrPath = dirname($strPath);

        if	( !$this->mkdirs($pStrPath) )
            return false;

        if	( ! @mkdir($strPath,0777) )
            throw new OpenRatException('ERROR_PUBLISH','Cannot create directory: '.$strPath);

        // CHMOD auf dem Verzeichnis ausgef�hren.
        if	(!empty($conf['security']['chmod_dir']))
        {
            if	( ! @chmod($strPath,octdec($conf['security']['chmod_dir'])) )
                throw new OpenRatException('ERROR_PUBLISH','Unable to CHMOD directory: '.$strPath);
        }


        return true;
    }



    /**
     * Beenden des Ver�ffentlichungs-Vorganges.<br>
     * Eine vorhandene FTP-Verbindung wird geschlossen.<br>
     * Falls entsprechend konfiguriert, wird ein Systemkommando ausgef�hrt.
     */
    public function close()
    {
        if   ( $this->with_ftp )
        {
            Logger::debug('Closing FTP connection' );
            $this->ftp->close();
        }

        // Ausfuehren des Systemkommandos.
        if	( !empty($this->cmd_after_publish) )
        {
            $ausgabe = array();
            $rc      = false;
            Logger::debug('Executing system command: '.$this->cmd_after_publish );
            $user = Session::getUser();
            putenv("CMS_USER_NAME=".$user->name  );
            putenv("CMS_USER_ID="  .$user->userid);
            putenv("CMS_USER_MAIL=".$user->mail  );
            exec( $this->cmd_after_publish,$ausgabe,$rc );

            if	( $rc != 0 ) // Wenn Returncode ungleich 0, dann Fehler melden.
                throw new OpenRatException('ERROR_PUBLISH','System command failed - returncode is '.$rc."\n".
                    $ausgabe);
            else
                Logger::debug('System command successful' );

        }
    }



    /**
     * Aufraeumen des Zielverzeichnisses.<br><br>
     * Es wird der komplette Zielordner samt Unterverzeichnissen durchsucht. Jede
     * Datei, die laenger existiert als der aktuelle Request alt ist, wird geloescht.<br>
     * Natuerlich darf diese Funktion nur nach einem Gesamt-Veroeffentlichen ausgefuehrt werden.
     */
    public function clean()
    {
        if	( !empty($this->local_destdir) )
            $this->cleanFolder($this->local_destdir);
    }



    /**
     * Aufr�umen eines Verzeichnisses.<br><br>
     * Dateien, die l�nger existieren als der aktuelle Request alt ist, werden gel�scht.<br>
     *
     * @param String Verzeichnis
     */
    private function cleanFolder( $folderName )
    {
        $dh = opendir( $folderName );

        while( $file = readdir($dh) )
        {
            if	( $file != '.' && $file != '..')
            {
                $fullpath = $folderName.'/'.$file;

                // Wenn eine Datei beschreibbar und entsprechend alt
                // ist, dann entfernen
                if	( is_file($fullpath)     &&
                    is_writable($fullpath) &&
                    filemtime($fullpath) < START_TIME  )
                    unlink($fullpath);

                // Bei Ordnern rekursiv absteigen
                if	( is_dir( $fullpath) )
                {
                    $this->cleanFolder($fullpath);
                    @rmdir($fullpath);
                }
            }
        }
    }


    public function isSimplePreview()
    {
        return false;
    }

    public function isPublic()
    {
        return true;
    }
}