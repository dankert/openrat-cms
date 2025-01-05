<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\model\User;
use cms\ui\action\IndexAction;
use cms\ui\themes\ThemeStyle;
use language\Messages;
use util\Html;
use util\Session;
use util\UIUtils;
use cms\base\Configuration as C;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\Value;
use cms\ui\themes\Theme;
use Exception;
use util\json\JSON;
use logger\Logger;
use util\Less;
use \util\exception\ObjectNotFoundException;

/**
 * Main action, displayed after starting the UI.
 *
 * @package cms\ui\action\index
 */
class IndexEditAction extends IndexAction implements Method {

    public function view() {

		if   ( $this->currentUser )
		{
			$changes = $this->currentUser->getValueChanges( time()-(60*60*24*30));

			$days = [];
			for( $ts = time()-(60*60*24*30); $ts <= time(); $ts+=60*60*24 ) {
				$days[ date('Ymd',$ts) ] = 0;
			}

			$max  = 0;
			foreach( $changes as $change ) {
				$idx = date('Ymd',$change['lastchange_date']);
				$days[ $idx ] = intval(@$days[$idx]) + 1;
			}

			// maximum of all days
			foreach( $days as $dayCount ) {
				$max = max($max,$dayCount);
			}
			$days = array_map( function ($dayCount) use ($max) {
				$maxHeight = 25;
				$height = floor($maxHeight*$dayCount/$max);
				return str_repeat("\xe2\x80\x8a",$height);
			},$days);

			$timeline = array_map( function( $change ) {
				// already loaded per SQL
				//$change['username'] = ((new User($change['userid']))->load()->getName());
				if    ( $change['pageid'] ) {
					$change['action'] = 'page';
					$change['id'    ] = $change['pageid'];
				}
				if    ( $change['fileid'] ) {
					$change['action'] = 'file';
					$change['id'    ] = $change['fileid'];
				}
				if    ( $change['templateid'] ) {
					$change['action'] = 'template';
					$change['id'    ] = $change['templateid'];
				}
				return $change;
			},$changes );

			$this->setTemplateVar('timeline',$timeline );
			$this->setTemplateVar('days'    ,$days );
		}

    	$this->setTemplateVar('isAdmin' ,$this->userIsAdmin() );
    }


    public function post() {
    }
}
