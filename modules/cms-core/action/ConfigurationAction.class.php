<?php

namespace cms\action;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

use Session;
/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class ConfigurationAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;
	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();
	}


	public function editView()
	{
		$this->nextSubAction('show');

	}
	
	
	/**
	 * Anzeigen des Elementes
	 */
	public function showView()
	{
        require_once( OR_MODULES_DIR.'/util/config-default.php');
        $conf = createDefaultConfig();
        $conf_default = $conf;
		
		$conf_cms = Session::getConfig();

        // Language are to much entries
        unset($conf_cms['language']);


		$conf_cms['system'] = $this->getSystemConfiguration();

		//$split = "\xC2\xA0"."\xC2\xA0"."\xC2\xBB"."\xC2\xA0"."\xC2\xA0";
		//$flatDefaultConfig = \ArrayUtils::flattenArray('', $conf_default       , $split );
		//$flatCMSConfig     = \ArrayUtils::flattenArray('', Session::getConfig(), $split );
		//$flatConfig        = \ArrayUtils::flattenArray('', $conf_cms           , $split );

		$pad = str_repeat("\xC2\xA0",10); // Hard spaces

		$flatDefaultConfig = \ArrayUtils::dryFlattenArray( $conf_default       , $pad );
		$flatCMSConfig     = \ArrayUtils::dryFlattenArray( Session::getConfig(), $pad );
		$flatConfig        = \ArrayUtils::dryFlattenArray( $conf_cms           , $pad );

		$config = array();
		foreach( $flatConfig as $key=>$val )
			$config[] = array( 'key'=>$key,'value'=>substr($key,-8)=='password'?'*******************':$val,'class'=>(empty($flatCMSConfig[$key])?'readonly':(isset($flatDefaultConfig[$key]) && $flatDefaultConfig[$key]==$flatConfig[$key]?'default':'changed')));

		$this->setTemplateVar('config',$config );
	}


    /**
     * Die Konfiguration als YAML-String anzeigen.
     */
	public function srcView()
    {
        $conf = Session::getConfig();
        unset( $conf['language']);

        // Mask passwords.
        array_walk_recursive($conf,function(&$item,$key)
        {
            if($key=='password'){
                $item='*************';
            }
        });

        $this->setTemplateVar('source',\Spyc::YAMLDump($conf,4,0,true));
    }



    /**
     * Reads system configuration.
     * @return array
     */
    private function getSystemConfiguration()
    {
        $conf['server'] = array('time' => date('r'),
            'name' => php_uname(),
            'os' => php_uname('s'),
            'host' => php_uname('n'),
            'release' => php_uname('r'),
            'machine' => php_uname('m'),
            'owner' => get_current_user(),
            'pid' => getmypid());


        $conf['interpreter'] = array('version' => phpversion(),
            'SAPI' => php_sapi_name(),
            'session-name' => session_name(),
            'magic_quotes_gpc' => get_magic_quotes_gpc(),
            'loaded_ini_file' => php_ini_loaded_file(),
            'magic_quotes_runtime' => get_magic_quotes_runtime());

        $conf['interpreter']['server'] = $_SERVER;
        $conf['interpreter']['environment'] = $_ENV;
        $conf['interpreter']['temp_dir'] = sys_get_temp_dir();

        $conf['interpreter']['configuration'] = ini_get_all();
        $conf['resources'] = getrusage();

        $extensions = get_loaded_extensions();
        asort($extensions);

        foreach ($extensions as $id => $extensionName)
            $conf['interpreter']['extension'][$extensionName] = 'loaded';

        return $conf;
    }

}




?>