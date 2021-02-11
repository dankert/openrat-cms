<?php
// DO NOT MAKE ANY CHANGES IN THIS FILE, please edit the file 'config.yml' or 'config-<host>.yml' instead.
// This file should only be changed by developers.

namespace cms\base;

/**
 * Default configuration.
 */
class DefaultConfig {

	/**
	 * Gets the default configuration.
	 * @return array
	 */
	public static function get()
	{
		return 
		[ 
			'applications' =>
				[ 
					'phpmyadmin' =>
						[ 
							'name' => 'PHPYourAdmin',
							'url' => 'https://example.com/anotherapplication/index.cgi',
							'param' => 'ticketidforopenrat',
							'group' => '0',
							'description' => 'Your database administration',
						],
				],
			'cache' =>
				[ 
					'conditional_get' => true,
					'enable_cache'    => false,
					'tmp_dir'         => '',
				],
			'config' =>
				[ 
					'auto_reload' => true,
					'session_destroy_on_config_reload' => true,
				],
			'content' =>
				[ 
					'file' =>
						[ 
							'max_file_size' => '1500',
						],
					'revision-limit' =>
						[ 
							'enabled' => false,
							'max-age' => 120,
							'min-age' => 1,
							'max-revisions' => 100,
							'min-revisions' => 3,
						],
					'language' =>
						[ 
							'use_default_language' => true,
						],
				],
			'countries' =>
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
				],
			'database' =>
				[ 
				],
			'database-default' =>
				[ 
					'default-id' => '',
				],
			'date' =>
				[ 
					'format' =>
						[ 
							'SHORT' => '',
							'ISO8601SHORT' => 'Ymd',
							'ISO8601' => 'Y-m-d',
							'ISO8601BAS' => 'YmdTHis',
							'ISO8601EXT' => 'Y-m-dTH:i:s',
							'ISO8601FULL' => 'Y-m-dTH:i:sO',
							'ISO8601WEEK' => 'YWW',
							'GER1' => 'd.m.Y',
							'GER2' => 'd.m.Y, H:i',
							'GER3' => 'd.m.Y, H:i:s',
							'GER4' => 'd. F Y, H:i:s',
							'ENGLONG' => 'l dS of F Y h:i:s A',
							'GMDATE' => 'D, d M Y H:i:s GMT',
							'RFC822' => 'r',
							'UNIX' => 'U',
							'LONG' => 'F j, Y, g:i a',
						],
					'timezone' =>
						[ 
							-6 => 'New York',
							0 => 'UTC (GMT)',
							60 => 'MET (Middle European Time)',
							120 => 'MEST (Middle European Summertime)',
						],
				],
			'editor' =>
				[ 
					'text-markup' =>
						[ 
							'strong-begin' => '*',
							'strong-end' => '*',
							'emphatic-begin' => '_',
							'emphatic-end' => '_',
							'image-begin' => '{',
							'image-end' => '}',
							'speech-begin' => 'QUOTE',
							'speech-end' => 'QUOTE',
							'code-begin' => '=',
							'code-end' => '=',
							'footnote-begin' => '[',
							'footnote-end' => ']',
							'pre-begin' => '=',
							'pre-end' => '=',
							'insert-begin' => '++',
							'insert-end' => '++',
							'remove-begin' => '--',
							'remove-end' => '--',
							'definition-sep' => '::',
							'headline' => '+',
							'headline_level1_underline' => '=',
							'headline_level2_underline' => '-',
							'headline_level3_underline' => '.',
							'list-unnumbered' => '-',
							'list-numbered' => '#',
							'table-of-content' => '##TOC##',
							'linkto' => '->',
							'table-cell-sep' => '|',
							'style-begin' => '\'',
							'style-end' => '\'',
							'quote' => '>',
							'quote-line-begin' => '>',
							'quote-line-end' => '>',
							'macro-begin' => '<<',
							'macro-end' => '>>',
							'macro-attribute-quote' => '\'',
							'macro-attribute-value-seperator' => '=',
						],
					'html' =>
						[ 
							'tag_strong' => 'strong',
							'tag_emphatic' => 'em',
							'tag_teletype' => 'tt',
							'tag_speech' => 'cite',
							'override_speech' => false,
							'override_speech_open' => '&laquo;',
							'override_speech_close' => '&raquo;',
							'rendermode' => 'xml',
							'replace' => ['EUR:&euro;'],
						],
					'wiki' =>
						[ 
							'convert_html' => true,
							'convert_bbcode' => true,
						],
					'text' =>
						[ 
							'linelength' => '70',
						],
					'calendar' =>
						[ 
							'weekday_offset' => '1',
						],
					'macro' =>
						[ 
							'show_errors' => false,
						],
				],
			'filename' =>
				[ 
					'edit' => true,
					'default' => 'index',
					'style' => 'short',
					'url' => 'relative',
				],
			'ftp' =>
				[ 
					'ascii' => 'html,htm,php',
				],
			'help' =>
				[ 
					'enabled' => true,
					'url' => 'http://help.openrat.de/',
					'suffix' => '.html',
				],
			'html' =>
				[ 
					'tag_teletype' => 'tt',
					'tag_emphatic' => 'em',
					'tag_strong' => 'strong',
					'tag_speech' => 'cite',
					'speech_open' => '&bdquo',
					'speech_close' => '&rdquo',
				],
			'i18n' =>
				[ 
					'use_http' => true,
					'default' => 'de',
					'available' => ['de','en','es','fr','it','ru','cn'],
					'locale' =>
						[ 
							'de' => 'de_DE.utf8',
							'en' => 'en_US.utf8',
						],
				],
			'image' =>
				[ 
					'truecolor' => true,
				],
			'interface' =>
				[ 
					'theme' => 'default',
					'timeout' => '0',
					'override_title' => '',
					'style' =>
						[ 
							'default' => 'modern',
						],
					'config' =>
						[ 
							'file_manager_url' => '',
							'enable' => true,
							'show_system' => true,
							'show_interpreter' => true,
							'show_extensions' => true,
						],
					'gravatar' =>
						[ 
							'enable' => true,
							'size' => '80',
							'default' => '404',
							'rating' => 'g',
						],
					'session' =>
						[ 
							'auto_extend' => true,
						],
				],
			'login' =>
				[ 
					'motd' => '',
					'nologin' => false,
					'register' => false,
					'send_password' => false,
					'gpl' =>
						[ 
							'url' => 'http://www.gnu.org/licenses/old-licenses/gpl-2.0.html',
						],
					'logo' =>
						[ 
							'enabled' => false,
							'image' => './modules/cms-ui/themes/default/images/logo.jpg',
							'url' => 'http://www.openrat.de',
						],
					'start' =>
						[ 
							'start_lastchanged_object' => true,
							'start_single_project' => true,
						],
				],
			'log' =>
				[ 
					'file' => NULL,
					'level' => 'warn',
					'output' => 'plain',
					'date_format' => 'M j H:i:s',
					'ns_lookup' => false,
					'format' =>
						[ 
							'time',
							'level',
							'host',
							'user',
							'action',
							'text',
						],
				],
			'mail' =>
				[ 
					'enabled' => true,
					'from' => 'OpenRat <user@example.com>',
					'signature' => '',
					'cc' => '0',
					'bcc' => '0',
					'priority' => '3',
					'header_encoding' => 'Quoted-printable',
					'client' => 'php',
					'whitelist' => [],
					'blacklist' => [],
					'smtp' =>
						[ 
							'host' => 'locahost',
							'port' => '25',
							'auth_username' => 'your.user@something.example',
							'auth_password' => 'notsecret',
							'timeout' => '45',
							'localhost' => 'your.fully.qualified.hostname.example',
							'tls' => false,
							'ssl' => false,
						],
				],
			'publish' =>
				[
					'edit' => true,
					'default' => 'index',
					'format' => '{filename}{language_sep}{language}{type_sep}{type}',
					'language_sep' => '.',
					'type_sep' => '.',
					'filename_language' => 'auto',
					'filename_type' => 'always',
					'style' => 'id',
					'url' => 'relative',
					'enable_php_in_page_content' => false,
					'enable_php_in_file_content' => false,
					'escape_8bit_characters' => false,
					'encode_utf8_in_html' => true,
					'negotiation' =>
						[ 
							'page_negotiate_type' => true,
							'page_negotiate_language' => true,
							'file_negotiate_type' => true,
						],
					'filesystem' =>
						[ 
							'per_project' => true,
							'directory' => '/var/www/',
						],
					'command' =>
						[ 
							'per_project' => true,
							'enable' => false,
							'command' => '',
						],
					'ftp' =>
						[ 
							'enable' => true,
							'per_project' => true,
							'port' => '21',
							'host' => '',
							'path' => '',
							'user' => 'anonymous',
							'pass' => 'mail@example.com',
						],
					'set_modification_date' => true,
				],
			'replace' =>
				[ 
					'euro' => 'EUR,&euro;',
					'copy' => '(c),&copy;',
				],
			'search' =>
				[ 
					'minlength' => 3,
					'quicksearch' =>
						[ 
							'flag' =>
								[ 
									'id' => true,
									'name' => true,
									'filename' => true,
									'description' => true,
									'content' => false,
								],
						],
				],
			'security' =>
				[ 
					'cookie' =>
						[ 
							'secure' => false,
							'httponly' => true,
							'samesite' => 'Lax',
							'expire' => 720,
						],
					'readonly' => false,
					'nopublish' => false,
					'umask' => '0',
					'chmod' => '0',
					'chmod_dir' => '0',
					'' => '0',
					'disable_dynamic_code' => true,
					'show_system_info' => true,
					'use_post_token' => true,
					'default' =>
						[ 
							'username' => '',
							'password' => '',
						],
					'guest' =>
						[ 
							'enable' => false,
							'user' => 'guest',
						],
					'login' =>
						[ 
							'type' => 'form',
						],
					'auth' =>
						[ 
							'type' => 'database',
							'userdn' => false,
						],
					'authorize' =>
						[ 
							'type' => 'ldap',
						],
					'autologin' =>
						[ 
							'modules' =>
								[ 
									'Remember',
									'Guest',
									'SingleSignon',
								],
						],
					'preselect' =>
						[ 
							'modules' =>
								[ 
									'Ident',
									'SSL',
									'Cookie',
									'DefaultUser'
								],
						],
					'authenticate' =>
						[ 
							'modules' =>
								[ 
									'Database',
									'Internal'
								],
						],
					'newuser' =>
						[ 
							'autoadd' => true,
							'autogroups' => '',
						],
					'password' =>
						[ 
							'random_length' => 10,
							'min_length' => 6,
							'pepper' => '',
							'deny_after_expiration_duration' => 72,
							'force_change_if_cleartext' => false,
						],
					'http' =>
						[ 
							'url' => 'http://example.net/restricted-area',
						],
					'authdb' =>
						[ 
							'enable' => false,
							'type' => 'postgresql',
							'user' => 'dbuser',
							'password' => 'dbpassword',
							'host' => '127.0.0.1',
							'database' => 'dbname',
							'persistent' => false,
							'prepare' => false,
							'sql' => 'select 1 from table where user={username} and password={password}',
							'hash_algo' => 'md5',
							'add' => true,
						],
					'ssl' =>
						[ 
							'trust' => false,
							'client_cert_dn_env' => 'SSL_CLIENT_S_DN_CN',
						],
					'openid' =>
						[
							// Google has discontinued OpenID support as of July 22nd 2015
						],
					'oidc' =>
						[
							// OpenID connect
							'enabled' => true,
							'provider' => [
								'google' => [
									'enabled' => false,
									'label' => 'Google',
									'url' => 'https://acounts.google.com',
									'client_id' => 'xyz',
									'client_secret' => 'mysecret'
								]

							],
							'add'=>true
						],
					'sso' =>
						[ 
							'enable' => false,
							'url' => 'https://www.example.com/phpmyadmin/main.php?server=1',
							'auth_param_name' => 'authid',
							'auth_param_serialized' => true,
							'cookie' => true,
							'cookie_name' => '0',
							'force' => true,
							'expect' => '0',
							'expect_regexp' => '/running on/',
							'username_regexp' => '/running on localhost as ([a-z]+)@localhost/',
						],
					'user' =>
						[ 
							'show_admin_mail' => true,
							'show_mail'    => false,
							'send_message' => true,
						],
					'content-security-policy' => true,
				],
			'style' =>
				[ 
					'earlgrey' =>
						[ 
							'name' => 'Earl grey',
							'main_title_background_color' => 'grey',
							'main_title_text_color' => 'white',
							'text_color' => 'black',
							'background_color' => '#e9e9e9',
							'inactive_background_color' => 'silver',
						],
					'dracula' =>
						[ 
							'name' => 'Dracula',
							'main_title_background_color' => '#44475a',
							'main_title_text_color' => '#f8f8f2',
							'text_color' => '#f8f8f2',
							'background_color' => '#282a36',
							'inactive_background_color' => '#44475a',
							'image_color' => 'orange',
						],
					'modern' =>
						[ 
							'name' => 'Blue sky',
							'main_title_background_color' => '#3F6194',
							'main_title_text_color' => 'white',
							'nav_title_background_color' => '#79afd9',
							'nav_background_color' => '#e1effa',
							'text_color' => 'black',
							'background_color' => '#F3F3F3',
							'inactive_background_color' => '#CCCCCC',
						],
					'moorweide' =>
						[ 
							'name' => 'Moorweide',
							'main_title_background_color' => '#edf7f2',
							'main_title_text_color' => '#005f52',
							'text_color' => 'black',
							'background_color' => '#edf7f2',
							'inactive_background_color' => 'white',
						],
					'dark' =>
						[ 
							'name' => 'Dark',
							'main_title_background_color' => '#565655',
							'main_title_text_color' => '#DCDCDC',
							'text_color' => '#FFFFFF',
							'background_color' => '#201F1D',
							'inactive_background_color' => '#868685',
						],
					'mono' =>
						[
							'name' => 'Monochrome',
							'text_color' => 'black',
							'background_color' => 'white',
						],
				],
			'theme' =>
				[ 
					'favicon' => 'modules/cms/ui/themes/default/images/openrat-logo.ico',
				],
			'wiki' =>
				[ 
					'convert_html' => true,
					'convert_bbcode' => true,
					'tag_strong' => '*',
					'tag_emphatic' => '_',
				],
			'application' =>
				[ 
					'name' => Startup::TITLE,
					'version' => Startup::VERSION,
					'operator' => '',
				],
			'production' => true,
			'ui' =>
				[ 
					'keybinding' =>
						[ 
							'method' =>
								[ 
									'prop' => 'F4',
									'add' => 'F1',
									'pub' => 'F8',
									'archive' => '',
									'rights' => '',
								],
							'action' =>
								[ 
									'profile' => 'ALT+P',
								],
						],
				],
		];
	}
}