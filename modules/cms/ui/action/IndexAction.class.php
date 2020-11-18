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
class IndexAction extends Action
{
	public $security = Action::SECURITY_GUEST;

	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();
	}

    /**
     * @param User $user
     * @return \configuration\Config|string
     */
    protected function getUserStyle($user )
    {
        // Theme für den angemeldeten Benuter ermitteln
        if  ( $user && C::subset('style')->has($user->style) )
            $style = $user->style;
        else
            $style = C::subset( ['interface', 'style'])->get('default','default');
        return $style;
    }




	/**
	 * Content-Security-Policy.
	 */
	protected function setContentSecurityPolicy()
	{
		$csp = Configuration::subset('security' )->get('csp', [
			'default-src' =>'\'self\'', // Default for all is 'self' (CSS, styles, etc)
			'frame-src'   => '*'        // For preview of urls we need to show every url in an iframe.
		] );

		header('Content-Security-Policy: ' . implode(';', array_map( function($value,$key) {
				return $key.' '.$value;
			},$csp,array_keys($csp) )));
	}

}
