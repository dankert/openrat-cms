<?php

namespace cms\action;

use cms\base\Configuration;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use util\exception\ValidationException;
use util\Html;
use util\Upload;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


/**
 * Action-Klasse zum Bearbeiten einer Datei
 *
 * @author Jan Dankert
 */
class FileAction extends ObjectAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var File
     */
	protected $file;

	/**
	 * Konstruktor
	 */
	function __construct()
    {
        parent::__construct();
    }


    public function init()
    {
		$file = new File( $this->getRequestId() );
		$file->languageid = $this->getRequestVar(RequestParams::PARAM_LANGUAGE_ID);
		$file->load();

        $this->setBaseObject( $file );
	}


	protected function setBaseObject( $file ) {
		$this->file = $file;

		parent::setBaseObject( $file );
	}


	/**
	 * Ersetzt den Inhalt der Datei.
	 */
	public function editPost()
	{
		$upload = new Upload();

		if   ( $upload->isAvailable() )
        {
            // File received as attachement.
            try
            {
                $upload->processUpload();
            }
            catch( \Exception $e )
            {
                throw $e;
            }

            $this->file->filename  = $upload->filename;
            $this->file->extension = $upload->extension;
            $this->file->size      = $upload->size;
            $this->file->save();

            $this->file->value = $upload->value;
            $this->file->saveValue();
        }
		elseif( $this->hasRequestVar('value') )
        {
            // File value received
            $this->file->value = $this->getRequestVar('value');

            if   ( strtolower($this->getRequestVar('encoding')) == 'base64')
                // file value is base64-encoded
                $this->file->value = base64_decode($this->file->value);

            $this->file->saveValue();
        }
        else
        {
            // No file received.
            throw new ValidationException('value');
        }

        $this->file->setTimestamp();

		$this->addNotice($this->file->getType(), 0, $this->file->filename, 'VALUE_SAVED', 'ok');
	}


    /**
     * Abspeichern der Eigenschaften zu dieser Datei.
     *
     */
    function advancedPost()
    {
        $this->file->extension = $this->getRequestVar('extension'  ,RequestParams::FILTER_FILENAME);

		$typeid = $this->getRequestVar('type',RequestParams::FILTER_NUMBER  );

		if   ( ! in_array($typeid,[BaseObject::TYPEID_FILE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_TEXT]))
			throw new ValidationException('type');

        $this->file->typeid = $typeid;
        $this->file->updateType();
        $this->file->save();

        $this->addNotice($this->file->getType(), 0, $this->file->filename, 'PROP_SAVED', 'ok');
    }



    /**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function previewView()
	{
		$url = Html::url($this->file->getType(),'show',$this->file->objectid );
		$this->setTemplateVar('preview_url',$url );
	}


	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function showView()
	{
		$fileContext = new FileContext($this->file->objectid, Producer::SCHEME_PREVIEW );

		$generator = new FileGenerator( $fileContext);

		$this->lastModified( $this->file->lastchangeDate );

		if	( $this->file->extension == 'gz' )
		{
			$pos = strrpos($this->file->filename,'.');
			if	( $pos === false )
				$ext = '';
			else
				$ext = substr($this->file->filename,$pos+1);

			$ext = strtolower($ext);

			$mime_type = File:: $mime_types[$ext];

			header('Content-Type: '.$mime_type );
			header('Content-Encoding: gzip' );
		}
		else
		{
			// Angabe Content-Type
			header('Content-Type: '.$this->file->mimeType() );
		}

		header('X-File-Id: '   .$this->file->fileid     );
		header('X-Id: '        .$this->file->id         );

		// Angabe Content-Disposition
		// - Bild soll "inline" gezeigt werden
		// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
		header('Content-Disposition: inline; filename='.$this->file->filename() );
		header('Content-Transfer-Encoding: binary' );
		header('Content-Description: '.$this->file->filename() );

		//$this->file->write(); // Bild aus Datenbank laden

		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		header('Content-Length: '.$this->file->size );


		if	( $this->request->getRequestVar('encoding') == 'base64')
		{
		    $encodingFunction = function($value) {
		        return base64_encode($value);
            };
			$this->setTemplateVar('encoding', 'base64');
		}
		else {
            $encodingFunction = function($value) {
                return $value;
            };
            $this->setTemplateVar('encoding', 'none');
        }


		// Unterscheidung, ob PHP-Code in der Datei ausgefuehrt werden soll.
		$publishConfig = Configuration::subset('publish');
        $phpActive = ( $publishConfig->get('enable_php_in_file_content')=='auto' && $this->file->getRealExtension()=='php') ||
            $publishConfig->get('enable_php_in_file_content' )===true;

        if	(  $phpActive ) {

            // PHP-Code ausfuehren
            ob_start();
            require( $generator->getCache()->load()->getFilename() );
            $this->setTemplateVar('value',$encodingFunction(ob_get_contents()) );
            ob_end_clean();
        }
        else
            $this->setTemplateVar('value',$encodingFunction( $generator->getCache()->get() ) );
        // Maybe we want some gzip-encoding?
	}




	public function advancedView()
	{
		// Eigenschaften der Datei uebertragen
		$this->setTemplateVar( 'extension',$this->file->extension );
		$this->setTemplateVar( 'type'     ,$this->file->type      );
		$this->setTemplateVar( 'types'    ,[
			BaseObject::TYPEID_FILE  => \cms\base\Language::lang('file' ),
			BaseObject::TYPEID_IMAGE => \cms\base\Language::lang('image'),
			BaseObject::TYPEID_TEXT  => \cms\base\Language::lang('text' )
		] );
	}




	/**
	 * Anzeigen des Inhaltes
	 */
	function editView()
	{
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function upload()
	{
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function valueView()
	{
		// MIME-Types aus Datei lesen
		//$this->setTemplateVars( $this->file->getProperties() );
		//$this->setTemplateVar('value',$this->file->loadValue());
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function extractView()
	{
		$this->setTemplateVars( $this->file->getProperties() );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function uncompressView()
	{
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function uncompressPost()
	{
		switch( $this->file->extension )
		{
			case 'gz':
				if	( $this->getRequestVar('replace') )
				{
					if	( strcmp(substr($this->file->loadValue(),0,2),"\x1f\x8b"))
					{
						throw new \LogicException("Not GZIP format (See RFC 1952)");
					}
					$method = ord(substr($this->file->loadValue(),2,1));
					if	( $method != 8 )
					{
						throw new \LogicException("Unknown GZIP method: $method");
					}
					$this->file->value = gzinflate( substr($this->file->loadValue(),10));
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzinflate( substr($this->file->loadValue(),10));
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			case 'bz2':
				if	( $this->getRequestVar('replace') )
				{
					$this->file->value = bzdecompress($this->file->loadValue());
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzdecompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			default:
				throw new \util\exception\UIException('','cannot uncompress file with extension: ' . $this->file->extension );
		}

		$this->addNotice('file', 0, $this->file->name, 'DONE', Action::NOTICE_OK);
		$this->callSubAction('edit');
	}



	/**
	 * Anzeigen des Inhaltes
	 */
	function extractPost()
	{
		switch( $this->file->extension )
		{
			case 'tar':
				$folder = new Folder();
				$folder->parentid = $this->file->parentid;
				$folder->name     = $this->file->name;
				$folder->filename = $this->file->filename;
				$folder->add();
				
				$tar = new ArchiveTar();
				$tar->openTAR( $this->file->loadValue() );
				
				foreach( $tar->files as $file )
				{
					$newFile = new File();
					$newFile->name     = $file['name'];
					$newFile->parentid = $folder->objectid;
					$newFile->value    = $file['file'];
					$newFile->parse_filename( $file['name'] );
					$newFile->lastchangeDate = $file['time'];
					$newFile->add();
					
					$this->addNotice('file', 0, $newFile->name, 'ADDED');
				}
				
				unset($tar);
				
				break;

			case 'zip':
			
				$folder = new Folder();
				$folder->parentid    = $this->file->parentid;
				$folder->name        = $this->file->name;
				$folder->filename    = $this->file->filename;
				$folder->description = $this->file->fullFilename;
				$folder->add();
				
				$zip = new ArchiveUnzip();
				$zip->open( $this->file->loadValue() );

				$lista = $zip->getList();

				if(sizeof($lista)) foreach($lista as $fileName=>$trash){
					

					$newFile = new File();
					$newFile->name        = basename($fileName);
					$newFile->description = 'Extracted: '.$this->file->fullFilename.' -> '.$fileName;
					$newFile->parentid    = $folder->objectid;
					$newFile->parse_filename( basename($fileName) );

					$newFile->value       = $zip->unzip($fileName);
					$newFile->add();
					
					$this->addNotice('file', 0, $newFile->name, 'ADDED');
					unset($newFile);
				}

				$zip->close();
				unset($zip);
				
				break;

			default:
				throw new \util\exception\UIException('cannot extract file with extension: ' . $this->file->extension );
		}
		$this->callSubAction('edit');
	}



	/**
	 * Anzeigen des Inhaltes
	 */
	function compressView()
	{
		$formats = array();
		foreach( $this->getCompressionTypes() as $t )
			$formats[$t] = \cms\base\Language::lang('compression_'.$t);

		$this->setTemplateVar('formats'       ,$formats    );
	}

	

	/**
	 * Anzeigen des Inhaltes
	 */
	function compressPost()
	{
		$format = $this->getRequestVar('format',RequestParams::FILTER_ALPHANUM);
		
		switch( $format )
		{
			case 'gz':
				if	( $this->getRequestVar('replace',RequestParams::FILTER_NUMBER)=='1' )
				{
					$this->file->value = gzencode( $this->file->loadValue(),1 );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzencode( $this->file->loadValue(),1 );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$newFile->add();
				}
				
				break;

			case 'bzip2':
				if	( $this->getRequestVar('replace')=='1' )
				{
					$this->file->value = bzcompress( $this->file->loadValue() );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzcompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$newFile->add();
				}
				
				break;
			default:
				throw new \util\exception\UIException('unknown compress type: ' . $format );
		}

		$this->addNotice('file', 0, $this->file->name, 'DONE', Action::NOTICE_OK);
		$this->callSubAction('edit');
	}


	/**
	 * Datei veroeffentlichen
	 */
	function pubView()
	{
	}


	/**
	 * Datei veroeffentlichen
	 */
	function pubPost()
	{
		$fileGenerator = new FileGenerator( new FileContext( $this->file->objectid, Producer::SCHEME_PUBLIC));

		$publisher = new Publisher( $this->file->projectid );
		$publisher->addOrderForPublishing( new PublishOrder( $fileGenerator->getCache()->load()->getFilename(),$fileGenerator->getPublicFilename(),$this->file->lastchangeDate) );
		$publisher->publish();

		$this->addNoticeFor($this->file,'PUBLISHED',[],'Published items:'."\n".implode("\n",$publisher->getDestinationFilenames())  );
	}



	function getCompressionTypes()
	{
		$compressionTypes = array();
		if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'gz';
		//if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'zip';
		if	( function_exists('bzipcompress') ) $compressionTypes[] = 'bz2';
		return $compressionTypes;
	}

	function getArchiveTypes()
	{
		$archiveTypes = array();
		$archiveTypes[] = 'tar';
		$archiveTypes[] = 'zip';
		return $archiveTypes;
	}



	public function removeView()
    {
        $this->setTemplateVar( 'name',$this->file->filename );
    }


    public function removePost()
    {
        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->file->delete();
            $this->addNotice('template', 0, $this->file->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('template', 0, $this->file->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }
}

?>