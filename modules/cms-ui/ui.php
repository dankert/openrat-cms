<?php

use cms\Dispatcher;
use template_engine\TemplateEngine;

define('CMS_UI_REQ_PARAM_SUBACTION'      ,'subaction'      );
define('CMS_UI_REQ_PARAM_ACTION'         ,'action'         );



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
    $dispatcher->subaction = $subaction;

    $output = $dispatcher->doAction();

    $httpAccept = getenv('HTTP_ACCEPT');
    $types = explode(',', $httpAccept);

    if (sizeof($types) == 1 && in_array('application/json', $types) || @$_REQUEST['output'] == 'json')
    {
        $json = new JSON();
        header('Content-Type: application/json; charset=UTF-8');
        if (function_exists('json_encode'))
            // Native Methode ist schneller..
            echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR);
        else
            // Fallback, falls json_encode() nicht existiert...
            echo $json->encode($output);
        exit;
    }

    header('Content-Type: text/html; charset=UTF-8');

    $tplName = $action . '/' . $subaction;

    global $REQ;
    global $PHP_SELF;
    global $HTTP_SERVER_VARS;
    global $image_dir;
    global $view;

    $image_dir = OR_THEMES_DIR . $conf['interface']['theme'] . '/images/';

    $user = Session::getUser();

    if (!empty($conf['interface']['override_title']))
        $cms_title = $conf['interface']['override_title'];
    else
        $cms_title = OR_TITLE . ' ' . OR_VERSION;

    $subActionName = $dispatcher->subaction;
    $actionName = $dispatcher->action;
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
    extract($output['output']);

    if (is_file($iFile))
        // Einbinden des Templates
        require_once($iFile);
    else
        throw new LogicException("File '$iFile' not found.");


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






?>