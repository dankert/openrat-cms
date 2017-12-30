<?php
// Excecuting the CMS user interface (UI)
require('modules/cms-ui/require.php');

use cms_ui\UI;

try {

    UI::execute();

} catch (Exception $e) {

    echo '<h2>CMS UI Error</h2>';
    echo '<pre>' . $e->getMessage() . '</pre>';

}

