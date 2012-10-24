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
		$this->perspective = Session::get('perspective');
		if	( empty($this->perspective) )
		{
			global $conf;
			$guestConf = $conf['security']['guest'];
			
			if	( $guestConf['enable'] )
				$this->perspective = 'start';
			else
				$this->perspective = 'login';
			
			Session::set('perspective',$this->perspective);
		}
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	public function showView()
	{
		global $viewconfig;
		$viewconfig = parse_ini_file('themes/default/layout/perspective/'.$this->perspective.'.ini.php',true);
		require_once('themes/default/layout/perspective/header.php');
		require_once('themes/default/layout/perspective/normal.php');
		// Ausgabe fertig.
		exit;
	}
}

?>