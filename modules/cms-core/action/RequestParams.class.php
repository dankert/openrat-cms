<?php

namespace {

    /* Request Parameter Names */
    define('REQ_PARAM_EMBED'          ,'embed'          );
    define('REQ_PARAM_TOKEN'          ,'token'          );
    define('REQ_PARAM_ACTION'         ,'action'         );
    define('REQ_PARAM_SUBACTION'      ,'subaction'      );
    define('REQ_PARAM_ID'             ,'id'             );
    define('REQ_PARAM_SHORT'          ,'_'              );
    define('REQ_PARAM_OBJECT_ID'      ,'objectid'       );
    define('REQ_PARAM_LANGUAGE_ID'    ,'languageid'     );
    define('REQ_PARAM_MODEL_ID'       ,'modelid'        );
    define('REQ_PARAM_PROJECT_ID'     ,'projectid'      );
    define('REQ_PARAM_ELEMENT_ID'     ,'elementid'      );
    define('REQ_PARAM_TEMPLATE_ID'    ,'templateid'     );
    define('REQ_PARAM_DATABASE_ID'    ,'dbid'           );

    /* Filter Types */
    define('OR_FILTER_ALPHA', 'abc');
    define('OR_FILTER_ALPHANUM', 'abc123');
    define('OR_FILTER_FILENAME', 'file');
    define('OR_FILTER_MAIL', 'mail');
    define('OR_FILTER_TEXT', 'text');
    define('OR_FILTER_FULL', 'full');
    define('OR_FILTER_NUMBER', '123');
    define('OR_FILTER_RAW', 'raw');
    define('OR_FILTER_ALL', 'all');
}


namespace cms\action {

    use Text;

    class RequestParams
    {
        public $action;
        public $method;
        public $id;
        public $isEmbedded;

        public $isAction;

        /**
         * RequestParams constructor.
         */
        public function __construct()
        {
            $this->id         = @$_REQUEST[REQ_PARAM_ID       ];
            $this->action     = @$_REQUEST[REQ_PARAM_ACTION   ];
            $this->method     = @$_REQUEST[REQ_PARAM_SUBACTION];
            $this->isEmbedded = @$_REQUEST[REQ_PARAM_EMBED]=='1';

            if   ( isset($_REQUEST[REQ_PARAM_SHORT])) {
                list( $type, $id ) = array_pad( explode( '-', $_REQUEST[REQ_PARAM_SHORT] ), 2, '' );
                $this->action     = Text::clean( strtolower($type),'abcdefghijklmnopqrstuvwxyz');
                $this->id         = $id;
            }

            // Is this a POST request?
            $this->isAction = @$_SERVER['REQUEST_METHOD'] == 'POST';
        }

        /**
         * Ermittelt den Inhalt der gew�nschten Request-Variablen.
         * Falls nicht vorhanden, wird "" zur�ckgegeben.
         *
         * @param String $varName Schl�ssel
         * @return String Inhalt
         */
        public function getRequestVar($varName, $transcode = OR_FILTER_FULL)
        {
            if($varName == REQ_PARAM_ID)
                return $this->id;

            if($varName == REQ_PARAM_ACTION)
                return $this->action;

            if($varName == REQ_PARAM_SUBACTION)
                return $this->method;

            global $REQ;

            if (!isset($REQ[$varName]))
                return '';


            switch ($transcode) {
                case OR_FILTER_ALPHA:
                    $white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    break;

                case OR_FILTER_ALPHANUM:
                    $white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,_-!?%&/()';
                    break;

                case OR_FILTER_FILENAME:
                    // RFC 1738, Section 2.2:
                    // Thus, only alphanumerics, the special characters "$-_.+!*'(),", and
                    // reserved characters used for their reserved purposes may be used
                    // unencoded within a URL.
                    $white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$-_.+!*(),' . "'";
                    break;

                case OR_FILTER_MAIL:
                    $white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-@';
                    break;

                case OR_FILTER_TEXT:
                case OR_FILTER_FULL:
                case OR_FILTER_ALL:
                    // Ausfiltern von Control-Chars ( ASCII < 32 außer CR,LF) und HTML (<,>)
                    $white = '';
                    $white .= chr(10) . chr(13); // Line-Feed, Carriage-Return
                    for ($i = 32; $i <= 59; $i++) $white .= chr($i);  // Zahlen
                    // 60: '<'
                    $white .= chr(61);
                    // 62: '>'
                    for ($i = 63; $i <= 126; $i++) $white .= chr($i);  // abc
                    for ($i = 128; $i <= 255; $i++) $white .= chr($i);  // Sonderzeichen incl. UTF-8, UTF-16 (beginnen mit Bit 1)
                    break;

                case OR_FILTER_NUMBER:
                    $white = '1234567890.';
                    break;

                case OR_FILTER_RAW:
                    return $REQ[$varName];

                default:
                    throw new \LogicException('Unknown request filter', 'not found: ' . $transcode);
                    return '?';
            }

            $value = $REQ[$varName];
            $newValue = Text::clean($value, $white);

//            if (strlen($newValue) != strlen($value))
//                $this->addNotice('', '', 'UNEXPECTED_CHARS', OR_NOTICE_WARN);

            return $newValue;
        }


        /**
         * Ermittelt, ob der aktuelle Request eine Variable mit dem
         * angegebenen Namen enth�lt.
         *
         * @param String $varName Schl�ssel
         * @return boolean true, falls vorhanden.
         */
        public function hasRequestVar($varName)
        {
            global $REQ;

            return (isset($REQ[$varName]) && (!empty($REQ[$varName]) || $REQ[$varName] == '0'));
        }


        /**
         * Ermittelt die aktuelle Id aus dem Request.<br>
         * Um welche ID es sich handelt, ist abh�ngig von der Action.
         *
         * @return Integer
         */
        public function getRequestId()
        {
            if ($this->hasRequestVar('idvar'))
                return intval($this->getRequestVar($this->getRequestVar('idvar')));
            else
                return intval($this->getRequestVar(REQ_PARAM_ID));
        }


        public function hasLanguageId()
        {
            return $this->hasRequestVar(REQ_PARAM_LANGUAGE_ID);
        }

        public function getLanguageId()
        {
            return $this->getRequestVar(REQ_PARAM_LANGUAGE_ID,OR_FILTER_NUMBER);
        }

        public function hasModelId()
        {
            return $this->hasRequestVar(REQ_PARAM_MODEL_ID);
        }

        public function getModelId()
        {
            return $this->getRequestVar(REQ_PARAM_MODEL_ID,OR_FILTER_NUMBER);
        }
        public function getProjectId()
        {
            return $this->getRequestVar(REQ_PARAM_PROJECT_ID,OR_FILTER_NUMBER);
        }
    }
}