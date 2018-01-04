<?php

namespace cms\action;

use cms\model\Value;
use cms\model\Folder;
use cms\model\Object;

use Logger;
use Session;

/**
 * Action-Klasse zum Anzeigen der Workbench
 * @author Jan Dankert
 * @package openrat.actions
 */
class WorkbenchAction extends Action
{
	public $security = SECURITY_GUEST;

	private $perspective;
	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
		global $conf;
		global $SESS;
		$this->perspective = Session::get('perspective');
		Logger::info('Workbench: Perspective is '.$this->perspective);
		//Logger::info('Workbench: Sitzung: '.print_r($SESS,true));

		
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	public function showView()
	{
		global $conf;
		global $preselectedobjects;

		
		$preselectedobjects = array();;
		// Zuletzt geändertes Objekt laden.
		if	( $this->perspective == 'normal' )
		{
			$project = Session::getProject();
			if(!empty($project)){

                $rootFolder = new Folder( $project->getRootObjectId() );
                $rootFolder->load();
                $preselectedobjects[] = $rootFolder;

                if	( $conf['login']['start']['start_lastchanged_object'] )
                {
                    $user    = Session::getUser();
                    if(!empty($user)){

                        $objectid = Value::getLastChangedObjectInProjectByUserId($project->projectid, $user->userid);
                        if	( Object::available($objectid))
                        {
                            $object = new Object($objectid);
                            $object->load();

                            Logger::debug('preselecting object '.$objectid);
                            $preselectedobjects[] = $object;
                        }
                    }

                }
            }
		}
		
		global $viewconfig;
		
		Logger::debug('Workbench is using perspektive: '.$this->perspective);
		$viewconfig = parse_ini_file(__DIR__.'/../../cms-ui/themes/default/layout/perspective/'.$this->perspective.'.ini.php',true);
		
		require_once(__DIR__.'/../../cms-ui/themes/default/layout/perspective/window.php');
		require_once(__DIR__.'/../../cms-ui/themes/default/layout/perspective/'.$this->perspective.'.php');
		// Ausgabe fertig.
		exit;
	}
}

?>