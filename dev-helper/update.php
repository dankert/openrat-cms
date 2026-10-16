<?php

use cms\action\OpenApiGenerator;
use cms\ui\themes\ThemeCompiler;
use language\LanguageCompiler;
use template_engine\components\XSDGenerator;
use template_engine\TemplateCompiler;

define('XSD' ,'xsd' );
define('TPL' ,'tpl' );
define('ALL' ,'all' );
define('CSS' ,'css' );
define('JS'  ,'js'  );
define('LANG','lang');
define('API' ,'api' );

$type = $_POST['type'];


if   ( @$type )
{
	ini_set('display_errors', 1);
	ini_set('html_errors', 0);
	error_reporting(E_ALL & ~E_NOTICE);

	require (__DIR__.'/../modules/autoload.php');

	header('Content-Type: text/plain');
	switch ($type) {
		case XSD:
			$generator = new XSDGenerator();
			$generator->generate();
			break;

		case TPL:
			$generator = new TemplateCompiler();
			$generator->generate();
			break;

		case LANG:
            $compiler = new LanguageCompiler();
            $compiler->updateProduction();
			break;

		case CSS:
			$compiler = new ThemeCompiler();
			$compiler->compileStyles();
			break;

		case JS:
			$compiler = new ThemeCompiler();
			$compiler->compileScripts();
			break;

		case API:
			$compiler = new OpenApiGenerator();
			break;
		default:
			echo "Unknown type";
			http_response_code(400); // "Bad Request"
	}
}

else {
	?>
<html>

<body>


<h1>Updating OpenRat UI components</h1>

<p><i>Only for developers</i></p>

<form action="./<?php echo basename(__FILE__) ?>" method="POST">


	<div><label><input type="radio" name="type" value="<?php echo XSD ?>" /> XSD Generator</label></div>
	<div><label><input type="radio" name="type" value="<?php echo TPL ?>" /> Template Compiler</label></div>
	<div><label><input type="radio" name="type" value="<?php echo CSS ?>" /> LESS Compiler and CSS Minifier</label></div>
	<div><label><input type="radio" name="type" value="<?php echo JS ?>" /> JS Minifier</label></div>
	<div><label><input type="radio" name="type" value="<?php echo LANG ?>" /> Language files Compiler</label></div>
	<div><label><input type="radio" name="type" value="<?php echo API ?>" /> API doc</label></div>

	<div><input type="submit" /></div>
</form>

</body>
</html><?php } ?>