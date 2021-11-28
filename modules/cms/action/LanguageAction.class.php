<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Permission;
use cms\model\Project;
use util\exception\SecurityException;

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
 * Action-Klasse f?r die Bearbeitung einer Sprache
 * @version $Id$
 * @author  $Author$
 * @package openrat.actions
 */
class LanguageAction extends BaseAction
{
	const LANGUAGE_LIST =
	[
		'AA' => 'Afar',
		'AB' => 'Abkhazian',
		'AF' => 'Afrikaans',
		'AM' => 'Amharic',
		'AR' => 'Arabic',
		'AS' => 'Assamese',
		'AY' => 'Aymara',
		'AZ' => 'Azerbaijani',
		'BA' => 'Bashkir',
		'BE' => 'Byelorussian',
		'BG' => 'Bulgarian',
		'BH' => 'Bihari',
		'BI' => 'Bislama',
		'BN' => 'Bengali',
		'BO' => 'Tibetan',
		'BR' => 'Breton',
		'CA' => 'Catalan',
		'CO' => 'Corsican',
		'CS' => 'Czech',
		'CY' => 'Welsh',
		'DA' => 'Danish',
		'DE' => 'German',
		'DZ' => 'Bhutani',
		'EL' => 'Greek',
		'EN' => 'English',
		'EO' => 'Esperanto',
		'ES' => 'Spanish',
		'ET' => 'Estonian',
		'EU' => 'Basque',
		'FA' => 'Persian',
		'FI' => 'Finnish',
		'FJ' => 'Fiji',
		'FO' => 'Faeroese',
		'FR' => 'French',
		'FY' => 'Frisian',
		'GA' => 'Irish',
		'GD' => 'Gaelic',
		'GL' => 'Galician',
		'GN' => 'Guarani',
		'GU' => 'Gujarati',
		'HA' => 'Hausa',
		'HI' => 'Hindi',
		'HR' => 'Croatian',
		'HU' => 'Hungarian',
		'HY' => 'Armenian',
		'IA' => 'Interlingua',
		'IE' => 'Interlingue',
		'IK' => 'Inupiak',
		'IN' => 'Indonesian',
		'IS' => 'Icelandic',
		'IT' => 'Italian',
		'IW' => 'Hebrew',
		'JA' => 'Japanese',
		'JI' => 'Yiddish',
		'JW' => 'Javanese',
		'KA' => 'Georgian',
		'KK' => 'Kazakh',
		'KL' => 'Greenlandic',
		'KM' => 'Cambodian',
		'KN' => 'Kannada',
		'KO' => 'Korean',
		'KS' => 'Kashmiri',
		'KU' => 'Kurdish',
		'KY' => 'Kirghiz',
		'LA' => 'Latin',
		'LN' => 'Lingala',
		'LO' => 'Laothian',
		'LT' => 'Lithuanian',
		'LV' => 'Latvian',
		'MG' => 'Malagasy',
		'MI' => 'Maori',
		'MK' => 'Macedonian',
		'ML' => 'Malayalam',
		'MN' => 'Mongolian',
		'MO' => 'Moldavian',
		'MR' => 'Marathi',
		'MS' => 'Malay',
		'MT' => 'Maltese',
		'MY' => 'Burmese',
		'NA' => 'Nauru',
		'NE' => 'Nepali',
		'NL' => 'Dutch',
		'NO' => 'Norwegian',
		'OC' => 'Occitan',
		'OM' => 'Oromo',
		'OR' => 'Oriya',
		'PA' => 'Punjabi',
		'PL' => 'Polish',
		'PS' => 'Pashto',
		'PT' => 'Portuguese',
		'QU' => 'Quechua',
		'RM' => 'Rhaeto-Romance',
		'RN' => 'Kirundi',
		'RO' => 'Romanian',
		'RU' => 'Russian',
		'RW' => 'Kinyarwanda',
		'SA' => 'Sanskrit',
		'SD' => 'Sindhi',
		'SG' => 'Sangro',
		'SH' => 'Serbo-Croatian',
		'SI' => 'Singhalese',
		'SK' => 'Slovak',
		'SL' => 'Slovenian',
		'SM' => 'Samoan',
		'SN' => 'Shona',
		'SO' => 'Somali',
		'SQ' => 'Albanian',
		'SR' => 'Serbian',
		'SS' => 'Siswati',
		'ST' => 'Sesotho',
		'SU' => 'Sudanese',
		'SV' => 'Swedish',
		'SW' => 'Swahili',
		'TA' => 'Tamil',
		'TE' => 'Tegulu',
		'TG' => 'Tajik',
		'TH' => 'Thai',
		'TI' => 'Tigrinya',
		'TK' => 'Turkmen',
		'TL' => 'Tagalog',
		'TN' => 'Setswana',
		'TO' => 'Tonga',
		'TR' => 'Turkish',
		'TS' => 'Tsonga',
		'TT' => 'Tatar',
		'TW' => 'Twi',
		'UK' => 'Ukrainian',
		'UR' => 'Urdu',
		'UZ' => 'Uzbek',
		'VI' => 'Vietnamese',
		'VO' => 'Volapuk',
		'WO' => 'Wolof',
		'XH' => 'Xhosa',
		'YO' => 'Yoruba',
		'ZH' => 'Chinese',
	];

	/**
	 * Zu bearbeitende Sprache, wird im Kontruktor instanziiert
	 * @type Language
	 */
	protected $language;


	/**
	 * Konstruktor
	 */
	public function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->language = new Language( $this->request->getId() );
		$this->language->load();
	}


	/**
	 * User must be an project administrator.
	 */
	public function checkAccess() {
		$project      = new Project( $this->language->projectid );
		$rootFolderId = $project->getRootObjectId();

		$rootFolder = new Folder( $rootFolderId );
		$rootFolder->load();

		if   ( ! $rootFolder->hasRight( Permission::ACL_PROP )  )
			throw new SecurityException();
	}

}