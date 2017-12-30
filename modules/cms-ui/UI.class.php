<?php

namespace cms_ui;

use BadMethodCallException;
use cms\Dispatcher;
use DomainException;
use Exception;
use Http;
use JSON;
use Logger;
use LogicException;
use ObjectNotFoundException;
use OpenRatException;
use SecurityException;
use Session;
use template_engine\TemplateEngine;

define('CMS_UI_REQ_PARAM_SUBACTION', 'subaction');
define('CMS_UI_REQ_PARAM_ACTION', 'action');


class UI
{
    public static function execute()
    {
        try {
            if (!empty($_REQUEST[CMS_UI_REQ_PARAM_ACTION]))
                $action = $_REQUEST[CMS_UI_REQ_PARAM_ACTION];
            else
                $action = 'index';

            if (!empty($_REQUEST[CMS_UI_REQ_PARAM_SUBACTION]))
                $subaction = $_REQUEST[CMS_UI_REQ_PARAM_SUBACTION];
            else {
                $subaction = 'show';
            }

            $dispatcher = new Dispatcher();

            $dispatcher->action = $action;
            define('OR_ACTION', $action);

            $dispatcher->subaction = $subaction;
            define('OR_METHOD', $subaction);


            $data = $dispatcher->doAction();

            // The action is able to change its method name.
            $subaction = $dispatcher->subaction;

            header('Content-Type: text/html; charset=UTF-8');

            $tplName = $action . '/' . $subaction;

            UI::outputTemplate($tplName,$data['output']);
        } catch (BadMethodCallException $e) {
            // Action-Method does not exist.
            Http::noContent();
        } catch (ObjectNotFoundException $e) {
            Logger::warn("Object not found: " . $e->__toString()); // Nur Debug, da dies bei gelöschten Objekten vorkommen kann.
            Http::noContent();
        } catch (OpenRatException $e) {
            Http::serverError(lang($e->key), $e->__toString());
        } catch (SecurityException $e) {
            Logger::info($e->getMessage());
            Http::notAuthorized("You are not allowed to execute this action.");
        } catch (Exception $e) {
            Http::serverError("Internal CMS error", $e->__toString());
        }
    }

    /**
     * Executes and outputs a HTML template.
     *
     * @param $tplName string Name of template
     * @param $output array Output data
     */
    private static function outputTemplate($tplName, $output)
    {
        global $REQ;
        global $PHP_SELF;
        global $HTTP_SERVER_VARS;
        global $image_dir;
        global $view;
        global $conf;

        $image_dir = OR_THEMES_DIR . $conf['interface']['theme'] . '/images/';

        $user = Session::getUser();

        if (!empty($conf['interface']['override_title']))
            $cms_title = $conf['interface']['override_title'];
        else
            $cms_title = OR_TITLE . ' ' . OR_VERSION;



        $subActionName = OR_ACTION;
        $actionName = OR_METHOD;
        $requestId = $_REQUEST['id'];

        $iFile = 'modules/cms-ui/themes/default/templates/' . $tplName . '.tpl.out.' . PHP_EXT;

        if (DEVELOPMENT) {
            $srcXmlFilename = 'modules/cms-ui/themes/default/templates/' . $tplName . '.tpl.src.xml';

            // Das Template kompilieren.
            // Aus dem XML wird eine PHP-Datei erzeugt.
            try {
                $te = new TemplateEngine();
                $te->compile($srcXmlFilename, $iFile);
                unset($te);
            } catch (Exception $e) {
                throw new DomainException("Compilation failed for Template '$tplName'.", 0, $e);
            }
            header("X-CMS-Template-File: " . $iFile);
        }


        // Übertragen der Ausgabe-Variablen in den aktuellen Kontext
        //
        extract($output);

        if (is_file($iFile))
            // Einbinden des Templates
            require_once($iFile);
        else
            throw new LogicException("File '$iFile' not found.");


    }
}
