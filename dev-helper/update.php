<?php

use cms\ui\themes\ThemeCompiler;
use language\LanguageCompiler;

define('XSD' ,'xsd' );
define('TPL' ,'tpl' );
define('ALL' ,'all' );
define('CSS' ,'css' );
define('JS'  ,'js'  );
define('LANG','lang');

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
			require (__DIR__.'/../modules/template_engine/components/XSDGenerator.php');
			break;

		case TPL:
            require (__DIR__.'/../modules/template_engine/TemplateCompiler.php');
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

	<div><input type="submit" /></div>
</form>

</body>
</html><?php } ?>