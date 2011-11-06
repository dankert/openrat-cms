<?php

/**
 * Action-Klasse zum Bearbeiten einer Datei
 * @author Jan Dankert
 * @package openrat.actions
 */
class WorkbenchAction extends Action
{
	var $defaultSubAction = 'show';

	private $perspective;
	
	/**
	 * Konstruktor
	 */
	function WorkbenchAction()
	{
		$this->perspective = Session::get('perspective');
		if	( empty($this->perspective) )
		{
			$this->perspective = 'login';
			Session::set('perspective',$this->perspective);
		}
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	public function show()
	{
		global $viewconfig;
		$viewconfig = parse_ini_file('themes/default/layout/perspective/'.$this->perspective.'.ini.php',true);
		require_once('themes/default/layout/perspective/header.php');
		require_once('themes/default/layout/perspective/'.$this->perspective.'.php');
		// Ausgabe fertig.
	}
}

?>