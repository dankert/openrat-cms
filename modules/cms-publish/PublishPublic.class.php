<?php

namespace cms\publish;

use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\Url;
use FileUtils;
use Ftp;
use Logger;
use OpenRatException;
use Session;



/**
 * User: dankert
 * Date: 10.08.18
 * Time: 23:47
 */

class PublishPublic extends Publish
{
    const SCHEMA_ABSOLUTE = 1;
    const SCHEMA_RELATIVE = 2;


    /**
     * Enthaelt bei Bedarf das FTP-Objekt. N�mlich dann, wenn
     * zu einem FTP-Server veroeffentlicht werden soll.
     * @var Object
     */
    private $ftp;

    private $localDestinationDirectory = '';

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var boolean
     */
    private $contentNegotiation = false;

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var boolean
     */
    private $cutIndex           = false;

    /**
     * Enthaelt die gleichnamige Einstellung aus dem Projekt.
     * @var String
     */
    private $commandAfterPublish = '';

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

        $project = Project::create( $projectid );
        $project->load();

        $this->linkSchema = ($project->linkAbsolute ? self::SCHEMA_ABSOLUTE : self::SCHEMA_RELATIVE);

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

        if	( $ftpUrl && $ftpUrl[0]!='#' )
        {
            $this->ftp = new \Ftp($project->ftp_url); // Aufbauen einer FTP-Verbindung

            $this->ftp->passive = ( $project->ftp_passive == '1' );
        }

        $targetDir = rtrim( $project->target_dir,'/' );

        if	( FileUtils::isAbsolutePath($targetDir) && $confPublish['filesystem']['per_project'] )
        {
            $this->localDestinationDirectory = FileUtils::toAbsolutePath([$targetDir]); // Projekteinstellung verwenden.
        }
        else
        {
            // Konfiguriertes Verzeichnis verwenden.
            $this->localDestinationDirectory = FileUtils::toAbsolutePath([$confPublish['filesystem']['directory'],$targetDir]);
        }


        // Sofort pruefen, ob das Zielverzeichnis ueberhaupt beschreibbar ist.
        if   ( $this->localDestinationDirectory && $this->localDestinationDirectory[0] == '#')
            $this->localDestinationDirectory = '';

        $this->contentNegotiation = ( $project->content_negotiation == '1' );
        $this->cutIndex           = ( $project->cut_index           == '1' );

        if	( $confPublish['command']['enable'] )
        {
            if	( $confPublish['command']['per_project'] && !empty($project->cmd_after_publish) )
                $this->commandAfterPublish   = $project->cmd_after_publish;
            else
                $this->commandAfterPublish   = @$confPublish['command']['command'];
        }

        // Im Systemkommando Variablen ersetzen
        $this->commandAfterPublish = str_replace('{name}'   ,$project->name                ,$this->commandAfterPublish);
        $this->commandAfterPublish = str_replace('{dir}'    ,$this->localDestinationDirectory          ,$this->commandAfterPublish);
        $this->commandAfterPublish = str_replace('{dirbase}',basename($this->localDestinationDirectory),$this->commandAfterPublish);

        if	( config('security','nopublish') )
        {
            Logger::warn('publishing is disabled.');
            $this->commandAfterPublish = '';
            $this->localDestinationDirectory = '';
            $this->ftp = null;
        }
    }



    /**
     * @var int
     */
    private $linkSchema;

    /**
     * @param $from \cms\model\Page
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( $from, $to ) {

        $schema = $this->linkSchema;

		$counter = 0;
        while( $to->typeid == BaseObject::TYPEID_LINK )
		{
			if   ( $counter++ > 10 )
				throw new \LogicException("Too much redirects while following a link. Stopped at #".$to->objectid );

			$link = new Link( $to->objectid );
			$link->load();

			$to = new BaseObject( $link->linkedObjectId );
			$to->objectLoad();
		}

        switch( $to->typeid )
        {
            case BaseObject::TYPEID_FILE:
            case BaseObject::TYPEID_IMAGE:
            case BaseObject::TYPEID_TEXT:

                $f = new File( $to->objectid );

                $p = Project::create( $to->projectid )->load();
                $f->content_negotiation = $p->content_negotiation;

                $f->load();
                $filename = $f->filename();
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

            case BaseObject::TYPEID_URL:
                $url = new Url( $to->objectid );
                $url->load();
                return $url->url;
            default:
                throw new \LogicException("Could not build a link to the unknown Type ".$to->typeid.':'.$to->getType() );
        }


        if	( $from->projectid != $to->projectid )
        {
            // Target object is in another project.
            // we have to use absolute URLs.
            $schema = self::SCHEMA_ABSOLUTE;

            // Target is in another Project. So we have to create an absolute URL.
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



		if   ( $this->localDestinationDirectory )
        {
        	// Is the output directory writable?
			if   ( !is_writeable( $this->localDestinationDirectory ) )
				throw new OpenRatException('ERROR_PUBLISH','directory not writable: '.$this->localDestinationDirectory );

            $dest   = $this->localDestinationDirectory.'/'.$dest_filename;

            // Is the destination writable?
			if   ( is_file($dest) && !is_writeable( $dest ) )
				throw new OpenRatException('ERROR_PUBLISH','file not writable: '.$this->dest );

			// Copy file to destination
			if   (!@copy( $source,$dest ));
            {
            	// Create directories, if necessary.
                $this->mkdirs( dirname($dest) );

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

        if   ( $this->ftp ) // Falls FTP aktiviert
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
    private function mkdirs($path )
    {
        global $conf;

        if	( is_dir($path) )
            return;  // Path exists

        $parentPath = dirname($path);

        $this->mkdirs($parentPath);

        //
        if	( ! @mkdir($path) )
            throw new OpenRatException('ERROR_PUBLISH','Cannot create directory: '.$path);

        // CHMOD auf dem Verzeichnis ausgef�hren.
        if	(!empty($conf['security']['chmod_dir']))
        {
            if	( ! @chmod($path,octdec($conf['security']['chmod_dir'])) )
                throw new OpenRatException('ERROR_PUBLISH','Unable to CHMOD directory: '.$path);
        }
    }



    /**
     * Beenden des Ver�ffentlichungs-Vorganges.<br>
     * Eine vorhandene FTP-Verbindung wird geschlossen.<br>
     * Falls entsprechend konfiguriert, wird ein Systemkommando ausgef�hrt.
     */
    public function close()
    {
        if   ( $this->ftp )
        {
            Logger::debug('Closing FTP connection' );
            $this->ftp->close();
        }

        // Ausfuehren des Systemkommandos.
        if	( !empty($this->commandAfterPublish) )
        {
            $ausgabe = array();
            $rc      = false;
            Logger::debug('Executing system command: '.$this->commandAfterPublish );
            $user = Session::getUser();
            putenv("CMS_USER_NAME=".$user->name  );
            putenv("CMS_USER_ID="  .$user->userid);
            putenv("CMS_USER_MAIL=".$user->mail  );
            exec( $this->commandAfterPublish,$ausgabe,$rc );

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
        if	( !empty($this->localDestinationDirectory) )
            $this->cleanFolder($this->localDestinationDirectory);
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