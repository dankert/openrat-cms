<?php

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
	function WorkbenchAction()
	{
		global $conf;
		$this->perspective = Session::get('perspective');
		
		
		
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	public function showView()
	{
		global $conf;
		global $preselectobject;
		if	( empty($this->perspective) )
		{
			$guestConf = $conf['security']['guest'];
			
			if	( $guestConf['enable'] )
				$this->perspective = 'start';
			else
				$this->perspective = 'login';
			
			Session::set('perspective',$this->perspective);
		}

		// Zuletzt geändertes Objekt laden.
		if	( $this->perspective == 'normal' &&
			  $conf['login']['start']['start_lastchanged_object'] ) {
			$user    = Session::getUser();
			$project = Session::getProject();
			
			$objectid = Value::getLastChangedObjectInProjectByUserId($project->projectid, $user->userid);
			if	( Object::available($objectid))
			{
				$object = new Object($objectid);
				$object->load();
				
				Logger::debug('preselecting object '.$objectid);
				$preselectobject = $object;
			}
		}
		
		global $viewconfig;
		$viewconfig = parse_ini_file('themes/default/layout/perspective/'.$this->perspective.'.ini.php',true);
		
		require_once('themes/default/layout/perspective/header.php');
		require_once('themes/default/layout/perspective/normal.php');
		// Ausgabe fertig.
		exit;
	}
}

?>