<?php
// DO NOT MAKE ANY CHANGES IN THIS FILE, please edit the file 'config.ini.php' or 'config-<host>.ini.php' instead.
// This file should only be changed by developers. 
$conf = array();
$conf['applications'] = array();
$conf['applications']['']=0;
$conf['applications']['phpmyadmin'] = array();
$conf['applications']['phpmyadmin']['name']='PHPYourAdmin';
$conf['applications']['phpmyadmin']['url']="https://example.com/anotherapplication/index.cgi";
$conf['applications']['phpmyadmin']['param']="ticketidforopenrat";
$conf['applications']['phpmyadmin']['group']='0';
$conf['applications']['phpmyadmin']['description']="Your database administration";
$conf['cache'] = array();
$conf['cache']['conditional_get']='true';
$conf['cache']['enable_cache']=false;
$conf['cache']['tmp_dir']="";
$conf['config'] = array();
$conf['config']['auto_reload']= true;
$conf['config']['session_destroy_on_config_reload']= true;
$conf['content'] = array();
$conf['content']['file'] = array();
$conf['content']['file']['max_file_size']='1500';
$conf['content']['revision-limit'] = array();
$conf['content']['revision-limit']['enabled']= false;
$conf['content']['revision-limit']['max-age']= 120;
$conf['content']['revision-limit']['min-age']= 1;
$conf['content']['revision-limit']['max-revisions']= 100;
$conf['content']['revision-limit']['min-revisions']= 3;
$conf['content']['language'] = array();
$conf['content']['language']['use_default_language']= true;
$conf['countries'] = array();
$conf['countries']['']='0';
$conf['countries']['AA']='Afar';
$conf['countries']['AB']='Abkhazian';
$conf['countries']['AF']='Afrikaans';
$conf['countries']['AM']='Amharic';
$conf['countries']['AR']='Arabic';
$conf['countries']['AS']='Assamese';
$conf['countries']['AY']='Aymara';
$conf['countries']['AZ']='Azerbaijani';
$conf['countries']['BA']='Bashkir';
$conf['countries']['BE']='Byelorussian';
$conf['countries']['BG']='Bulgarian';
$conf['countries']['BH']='Bihari';
$conf['countries']['BI']='Bislama';
$conf['countries']['BN']='Bengali';
$conf['countries']['BO']='Tibetan';
$conf['countries']['BR']='Breton';
$conf['countries']['CA']='Catalan';
$conf['countries']['CO']='Corsican';
$conf['countries']['CS']='Czech';
$conf['countries']['CY']='Welsh';
$conf['countries']['DA']='Danish';
$conf['countries']['DE']='German';
$conf['countries']['DZ']='Bhutani';
$conf['countries']['EL']='Greek';
$conf['countries']['EN']='English';
$conf['countries']['EO']='Esperanto';
$conf['countries']['ES']='Spanish';
$conf['countries']['ET']='Estonian';
$conf['countries']['EU']='Basque';
$conf['countries']['FA']='Persian';
$conf['countries']['FI']='Finnish';
$conf['countries']['FJ']='Fiji';
$conf['countries']['FO']='Faeroese';
$conf['countries']['FR']='French';
$conf['countries']['FY']='Frisian';
$conf['countries']['GA']='Irish';
$conf['countries']['GD']='Gaelic';
$conf['countries']['GL']='Galician';
$conf['countries']['GN']='Guarani';
$conf['countries']['GU']='Gujarati';
$conf['countries']['HA']='Hausa';
$conf['countries']['HI']='Hindi';
$conf['countries']['HR']='Croatian';
$conf['countries']['HU']='Hungarian';
$conf['countries']['HY']='Armenian';
$conf['countries']['IA']='Interlingua';
$conf['countries']['IE']='Interlingue';
$conf['countries']['IK']='Inupiak';
$conf['countries']['IN']='Indonesian';
$conf['countries']['IS']='Icelandic';
$conf['countries']['IT']='Italian';
$conf['countries']['IW']='Hebrew';
$conf['countries']['JA']='Japanese';
$conf['countries']['JI']='Yiddish';
$conf['countries']['JW']='Javanese';
$conf['countries']['KA']='Georgian';
$conf['countries']['KK']='Kazakh';
$conf['countries']['KL']='Greenlandic';
$conf['countries']['KM']='Cambodian';
$conf['countries']['KN']='Kannada';
$conf['countries']['KO']='Korean';
$conf['countries']['KS']='Kashmiri';
$conf['countries']['KU']='Kurdish';
$conf['countries']['KY']='Kirghiz';
$conf['countries']['LA']='Latin';
$conf['countries']['LN']='Lingala';
$conf['countries']['LO']='Laothian';
$conf['countries']['LT']='Lithuanian';
$conf['countries']['LV']='Latvian';
$conf['countries']['MG']='Malagasy';
$conf['countries']['MI']='Maori';
$conf['countries']['MK']='Macedonian';
$conf['countries']['ML']='Malayalam';
$conf['countries']['MN']='Mongolian';
$conf['countries']['MO']='Moldavian';
$conf['countries']['MR']='Marathi';
$conf['countries']['MS']='Malay';
$conf['countries']['MT']='Maltese';
$conf['countries']['MY']='Burmese';
$conf['countries']['NA']='Nauru';
$conf['countries']['NE']='Nepali';
$conf['countries']['NL']='Dutch';
$conf['countries']['_NO']='Norwegian';
$conf['countries']['OC']='Occitan';
$conf['countries']['OM']='Oromo';
$conf['countries']['OR']='Oriya';
$conf['countries']['PA']='Punjabi';
$conf['countries']['PL']='Polish';
$conf['countries']['PS']='Pashto';
$conf['countries']['PT']='Portuguese';
$conf['countries']['QU']='Quechua';
$conf['countries']['RM']='Rhaeto-Romance';
$conf['countries']['RN']='Kirundi';
$conf['countries']['RO']='Romanian';
$conf['countries']['RU']='Russian';
$conf['countries']['RW']='Kinyarwanda';
$conf['countries']['SA']='Sanskrit';
$conf['countries']['SD']='Sindhi';
$conf['countries']['SG']='Sangro';
$conf['countries']['SH']='Serbo-Croatian';
$conf['countries']['SI']='Singhalese';
$conf['countries']['SK']='Slovak';
$conf['countries']['SL']='Slovenian';
$conf['countries']['SM']='Samoan';
$conf['countries']['SN']='Shona';
$conf['countries']['SO']='Somali';
$conf['countries']['SQ']='Albanian';
$conf['countries']['SR']='Serbian';
$conf['countries']['SS']='Siswati';
$conf['countries']['ST']='Sesotho';
$conf['countries']['SU']='Sudanese';
$conf['countries']['SV']='Swedish';
$conf['countries']['SW']='Swahili';
$conf['countries']['TA']='Tamil';
$conf['countries']['TE']='Tegulu';
$conf['countries']['TG']='Tajik';
$conf['countries']['TH']='Thai';
$conf['countries']['TI']='Tigrinya';
$conf['countries']['TK']='Turkmen';
$conf['countries']['TL']='Tagalog';
$conf['countries']['TN']='Setswana';
$conf['countries']['TO']='Tonga';
$conf['countries']['TR']='Turkish';
$conf['countries']['TS']='Tsonga';
$conf['countries']['TT']='Tatar';
$conf['countries']['TW']='Twi';
$conf['countries']['UK']='Ukrainian';
$conf['countries']['UR']='Urdu';
$conf['countries']['UZ']='Uzbek';
$conf['countries']['VI']='Vietnamese';
$conf['countries']['VO']='Volapuk';
$conf['countries']['WO']='Wolof';
$conf['countries']['XH']='Xhosa';
$conf['countries']['YO']='Yoruba';
$conf['countries']['ZH']='Chinese';
$conf['database'] = array();
$conf['database']['default']='sample_db_mysql';
$conf['database']['sample_db_mysql'] = array();
$conf['database']['sample_db_mysql']['enabled']=false;
$conf['database']['sample_db_mysql']['comment']= "DB MySQL"            ;
$conf['database']['sample_db_mysql']['type']='mysql                 ';
$conf['database']['sample_db_mysql']['user']='dbuser                ';
$conf['database']['sample_db_mysql']['password']='dbpass                ';
$conf['database']['sample_db_mysql']['host']='localhost             ';
$conf['database']['sample_db_mysql']='port                              ';
$conf['database']['sample_db_mysql']['database']='cms                   ';
$conf['database']['sample_db_mysql']['base64']=false;
$conf['database']['sample_db_mysql']['prefix']= 'or_'                   ;
$conf['database']['sample_db_mysql']['persistent']='yes                   ';
$conf['database']['sample_db_mysql']['charset']= 'UTF-8';
$conf['database']['sample_db_mysql']['connection_sql']= "";
$conf['database']['sample_db_mysql']['cmd']= "";
$conf['database']['sample_db_mysql']['prepare']=false;
$conf['database']['sample_db_mysql']['transaction']=false;
$conf['database']['sample_db_mysql']['readonly']=false;
$conf['date'] = array();
$conf['date']['format'] = array();
$conf['date']['format']['SHORT']= "";
$conf['date']['format']['ISO8601SHORT']= "Ymd";
$conf['date']['format']['ISO8601']= "Y-m-d";
$conf['date']['format']['ISO8601BAS']= "YmdTHis";
$conf['date']['format']['ISO8601EXT']= "Y-m-dTH:i:s";
$conf['date']['format']['ISO8601FULL']= "Y-m-dTH:i:sO";
$conf['date']['format']['ISO8601WEEK']= "YWW";
$conf['date']['format']['GER1']= "d.m.Y";
$conf['date']['format']['GER2']= "d.m.Y, H:i";
$conf['date']['format']['GER3']= "d.m.Y, H:i:s";
$conf['date']['format']['GER4']= "d. F Y, H:i:s";
$conf['date']['format']['ENGLONG']= "l dS of F Y h:i:s A";
$conf['date']['format']['GMDATE']= "D, d M Y H:i:s GMT";
$conf['date']['format']['RFC822']= "r";
$conf['date']['format']['UNIX']= "U";
$conf['date']['format']['LONG']= "F j, Y, g:i a";
$conf['date']['timezone'] = array();
$conf['date']['timezone']['-6']="New York";
$conf['date']['timezone']['0']="UTC (GMT)";
$conf['date']['timezone']['60']="MET (Middle European Time)";
$conf['date']['timezone']['120']="MEST (Middle European Summertime)";
$conf['editor'] = array();
$conf['editor']['text-markup'] = array();
$conf['editor']['text-markup']['strong-begin']= "*";
$conf['editor']['text-markup']['strong-end']= "*";
$conf['editor']['text-markup']['emphatic-begin']= "_";
$conf['editor']['text-markup']['emphatic-end']= "_";
$conf['editor']['text-markup']['image-begin']= "{";
$conf['editor']['text-markup']['image-end']= "}";
$conf['editor']['text-markup']['speech-begin']='QUOTE';
$conf['editor']['text-markup']['speech-end']='QUOTE';
$conf['editor']['text-markup']['code-begin']= "=";
$conf['editor']['text-markup']['code-end']= "=";
$conf['editor']['text-markup']['footnote-begin']= "[";
$conf['editor']['text-markup']['footnote-end']= "]";
$conf['editor']['text-markup']['pre-begin']= "=";
$conf['editor']['text-markup']['pre-end']= "=";
$conf['editor']['text-markup']['insert-begin']= "++";
$conf['editor']['text-markup']['insert-end']= "++";
$conf['editor']['text-markup']['remove-begin']= "--";
$conf['editor']['text-markup']['remove-end']= "--";
$conf['editor']['text-markup']['definition-sep']= "::";
$conf['editor']['text-markup']['headline']= "+";
$conf['editor']['text-markup']['headline_level1_underline']= "=";
$conf['editor']['text-markup']['headline_level2_underline']= "-";
$conf['editor']['text-markup']['headline_level3_underline']= ".";
$conf['editor']['text-markup']['list-unnumbered']= "-";
$conf['editor']['text-markup']['list-numbered']= "#";
$conf['editor']['text-markup']['table-of-content']= "##TOC##";
$conf['editor']['text-markup']['linkto']= "->";
$conf['editor']['text-markup']['table-cell-sep']= "|";
$conf['editor']['text-markup']['style-begin']= "'";
$conf['editor']['text-markup']['style-end']= "'";
$conf['editor']['text-markup']['quote']= ">";
$conf['editor']['text-markup']['quote-line-begin']= ">";
$conf['editor']['text-markup']['quote-line-end']= ">";
$conf['editor']['text-markup']['macro-begin']= "<<";
$conf['editor']['text-markup']['macro-end']= ">>";
$conf['editor']['text-markup']['macro-attribute-quote']= "'";
$conf['editor']['text-markup']['macro-attribute-value-seperator']= "=";
$conf['editor']['html'] = array();
$conf['editor']['html']['tag_strong']= "strong";
$conf['editor']['html']['tag_emphatic']= "em";
$conf['editor']['html']['tag_teletype']= "tt";
$conf['editor']['html']['tag_speech']= "cite";
$conf['editor']['html']['override_speech']=false;
$conf['editor']['html']['override_speech_open']= "&laquo;";
$conf['editor']['html']['override_speech_close']= "&raquo;";
$conf['editor']['html']['rendermode']="sgml";
$conf['editor']['html']['rendermode']="xml";
$conf['editor']['html']['replace']= "EUR:&euro;";
$conf['editor']['wiki'] = array();
$conf['editor']['wiki']['convert_html']=true;
$conf['editor']['wiki']['convert_bbcode']=true;
$conf['editor']['text'] = array();
$conf['editor']['text']['linelength']='70';
$conf['editor']['calendar'] = array();
$conf['editor']['calendar']['weekday_offset']='1';
$conf['editor']['text'] = array();
$conf['editor']['text']['linelength']='70';
$conf['editor']['macro'] = array();
$conf['editor']['macro']['show_errors']=false;
$conf['filename'] = array();
$conf['filename']['edit']=true;
$conf['filename']['default']='index';
$conf['filename']['style']='short';
$conf['filename']['url']='relative';
$conf['ftp'] = array();
$conf['ftp']['ascii']= "html,htm,php";
$conf['help'] = array();
$conf['help']['enabled']=true;
$conf['help']['url']="http://help.openrat.de/";
$conf['help']['suffix']=".html";
$conf['html'] = array();
$conf['html']['tag_teletype']='tt';
$conf['html']['tag_emphatic']='em';
$conf['html']['tag_strong']='strong';
$conf['html']['tag_speech']='cite';
$conf['html']['speech_open']= "&bdquo";
$conf['html']['speech_close']= "&rdquo";
$conf['i18n'] = array();
$conf['i18n']['use_http']=true;
$conf['i18n']['default']='de';
$conf['i18n']['available']='de,en,es,fr,it,ru,cn';
$conf['i18n']['locale'] = array();
$conf['i18n']['locale']['de']="de_DE.utf8";
$conf['i18n']['locale']['en']="en_US.utf8";
$conf['image'] = array();
$conf['image']['truecolor']=true;
$conf['interface'] = array();
$conf['interface']['tree_width']= "25%";
$conf['interface']['file_separator']= " &raquo";
$conf['interface']['nice_urls']=false;
$conf['interface']['url_sessionid']=false;
$conf['interface']['theme']= 'default';
$conf['interface']['timeout']='0';
$conf['interface']['override_title']='';
$conf['interface']['style'] = array();
$conf['interface']['style']['default']='modern';
$conf['interface']['config'] = array();
$conf['interface']['config']['file_manager_url']="";
$conf['interface']['config']['enable']=true;
$conf['interface']['config']['show_system']=true;
$conf['interface']['config']['show_interpreter']=true;
$conf['interface']['config']['show_extensions']=true;
$conf['interface']['frames'] = array();
$conf['interface']['frames']['top']='_top';
$conf['interface']['url'] = array();
$conf['interface']['url']['fake_url']=false;
$conf['interface']['url']['index']=false;
$conf['interface']['url']['url_format']= "%s,%s.%i";
$conf['interface']['url']['url_format']= "%s,%s,%d.do";
$conf['interface']['url']['add_sessionid']=false;
$conf['interface']['gravatar'] = array();
$conf['interface']['gravatar']['enable']=true;
$conf['interface']['gravatar']['size']='80';
$conf['interface']['gravatar']['default']='404';
$conf['interface']['gravatar']['rating']='g';
$conf['interface']['session'] = array();
$conf['interface']['session']['auto_extend']=false;
$conf['ldap'] = array();
$conf['ldap']['host']="localhost";
$conf['ldap']['port']="389";
$conf['ldap']['protocol']="2";
$conf['ldap']['dn']= "uid={user},ou=users,dc=example,dc=com";
$conf['ldap']['dn']= "";
$conf['ldap']['search'] = array();
$conf['ldap']['search']['anonymous']=true;
$conf['ldap']['search']['user']= "uid=openrat,ou=users,dc=example,dc=com";
$conf['ldap']['search']['password']= "verysecret";
$conf['ldap']['search']['basedn']= "dc=example,dc=com";
$conf['ldap']['search']['filter']= "(uid={user})";
$conf['ldap']['search']['aliases']=true;
$conf['ldap']['search']['timeout']= 30;
$conf['ldap']['search']['add']=true;
$conf['ldap']['authorize'] = array();
$conf['ldap']['authorize']['group_filter']="(memberUid={dn})";
$conf['ldap']['authorize']['group_name']="cn";
$conf['ldap']['authorize']['auto_add']=true;
$conf['login'] = array();
$conf['login']['motd']='';
$conf['login']['nologin']=false;
$conf['login']['register']=false;
$conf['login']['send_password']=false;
$conf['login']['gpl'] = array();
$conf['login']['gpl']['url']="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html";
$conf['login']['logo'] = array();
$conf['login']['logo']['file']="./themes/default/images/logo.jpg"  ;
$conf['login']['logo']['url']="http://www.openrat.de"              ;
$conf['login']['start'] = array();
$conf['login']['start']['start_lastchanged_object']=true;
$conf['login']['start']['start_single_project']=true;
$conf['log'] = array();
$conf['log']['file']= "";
$conf['log']['level']= "warn";
$conf['log']['date_format']= "M j H:i:s";
$conf['log']['dns_lookup']=false;
$conf['log']['format']= "%time %level %host %user %action %text";
$conf['mail'] = array();
$conf['mail']['enabled']=true;
$conf['mail']['from']="OpenRat <user@example.com>";
$conf['mail']['signature']="http://www.openrat.de";
$conf['mail']['cc']='0';
$conf['mail']['bcc']='0';
$conf['mail']['priority']='3';
$conf['mail']['header_encoding']="Quoted-printable";
$conf['mail']['client']='smtp';
$conf['mail']['client']='php';
$conf['mail']['whitelist']= "";
$conf['mail']['blacklist']= "";
$conf['mail']['smtp'] = array();
$conf['mail']['smtp']['host']="mail.yourdomain.example";
$conf['mail']['smtp']['host']="locahost";
$conf['mail']['smtp']['port']="25";
$conf['mail']['smtp']['auth_username']="your.user@something.example";
$conf['mail']['smtp']['auth_password']="notsecret";
$conf['mail']['smtp']['timeout']="45";
$conf['mail']['smtp']['localhost']='0';
$conf['mail']['smtp']['localhost']="your.fully.qualified.hostname.example";
$conf['mail']['smtp']['tls']=false;
$conf['mail']['smtp']['ssl']=false;

$conf['mime-types'] = array();
$conf['mime-types']['ez']    = 'application/andrew-inset';
$conf['mime-types']['csm']   = 'application/cu-seeme';
$conf['mime-types']['cu']    = 'application/cu-seeme';
$conf['mime-types']['tsp']   = 'application/dsptype';
$conf['mime-types']['spl']   = 'application/futuresplash';
$conf['mime-types']['cpt']   = 'application/mac-compactpro';
$conf['mime-types']['hqx']   = 'application/mac-binhex40';
$conf['mime-types']['nb']    = 'application/mathematica';
$conf['mime-types']['mdb']   = 'application/msaccess';
$conf['mime-types']['doc']   = 'application/msword';
$conf['mime-types']['dot']   = 'application/msword';
$conf['mime-types']['bin']   = 'application/octet-stream';
$conf['mime-types']['oda']   = 'application/oda';
$conf['mime-types']['pdf']   = 'application/pdf';
$conf['mime-types']['pgp']   = 'application/pgp-signature';
$conf['mime-types']['ps']    = 'application/postscript';
$conf['mime-types']['ai']    = 'application/postscript';
$conf['mime-types']['eps']   = 'application/postscript';
$conf['mime-types']['rtf']   = 'application/rtf';
$conf['mime-types']['smi']   = 'application/smil';
$conf['mime-types']['smil']  = 'application/smil';
$conf['mime-types']['xls']   = 'application/vnd.ms-excel';
$conf['mime-types']['xlb']   = 'application/vnd.ms-excel';
$conf['mime-types']['ppt']   = 'application/vnd.ms-powerpoint';
$conf['mime-types']['pps']   = 'application/vnd.ms-powerpoint';
$conf['mime-types']['pot']   = 'application/vnd.ms-powerpoint';
$conf['mime-types']['sdw']   = 'application/vnd.stardivision.writer';
$conf['mime-types']['sgl']   = 'application/vnd.stardivision.writer-global';
$conf['mime-types']['vor']   = 'application/vnd.stardivision.writer';
$conf['mime-types']['sdc']   = 'application/vnd.stardivision.calc';
$conf['mime-types']['sda']   = 'application/vnd.stardivision.draw';
$conf['mime-types']['sdd']   = 'application/vnd.stardivision.impress';
$conf['mime-types']['sdp']   = 'application/vnd.stardivision.impress-packed';
$conf['mime-types']['smf']   = 'application/vnd.stardivision.math';
$conf['mime-types']['sds']   = 'application/vnd.stardivision.chart';
$conf['mime-types']['smd']   = 'application/vnd.stardivision.mail';
$conf['mime-types']['wbxml'] = 'application/vnd.wap.wbxml ';
$conf['mime-types']['wmlc']  = 'application/vnd.wap.wmlc';
$conf['mime-types']['wmlsc'] = 'application/vnd.wap.wmlscriptc';
$conf['mime-types']['wp5']   = 'application/wordperfect5.1';
$conf['mime-types']['zip']   = 'application/zip';
$conf['mime-types']['wk']    = 'application/x-123';
$conf['mime-types']['bcpio'] = 'application/x-bcpio';
$conf['mime-types']['vcd']   = 'application/x-cdlink ';
$conf['mime-types']['pgn']   = 'application/x-chess-pgn';
$conf['mime-types']['cpio']  = 'application/x-cpio';
$conf['mime-types']['csh']   = 'application/x-csh';
$conf['mime-types']['deb']   = 'application/x-debian-package';
$conf['mime-types']['dcr']   = 'application/x-director';
$conf['mime-types']['dir']   = 'application/x-director';
$conf['mime-types']['dxr']   = 'application/x-director';
$conf['mime-types']['wad']   = 'application/x-doom';
$conf['mime-types']['dms']   = 'application/x-dms';
$conf['mime-types']['dvi']   = 'application/x-dvi';
$conf['mime-types']['pfa']   = 'application/x-font';
$conf['mime-types']['pfb']   = 'application/x-font';
$conf['mime-types']['gsf']   = 'application/x-font';
$conf['mime-types']['pcf']   = 'application/x-font';
$conf['mime-types']['pcf.Z'] = 'application/x-font';
$conf['mime-types']['spl']   = 'application/x-futuresplash ';
$conf['mime-types']['gnumeric'] = 'application/x-gnumeric';
$conf['mime-types']['gtar']  = 'application/x-gtar';
$conf['mime-types']['tgz']   = 'application/x-gtar';
$conf['mime-types']['taz']   = 'application/x-gtar';
$conf['mime-types']['hdf']   = 'application/x-hdf';
$conf['mime-types']['phtml'] = 'text/html';
$conf['mime-types']['pht']   = 'text/html';
$conf['mime-types']['php']   = 'text/html';
$conf['mime-types']['phps']  = 'text/html';
$conf['mime-types']['php3']  = 'text/html';
$conf['mime-types']['php3p'] = 'text/html ';
$conf['mime-types']['php4']  = 'text/html';
$conf['mime-types']['docbook'] = 'application/docbook+xml';
$conf['mime-types']['ica']   = 'application/x-ica';
$conf['mime-types']['jar']   = 'application/x-java-archive';
$conf['mime-types']['jnlp']  = 'application/x-java-jnlp-file';
$conf['mime-types']['ser']   = 'application/x-java-serialized-object';
$conf['mime-types']['class'] = 'application/x-java-vm';
$conf['mime-types']['js']    = 'application/x-javascript';
$conf['mime-types']['chrt']  = 'application/x-kchart';
$conf['mime-types']['kil']   = 'application/x-killustrator';
$conf['mime-types']['kpr']   = 'application/x-kpresenter';
$conf['mime-types']['kpt']   = 'application/x-kpresenter';
$conf['mime-types']['skp']   = 'application/x-koan ';
$conf['mime-types']['skd']   = 'application/x-koan ';
$conf['mime-types']['skt']   = 'application/x-koan ';
$conf['mime-types']['skm']   = 'application/x-koan ';
$conf['mime-types']['ksp']   = 'application/x-kspread';
$conf['mime-types']['kwd']   = 'application/x-kword';
$conf['mime-types'][' kwt']  = 'application/x-kword';
$conf['mime-types']['latex'] = 'application/x-latex';
$conf['mime-types']['lha']   = 'application/x-lha';
$conf['mime-types']['lzh']   = 'application/x-lzh';
$conf['mime-types']['lzx']   = 'application/x-lzx';
$conf['mime-types']['frm']   = 'fbdocapplication/x-maker';
$conf['mime-types']['maker'] = 'fbdocapplication/x-maker';
$conf['mime-types']['frame'] = 'fbdocapplication/x-maker';
$conf['mime-types']['fm']    = 'fbdocapplication/x-maker';
$conf['mime-types']['fb']    = 'fbdocapplication/x-maker';
$conf['mime-types']['book']  = 'fbdocapplication/x-maker';
$conf['mime-types']['mif']   = 'application/x-mif';
$conf['mime-types']['com']   = 'application/x-msdos-program';
$conf['mime-types']['exe']   = 'application/x-msdos-program';
$conf['mime-types']['bat']   = 'application/x-msdos-program';
$conf['mime-types']['dll']   = 'application/x-msdos-program';
$conf['mime-types']['msi']   = 'application/x-msi';
$conf['mime-types']['nc']    = 'application/x-netcdf';
$conf['mime-types']['cdf']   = 'application/x-netcdf';
$conf['mime-types']['pac']   = 'application/x-ns-proxy-autoconfig';
$conf['mime-types']['o']     = 'application/x-object';
$conf['mime-types']['ogg']   = 'application/x-ogg';
$conf['mime-types']['oza']   = 'application/x-oz-application';
$conf['mime-types']['pl']    = 'application/x-perl';
$conf['mime-types']['pm']    = 'application/x-perl';
$conf['mime-types']['crl']   = 'application/x-pkcs7-crl';
$conf['mime-types']['rpm']   = 'application/x-redhat-package-manager';
$conf['mime-types']['shar']  = 'application/x-shar';
$conf['mime-types']['swf']   = 'application/x-shockwave-flash';
$conf['mime-types']['swfl']  = 'application/x-shockwave-flash';
$conf['mime-types']['sh']    = 'application/x-sh ';
$conf['mime-types']['sit']   = 'application/x-stuffit';
$conf['mime-types']['sv4cpio'] = 'application/x-sv4cpio';
$conf['mime-types']['sv4crc'] = 'application/x-sv4crc';
$conf['mime-types']['tar']   = 'application/x-tar';
$conf['mime-types']['tcl']   = 'application/x-tcl';
$conf['mime-types']['tex']   = 'application/x-tex';
$conf['mime-types']['gf']    = 'application/x-tex-gf';
$conf['mime-types']['pk']    = 'application/x-tex-pk';
$conf['mime-types']['texinfo'] = 'application/x-texinfo';
$conf['mime-types']['texi']  = 'application/x-texinfo';
$conf['mime-types']['; "~"']   = 'application/x-trash';
$conf['mime-types'][';"%"']   = 'application/x-trash';
$conf['mime-types']['bak']   = 'application/x-trash';
$conf['mime-types']['old']   = 'application/x-trash';
$conf['mime-types']['sik']   = 'application/x-trash';
$conf['mime-types']['t']     = 'application/x-troff';
$conf['mime-types']['tr']    = 'application/x-troff';
$conf['mime-types']['roff']  = 'application/x-troff';
$conf['mime-types']['man']   = 'application/x-troff-man';
$conf['mime-types']['me']    = 'application/x-troff-me';
$conf['mime-types']['ms']    = 'application/x-troff-ms';
$conf['mime-types']['ustar'] = 'application/x-ustar';
$conf['mime-types']['src']   = 'application/x-wais-source';
$conf['mime-types']['wz']    = 'application/x-wingz';
$conf['mime-types']['crt']   = 'application/x-x509-ca-cert';
$conf['mime-types']['fig']   = 'application/x-xfig';
$conf['mime-types']['au']    = 'audio/basic';
$conf['mime-types']['snd']   = 'audio/basic';
$conf['mime-types']['mid']   = 'audio/midi';
$conf['mime-types']['midi']  = 'audio/midi';
$conf['mime-types']['kar']   = 'audio/midi';
$conf['mime-types']['mpga']  = 'audio/mpeg';
$conf['mime-types']['mpega'] = 'audio/mpeg';
$conf['mime-types']['mp2']   = 'audio/mpeg';
$conf['mime-types']['mp3']   = 'audio/mpeg';
$conf['mime-types']['m3u']   = 'audio/mpegurl';
$conf['mime-types']['sid']   = 'audio/prs.sid';
$conf['mime-types']['aif']   = 'audio/x-aiff';
$conf['mime-types']['aiff']  = 'audio/x-aiff';
$conf['mime-types']['aifc']  = 'audio/x-aiff';
$conf['mime-types']['gsm']   = 'audio/x-gsm';
$conf['mime-types']['m3u']   = 'audio/x-mpegurl';
$conf['mime-types']['rpm']   = 'audio/x-pn-realaudio-plugin ';
$conf['mime-types']['ra']    = 'audio/x-pn-realaudio';
$conf['mime-types']['rm']    = 'audio/x-pn-realaudio';
$conf['mime-types']['ram']   = 'audio/x-pn-realaudio';
$conf['mime-types']['ra']    = 'audio/x-realaudio ';
$conf['mime-types']['pls']   = 'audio/x-scpls';
$conf['mime-types']['wav']   = 'audio/x-wav';
$conf['mime-types']['pdb']   = 'chemical/x-pdb';
$conf['mime-types']['xyz']   = 'chemical/x-xyz ';
$conf['mime-types']['bmp']   = 'image/bmp';
$conf['mime-types']['gif']   = 'image/gif';
$conf['mime-types']['ief']   = 'image/ief';
$conf['mime-types']['jpeg']  = 'image/jpeg';
$conf['mime-types']['jpg']   = 'image/jpeg';
$conf['mime-types']['jpe']   = 'image/jpeg';
$conf['mime-types']['pcx']   = 'image/pcx';
$conf['mime-types']['png']   = 'image/png';
$conf['mime-types']['svg']   = 'image/svg+xml';
$conf['mime-types']['svgz']  = 'image/svg+xml';
$conf['mime-types']['tiff']  = 'image/tiff';
$conf['mime-types']['tif']   = 'image/tiff';
$conf['mime-types']['wbmp']  = 'image/vnd.wap.wbmp';
$conf['mime-types']['ras']   = 'image/x-cmu-raster';
$conf['mime-types']['cdr']   = 'image/x-coreldraw';
$conf['mime-types']['pat']   = 'image/x-coreldrawpattern';
$conf['mime-types']['cdt']   = 'image/x-coreldrawtemplate';
$conf['mime-types']['cpt']   = 'image/x-corelphotopaint';
$conf['mime-types']['djvu']  = 'image/x-djvu';
$conf['mime-types']['djv']   = 'image/x-djvu';
$conf['mime-types']['jng']   = 'image/x-jng';
$conf['mime-types']['bmp']   = 'image/x-ms-bmp';
$conf['mime-types']['pnm']   = 'image/x-portable-anymap';
$conf['mime-types']['pbm']   = 'image/x-portable-bitmap';
$conf['mime-types']['pgm']   = 'image/x-portable-graymap';
$conf['mime-types']['ppm']   = 'image/x-portable-pixmap';
$conf['mime-types']['rgb']   = 'image/x-rgb';
$conf['mime-types']['xbm']   = 'image/x-xbitmap';
$conf['mime-types']['xpm']   = 'image/x-xpixmap';
$conf['mime-types']['xwd']   = 'image/x-xwindowdump';
$conf['mime-types']['igs']   = 'model/iges';
$conf['mime-types']['iges']  = 'model/iges';
$conf['mime-types']['msh']   = 'model/mesh';
$conf['mime-types']['mesh']  = 'model/mesh';
$conf['mime-types']['silo']  = 'model/mesh';
$conf['mime-types']['wrl']   = 'model/vrml';
$conf['mime-types']['vrml']  = 'model/vrml';
$conf['mime-types']['csv']   = 'text/comma-separated-values';
$conf['mime-types']['css']   = 'text/css';
$conf['mime-types']['htm']   = 'text/html';
$conf['mime-types']['html']  = 'text/html';
$conf['mime-types']['xhtml'] = 'text/html';
$conf['mime-types']['mml']   = 'text/mathml';
$conf['mime-types']['asc']   = 'text/plain';
$conf['mime-types']['txt']   = 'text/plain';
$conf['mime-types']['text']  = 'text/plain';
$conf['mime-types']['diff']  = 'text/plain';
$conf['mime-types']['rtx']   = 'text/richtext';
$conf['mime-types']['rtf']   = 'text/rtf';
$conf['mime-types']['tsv']   = 'text/tab-separated-values';
$conf['mime-types']['wml']   = 'text/vnd.wap.wml';
$conf['mime-types']['wmls']  = 'text/vnd.wap.wmlscript';
$conf['mime-types']['xml']   = 'text/xml';
$conf['mime-types']['xsl']   = 'text/xml';
$conf['mime-types']['hpp']   = 'text/x-c++hdr';
$conf['mime-types']['hxx']   = 'text/x-c++hdr';
$conf['mime-types']['hh']    = 'text/x-c++hdr';
$conf['mime-types']['cpp']   = 'text/x-c++src';
$conf['mime-types']['cxx']   = 'text/x-c++src';
$conf['mime-types']['cc']    = 'text/x-c++src';
$conf['mime-types']['h']     = 'text/x-chdr';
$conf['mime-types']['csh']   = 'text/x-csh';
$conf['mime-types']['c']     = 'text/x-csrc';
$conf['mime-types']['java']  = 'text/x-java';
$conf['mime-types']['moc']   = 'text/x-moc';
$conf['mime-types']['p']     = 'text/x-pascal';
$conf['mime-types']['pas']   = 'text/x-pascal';
$conf['mime-types']['etx']   = 'text/x-setext';
$conf['mime-types']['sh']    = 'text/x-sh';
$conf['mime-types']['tcl']   = 'text/x-tcl';
$conf['mime-types']['tk']    = 'text/x-tcl';
$conf['mime-types']['tex']   = 'text/x-tex';
$conf['mime-types']['ltx']   = 'text/x-tex';
$conf['mime-types']['sty']   = 'text/x-tex';
$conf['mime-types']['cls']   = 'text/x-tex';
$conf['mime-types']['vcs']   = 'text/x-vcalendar';
$conf['mime-types']['vcf']   = 'text/x-vcard';
$conf['mime-types']['dl']    = 'video/dl';
$conf['mime-types']['fli']   = 'video/fli';
$conf['mime-types']['gl']    = 'video/gl';
$conf['mime-types']['mpeg']  = 'video/mpeg';
$conf['mime-types']['mpg']   = 'video/mpeg';
$conf['mime-types']['mpe']   = 'video/mpeg';
$conf['mime-types']['qt']    = 'video/quicktime';
$conf['mime-types']['mov']   = 'video/quicktime';
$conf['mime-types']['mxu']   = 'video/vnd.mpegurl';
$conf['mime-types']['mng']   = 'video/x-mng';
$conf['mime-types']['asf']   = 'video/x-ms-asf';
$conf['mime-types']['asx']   = 'video/x-ms-asf';
$conf['mime-types']['avi']   = 'video/x-msvideo';
$conf['mime-types']['movie'] = 'video/x-sgi-movie';
$conf['mime-types']['ice']   = 'x-conference/x-cooltalk';
$conf['mime-types']['vrm']   = 'x-world/x-vrml';
$conf['mime-types']['vrml']  = 'x-world/x-vrml';
$conf['mime-types']['wrl']   = 'x-world/x-vrml';

$conf['publish'] = array();
$conf['publish']['edit']=true;
$conf['publish']['default']='index';
$conf['publish']['format']= "{filename}{language_sep}{language}{type_sep}{type}";
$conf['publish']['language_sep']= ".";
$conf['publish']['type_sep']= ".";
$conf['publish']['filename_language']='auto';
$conf['publish']['filename_type']='always';
$conf['publish']['style']="id";
$conf['publish']['url']='relative';
$conf['publish']['url']='absolute';
$conf['publish']['enable_php_in_page_content']=false;
$conf['publish']['enable_php_in_file_content']=false;
$conf['publish']['escape_8bit_characters']=false;
$conf['publish']['encode_utf8_in_html']=true;
$conf['publish']['negotiation'] = array();
$conf['publish']['negotiation']['page_negotiate_type']=true;
$conf['publish']['negotiation']['page_negotiate_language']=true;
$conf['publish']['negotiation']['file_negotiate_type']=true;
$conf['publish']['filesystem'] = array();
$conf['publish']['filesystem']['per_project']=true;
$conf['publish']['filesystem']['directory']='/var/www/';
$conf['publish']['command'] = array();
$conf['publish']['command']['per_project']=true;
$conf['publish']['command']['enable']=false;
$conf['publish']['command']['command']='';
$conf['publish']['ftp'] = array();
$conf['publish']['ftp']['enable']=true;
$conf['publish']['ftp']['per_project']=true;
$conf['publish']['ftp']['port']='21';
$conf['publish']['ftp']['host']='';
$conf['publish']['ftp']['path']='';
$conf['publish']['ftp']['user']='anonymous';
$conf['publish']['ftp']['pass']='mail@example.com';
$conf['replace'] = array();
$conf['replace']['']='0';
$conf['replace']['']='0';
$conf['replace']['euro']= "EUR,&euro";
$conf['replace']['copy']= "(c),&copy";
$conf['search'] = array();
$conf['search']['']='0';
$conf['search']['quicksearch'] = array();
$conf['search']['quicksearch']['show_button']=false;
$conf['search']['quicksearch']['search_name']=true;
$conf['search']['quicksearch']['search_filename']=true;
$conf['search']['quicksearch']['search_description']=true;
$conf['search']['quicksearch']['search_content']=false;
$conf['security'] = array();
$conf['security']['readonly']=false;
$conf['security']['nopublish']=false;
$conf['security']['umask']='0';
$conf['security']['chmod']='0';
$conf['security']['chmod_dir']='0';
$conf['security']['']='0';
$conf['security']['disable_dynamic_code']=true;
$conf['security']['show_system_info']=true;
$conf['security']['use_post_token']=true;
$conf['security']['renew_session_login']=false;
$conf['security']['renew_session_logout']=false;
$conf['security']['default'] = array();
$conf['security']['default']['username']='';
$conf['security']['default']['password']='';
$conf['security']['guest'] = array();
$conf['security']['guest']['enable']=false;
$conf['security']['guest']['user']='guest';
$conf['security']['login'] = array();
$conf['security']['login']['type']='form';
$conf['security']['auth'] = array();
$conf['security']['auth']['type']='database';
$conf['security']['auth']['userdn']=false;
$conf['security']['authorize'] = array();
$conf['security']['authorize']['type']='database';
$conf['security']['authorize']['type']='ldap';

$conf['security']['modules'] = array();
$conf['security']['modules']['autologin']='Guest,SingleSignon';
$conf['security']['modules']['preselect']='Ident,SSL,Cookie';
$conf['security']['modules']['authenticate']='LdapUserDN,Database,Internal';

$conf['security']['newuser'] = array();
$conf['security']['newuser']['autoadd'] = true;
$conf['security']['newuser']['autogroups'] = "";

$conf['security']['password'] = array();
$conf['security']['password']['random_length']='8';
$conf['security']['password']['min_length']='6';
$conf['security']['password']['salt']= '';
$conf['security']['password']['salt_text']= "somerandomtext";
$conf['security']['http'] = array();
$conf['security']['http']['url']= "http://example.net/restricted-area";
$conf['security']['authdb'] = array();
$conf['security']['authdb']['type']='postgresql';
$conf['security']['authdb']['user']='dbuser';
$conf['security']['authdb']['password']='dbpassword';
$conf['security']['authdb']['host']= '127.0.0.1';
$conf['security']['authdb']['database']='dbname';
$conf['security']['authdb']['persistent']=false;
$conf['security']['authdb']['sql']= "select 1 from table where user={username} and password=md5({password})";
$conf['security']['authdb']['add']=true;
$conf['security']['ssl'] = array();
$conf['security']['ssl']['user_var']='';
$conf['security']['ssl']['trust']=false;
$conf['security']['openid'] = array();
$conf['security']['openid']['enable']=false;
$conf['security']['openid']['add']=false;
$conf['security']['openid']['logo_url']='0';
$conf['security']['openid']['logo_url']="http://openid.net/login-bg.gif";
$conf['security']['openid']['trust_root']='http://your.server.example/openrat/';
$conf['security']['openid']['trust_root']='0';
$conf['security']['openid']['trusted_server']='openid1.example.com,openid2.example.com';
$conf['security']['openid']['trusted_server']='0';
$conf['security']['openid']['update_user']=true;
$conf['security']['openid']['user_identity']=true;
$conf['security']['openid']['provider']['name']='google';
$conf['security']['openid']['provider']['google']['xrds_uri']="http://google.com/accounts/o8/id";
$conf['security']['openid']['provider']['google']['map_attribute']="email";
$conf['security']['openid']['provider']['google']['name']="Google";
$conf['security']['openid']['provider']['google']['map_internal']="mail";
$conf['security']['openid']['provider']['yahoo']['xrds_uri']="http://??????";
$conf['security']['openid']['provider']['yahoo']['map_attribute']="usename";
$conf['security']['openid']['provider']['yahoo']['map_internal']="mail";
$conf['security']['sso'] = array();
$conf['security']['sso']['enable']=false;
$conf['security']['sso']['url']="http://localhost/check.php?phpsessid={id}&check=true";
$conf['security']['sso']['url']="https://www.example.com/phpmyadmin/main.php?server=1";
$conf['security']['sso']['auth_param_name']='authid';
$conf['security']['sso']['auth_param_serialized']=true;
$conf['security']['sso']['cookie']=true;
$conf['security']['sso']['cookie_name']='0';
$conf['security']['sso']['force']=true;
$conf['security']['sso']['expect']='0';
$conf['security']['sso']['expect_regexp']="/running on/";
$conf['security']['sso']['username_regexp']="/running on localhost as ([a-z]+)@localhost/";
$conf['security']['logout'] = array();
$conf['security']['logout']['redirect_url']="http://your.intranet.example/";
$conf['security']['logout']['redirect_url']='0';
$conf['security']['user'] = array();
$conf['security']['user']['show_admin_mail']=true;
$conf['security']['user']['show_mail']=true;
$conf['security']['user']['send_message']=true;
$conf['security']['content-security-policy']=true;

$conf['style'] = array();
$conf['style']['grey']=array();
$conf['style']['grey']['name']='Earl grey';
$conf['style']['grey']['title_background_color']='grey';
$conf['style']['grey']['title_text_color']='white';
$conf['style']['grey']['text_color'] ='black';
$conf['style']['grey']['background_color'] = '#d9d9d9';
$conf['style']['grey']['inactive_background_color'] = 'silver';

$conf['style']['system']=array();
$conf['style']['system']['name']='System colors';
$conf['style']['system']['title_background_color']='Menu';
$conf['style']['system']['title_text_color']='MenuText';
$conf['style']['system']['text_color'] ='WindowText';
$conf['style']['system']['background_color'] = 'Background';
$conf['style']['system']['inactive_background_color'] = 'WindowFrame';

$conf['style']['modern']=array();
$conf['style']['modern']['name']='Blue sky';
$conf['style']['modern']['title_background_color']='#3F6194';
$conf['style']['modern']['title_text_color']='white';
$conf['style']['modern']['text_color'] ='black';
$conf['style']['modern']['background_color'] = '#EEEEEE';
$conf['style']['modern']['inactive_background_color'] = '#7FB1E4';

$conf['theme'] = array();
$conf['theme']['compiler'] = array();
$conf['theme']['compiler']['enable']=true;
$conf['theme']['compiler']['cache']=true;
$conf['theme']['compiler']['chmod']='';
$conf['theme']['compiler']['compile_at_logout']=false;
$conf['webdav'] = array();
$conf['webdav']['enable']=false;
$conf['webdav']['create']=true;
$conf['webdav']['max_file_size']='1000';
$conf['webdav']['readonly']=true;
$conf['webdav']['expose_openrat']=true;
$conf['webdav']['session_in_uri']=false;
$conf['webdav']['session_in_uri_prefix']='ors';
$conf['webdav']['']='0';
$conf['webdav']['compliant_to_redmond']=true;
$conf['wiki'] = array();
$conf['wiki']['convert_html']=true;
$conf['wiki']['convert_bbcode']=true;
$conf['wiki']['tag_strong']= "*";
$conf['wiki']['tag_emphatic']= "_";
?>