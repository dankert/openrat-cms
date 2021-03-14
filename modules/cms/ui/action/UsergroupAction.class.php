<?php

namespace cms\ui\action;

use cms\action\Action;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\base\Configuration as C;
use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\User;
use cms\model\Value;
use cms\ui\themes\Theme;
use Exception;
use language\Messages;
use util\Html;
use util\json\JSON;
use logger\Logger;
use util\Less;
use util\UIUtils;
use \util\exception\ObjectNotFoundException;
use util\Session;


/**
 * Action-Klasse fuer die Anzeige der Hauptseite.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class UsergroupAction extends Action
{
	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();
	}


	public function checkAccess() {
		return true; // Allowed for all
	}
}
