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
					'enable_cache' => false,
					'tmp_dir' => '',
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
					'_NO' => 'Norwegian',
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
					'defaults' =>
						[ 
							'prefix' => 'cms_',
							'suffix' => '',
							'enabled' => true,
							'name' => '',
							'description' => '',
							'type' => 'pdo',
							'driver' => 'mysql',
							'dsn' => '',
							'user' => '',
							'password' => '',
							'host' => 'localhost',
							'database' => '',
							'base64' => false,
							'persistent' => true,
							'charset' => 'UTF-8',
							'connection_sql' => '',
							'cmd' => '',
							'prepare' => true,
							'transaction' => true,
							'update' =>
								[ 
								],
							'auto_update' => true,
						],
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
							'replace' => 'EUR:&euro;',
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
					'available' => 'de,en,es,fr,it,ru,cn',
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
					'tree_width' => '25%',
					'file_separator' => ' &raquo',
					'nice_urls' => false,
					'url_sessionid' => false,
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
					'frames' =>
						[ 
							'top' => '_top',
						],
					'url' =>
						[ 
							'fake_url' => false,
							'index' => false,
							'url_format' => '%s,%s,%d.do',
							'add_sessionid' => false,
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
			'ldap' =>
				[ 
					'host' => 'localhost',
					'port' => '389',
					'protocol' => '2',
					'dn' => '',
					'search' =>
						[ 
							'anonymous' => true,
							'user' => 'uid=openrat,ou=users,dc=example,dc=com',
							'password' => 'verysecret',
							'basedn' => 'dc=example,dc=com',
							'filter' => '(uid={user})',
							'aliases' => true,
							'timeout' => 30,
							'add' => true,
						],
					'authorize' =>
						[ 
							'group_filter' => '(memberUid={dn})',
							'group_name' => 'cn',
							'auto_add' => true,
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
					'whitelist' => '',
					'blacklist' => '',
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
			'mime-types' =>
				[ 
					'ez' => 'application/andrew-inset',
					'csm' => 'application/cu-seeme',
					'cu' => 'application/cu-seeme',
					'tsp' => 'application/dsptype',
					'spl' => 'application/x-futuresplash ',
					'cpt' => 'image/x-corelphotopaint',
					'hqx' => 'application/mac-binhex40',
					'nb' => 'application/mathematica',
					'mdb' => 'application/msaccess',
					'doc' => 'application/msword',
					'dot' => 'application/msword',
					'bin' => 'application/octet-stream',
					'oda' => 'application/oda',
					'pdf' => 'application/pdf',
					'pgp' => 'application/pgp-signature',
					'ps' => 'application/postscript',
					'ai' => 'application/postscript',
					'eps' => 'application/postscript',
					'rtf' => 'text/rtf',
					'smi' => 'application/smil',
					'smil' => 'application/smil',
					'xls' => 'application/vnd.ms-excel',
					'xlb' => 'application/vnd.ms-excel',
					'ppt' => 'application/vnd.ms-powerpoint',
					'pps' => 'application/vnd.ms-powerpoint',
					'pot' => 'application/vnd.ms-powerpoint',
					'sdw' => 'application/vnd.stardivision.writer',
					'sgl' => 'application/vnd.stardivision.writer-global',
					'vor' => 'application/vnd.stardivision.writer',
					'sdc' => 'application/vnd.stardivision.calc',
					'sda' => 'application/vnd.stardivision.draw',
					'sdd' => 'application/vnd.stardivision.impress',
					'sdp' => 'application/vnd.stardivision.impress-packed',
					'smf' => 'application/vnd.stardivision.math',
					'sds' => 'application/vnd.stardivision.chart',
					'smd' => 'application/vnd.stardivision.mail',
					'wbxml' => 'application/vnd.wap.wbxml ',
					'wmlc' => 'application/vnd.wap.wmlc',
					'wmlsc' => 'application/vnd.wap.wmlscriptc',
					'wp5' => 'application/wordperfect5.1',
					'zip' => 'application/zip',
					'wk' => 'application/x-123',
					'bcpio' => 'application/x-bcpio',
					'vcd' => 'application/x-cdlink ',
					'pgn' => 'application/x-chess-pgn',
					'cpio' => 'application/x-cpio',
					'csh' => 'text/x-csh',
					'deb' => 'application/x-debian-package',
					'dcr' => 'application/x-director',
					'dir' => 'application/x-director',
					'dxr' => 'application/x-director',
					'wad' => 'application/x-doom',
					'dms' => 'application/x-dms',
					'dvi' => 'application/x-dvi',
					'pfa' => 'application/x-font',
					'pfb' => 'application/x-font',
					'gsf' => 'application/x-font',
					'pcf' => 'application/x-font',
					'gnumeric' => 'application/x-gnumeric',
					'gtar' => 'application/x-gtar',
					'tgz' => 'application/x-gtar',
					'taz' => 'application/x-gtar',
					'hdf' => 'application/x-hdf',
					'phtml' => 'text/html',
					'pht' => 'text/html',
					'php' => 'text/html',
					'phps' => 'text/html',
					'php3' => 'text/html',
					'php3p' => 'text/html ',
					'php4' => 'text/html',
					'docbook' => 'application/docbook+xml',
					'ica' => 'application/x-ica',
					'jar' => 'application/x-java-archive',
					'jnlp' => 'application/x-java-jnlp-file',
					'ser' => 'application/x-java-serialized-object',
					'class' => 'application/x-java-vm',
					'js' => 'application/x-javascript',
					'chrt' => 'application/x-kchart',
					'kil' => 'application/x-killustrator',
					'kpr' => 'application/x-kpresenter',
					'kpt' => 'application/x-kpresenter',
					'skp' => 'application/x-koan ',
					'skd' => 'application/x-koan ',
					'skt' => 'application/x-koan ',
					'skm' => 'application/x-koan ',
					'ksp' => 'application/x-kspread',
					'kwd' => 'application/x-kword',
					' kwt' => 'application/x-kword',
					'latex' => 'application/x-latex',
					'lha' => 'application/x-lha',
					'lzh' => 'application/x-lzh',
					'lzx' => 'application/x-lzx',
					'frm' => 'fbdocapplication/x-maker',
					'maker' => 'fbdocapplication/x-maker',
					'frame' => 'fbdocapplication/x-maker',
					'fm' => 'fbdocapplication/x-maker',
					'fb' => 'fbdocapplication/x-maker',
					'book' => 'fbdocapplication/x-maker',
					'mif' => 'application/x-mif',
					'com' => 'application/x-msdos-program',
					'exe' => 'application/x-msdos-program',
					'bat' => 'application/x-msdos-program',
					'dll' => 'application/x-msdos-program',
					'msi' => 'application/x-msi',
					'nc' => 'application/x-netcdf',
					'cdf' => 'application/x-netcdf',
					'pac' => 'application/x-ns-proxy-autoconfig',
					'o' => 'application/x-object',
					'ogg' => 'application/x-ogg',
					'oza' => 'application/x-oz-application',
					'pl' => 'application/x-perl',
					'pm' => 'application/x-perl',
					'crl' => 'application/x-pkcs7-crl',
					'rpm' => 'audio/x-pn-realaudio-plugin ',
					'shar' => 'application/x-shar',
					'swf' => 'application/x-shockwave-flash',
					'swfl' => 'application/x-shockwave-flash',
					'sh' => 'text/x-sh',
					'sit' => 'application/x-stuffit',
					'sv4cpio' => 'application/x-sv4cpio',
					'sv4crc' => 'application/x-sv4crc',
					'tar' => 'application/x-tar',
					'tcl' => 'text/x-tcl',
					'tex' => 'text/x-tex',
					'gf' => 'application/x-tex-gf',
					'pk' => 'application/x-tex-pk',
					'texinfo' => 'application/x-texinfo',
					'texi' => 'application/x-texinfo',
					'; "~"' => 'application/x-trash',
					';"%"' => 'application/x-trash',
					'bak' => 'application/x-trash',
					'old' => 'application/x-trash',
					'sik' => 'application/x-trash',
					't' => 'application/x-troff',
					'tr' => 'application/x-troff',
					'roff' => 'application/x-troff',
					'man' => 'application/x-troff-man',
					'me' => 'application/x-troff-me',
					'ms' => 'application/x-troff-ms',
					'ustar' => 'application/x-ustar',
					'src' => 'application/x-wais-source',
					'wz' => 'application/x-wingz',
					'crt' => 'application/x-x509-ca-cert',
					'fig' => 'application/x-xfig',
					'au' => 'audio/basic',
					'snd' => 'audio/basic',
					'mid' => 'audio/midi',
					'midi' => 'audio/midi',
					'kar' => 'audio/midi',
					'mpga' => 'audio/mpeg',
					'mpega' => 'audio/mpeg',
					'mp2' => 'audio/mpeg',
					'mp3' => 'audio/mpeg',
					'm3u' => 'audio/x-mpegurl',
					'sid' => 'audio/prs.sid',
					'aif' => 'audio/x-aiff',
					'aiff' => 'audio/x-aiff',
					'aifc' => 'audio/x-aiff',
					'gsm' => 'audio/x-gsm',
					'ra' => 'audio/x-realaudio ',
					'rm' => 'audio/x-pn-realaudio',
					'ram' => 'audio/x-pn-realaudio',
					'pls' => 'audio/x-scpls',
					'wav' => 'audio/x-wav',
					'pdb' => 'chemical/x-pdb',
					'xyz' => 'chemical/x-xyz ',
					'bmp' => 'image/x-ms-bmp',
					'gif' => 'image/gif',
					'ief' => 'image/ief',
					'jpeg' => 'image/jpeg',
					'jpg' => 'image/jpeg',
					'jpe' => 'image/jpeg',
					'pcx' => 'image/pcx',
					'png' => 'image/png',
					'svg' => 'image/svg+xml',
					'svgz' => 'image/svg+xml',
					'tiff' => 'image/tiff',
					'tif' => 'image/tiff',
					'wbmp' => 'image/vnd.wap.wbmp',
					'ras' => 'image/x-cmu-raster',
					'cdr' => 'image/x-coreldraw',
					'pat' => 'image/x-coreldrawpattern',
					'cdt' => 'image/x-coreldrawtemplate',
					'djvu' => 'image/x-djvu',
					'djv' => 'image/x-djvu',
					'jng' => 'image/x-jng',
					'pnm' => 'image/x-portable-anymap',
					'pbm' => 'image/x-portable-bitmap',
					'pgm' => 'image/x-portable-graymap',
					'ppm' => 'image/x-portable-pixmap',
					'rgb' => 'image/x-rgb',
					'xbm' => 'image/x-xbitmap',
					'xpm' => 'image/x-xpixmap',
					'xwd' => 'image/x-xwindowdump',
					'igs' => 'model/iges',
					'iges' => 'model/iges',
					'msh' => 'model/mesh',
					'mesh' => 'model/mesh',
					'silo' => 'model/mesh',
					'wrl' => 'x-world/x-vrml',
					'vrml' => 'x-world/x-vrml',
					'csv' => 'text/comma-separated-values',
					'css' => 'text/css',
					'htm' => 'text/html',
					'html' => 'text/html',
					'xhtml' => 'text/html',
					'mml' => 'text/mathml',
					'asc' => 'text/plain',
					'txt' => 'text/plain',
					'text' => 'text/plain',
					'diff' => 'text/plain',
					'rtx' => 'text/richtext',
					'tsv' => 'text/tab-separated-values',
					'wml' => 'text/vnd.wap.wml',
					'wmls' => 'text/vnd.wap.wmlscript',
					'xml' => 'text/xml',
					'xsl' => 'text/xml',
					'hpp' => 'text/x-c++hdr',
					'hxx' => 'text/x-c++hdr',
					'hh' => 'text/x-c++hdr',
					'cpp' => 'text/x-c++src',
					'cxx' => 'text/x-c++src',
					'cc' => 'text/x-c++src',
					'h' => 'text/x-chdr',
					'c' => 'text/x-csrc',
					'java' => 'text/x-java',
					'moc' => 'text/x-moc',
					'p' => 'text/x-pascal',
					'pas' => 'text/x-pascal',
					'etx' => 'text/x-setext',
					'tk' => 'text/x-tcl',
					'ltx' => 'text/x-tex',
					'sty' => 'text/x-tex',
					'cls' => 'text/x-tex',
					'vcs' => 'text/x-vcalendar',
					'vcf' => 'text/x-vcard',
					'dl' => 'video/dl',
					'fli' => 'video/fli',
					'gl' => 'video/gl',
					'mpeg' => 'video/mpeg',
					'mpg' => 'video/mpeg',
					'mpe' => 'video/mpeg',
					'qt' => 'video/quicktime',
					'mov' => 'video/quicktime',
					'mxu' => 'video/vnd.mpegurl',
					'mng' => 'video/x-mng',
					'asf' => 'video/x-ms-asf',
					'asx' => 'video/x-ms-asf',
					'avi' => 'video/x-msvideo',
					'movie' => 'video/x-sgi-movie',
					'ice' => 'x-conference/x-cooltalk',
					'vrm' => 'x-world/x-vrml',
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
					'' => '0',
					'euro' => 'EUR,&euro;',
					'copy' => '(c],&copy;',
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
							'samesite' => 'Strict',
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
									0 => 'Remember',
									1 => 'Guest',
									2 => 'SingleSignon',
								],
						],
					'preselect' =>
						[ 
							'modules' =>
								[ 
									0 => 'Ident',
									1 => 'SSL',
									2 => 'Cookie',
								],
						],
					'authenticate' =>
						[ 
							'modules' =>
								[ 
									0 => 'LdapUserDN',
									1 => 'Database',
									2 => 'Internal',
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
							'enable' => false,
							'add' => false,
							'logo_url' => 'http://openid.net/login-bg.gif',
							'trust_root' => '0',
							'trusted_server' => '0',
							'update_user' => true,
							'user_identity' => true,
							'provider' =>
								[ 
									'name' => 'google',
									'google' =>
										[ 
											'xrds_uri' => 'http://google.com/accounts/o8/id',
											'map_attribute' => 'email',
											'name' => 'Google',
											'map_internal' => 'mail',
										],
									'yahoo' =>
										[ 
											'xrds_uri' => 'http://??????',
											'map_attribute' => 'usename',
											'map_internal' => 'mail',
										],
								],
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
							'show_mail' => true,
							'send_message' => true,
						],
					'content-security-policy' => true,
				],
			'style-default' =>
				[ 
					'name' => 'Unnamed',
					'title_background_color' => 'grey',
					'title_text_color' => 'white',
					'text_color' => 'black',
					'background_color' => '#d9d9d9',
					'inactive_background_color' => 'silver',
				],
			'style' =>
				[ 
					'earlgrey' =>
						[ 
							'name' => 'Earl grey',
							'title_background_color' => 'grey',
							'title_text_color' => 'white',
							'text_color' => 'black',
							'background_color' => '#e9e9e9',
							'inactive_background_color' => 'silver',
						],
					'dracula' =>
						[ 
							'name' => 'Dracula',
							'title_background_color' => '#44475a',
							'title_text_color' => '#f8f8f2',
							'text_color' => '#f8f8f2',
							'background_color' => '#282a36',
							'inactive_background_color' => '#44475a',
						],
					'modern' =>
						[ 
							'name' => 'Blue sky',
							'title_background_color' => '#3F6194',
							'title_text_color' => 'white',
							'text_color' => 'black',
							'background_color' => '#F3F3F3',
							'inactive_background_color' => '#CCCCCC',
						],
					'moorweide' =>
						[ 
							'name' => 'Moorweide',
							'title_background_color' => '#edf7f2',
							'title_text_color' => '#005f52',
							'text_color' => 'black',
							'background_color' => 'white',
							'inactive_background_color' => '#edf7f2',
						],
					'dark' =>
						[ 
							'name' => 'Dark',
							'title_background_color' => '#565655',
							'title_text_color' => '#DCDCDC',
							'text_color' => '#FFFFFF',
							'background_color' => '#201F1D',
							'inactive_background_color' => '#868685',
						],
				],
			'theme' =>
				[ 
					'compiler' =>
						[ 
							'enable' => true,
							'cache' => true,
							'chmod' => '',
							'compile_at_logout' => false,
						],
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