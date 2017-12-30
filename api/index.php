<?php
// Excecuting the CMS application programming interface (API)

require('../modules/cms-api/require.php');

use cms_api\API;

try {

    API::execute();

} catch (Exception $e) {

    echo $e->getMessage();

}


?>