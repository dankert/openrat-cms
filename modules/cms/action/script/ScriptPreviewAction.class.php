<?php
namespace cms\action\script;
use cms\action\Method;
use cms\action\ScriptAction;
use cms\action\TextAction;
use cms\base\Configuration;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\Producer;
use cms\model\File;


class ScriptPreviewAction extends ScriptAction implements Method {


    public function view()
	{
		$fileContext = new FileContext($this->script->objectid, Producer::SCHEME_PREVIEW );

		$generator = new FileGenerator( $fileContext);

		if	( $this->request->getAlphanum('encoding') == 'base64')
		{
			$encodingFunction = function($value) {
				return base64_encode($value);
			};
			$this->setTemplateVar('encoding', 'base64');
		}
		else {
			$encodingFunction = function($value) {
				return $value;
			};
			$this->setTemplateVar('encoding', 'none');
		}


		// Unterscheidung, ob PHP-Code in der Datei ausgefuehrt werden soll.
		$publishConfig = Configuration::subset('publish');
		$phpActive = ( $publishConfig->get('enable_php_in_file_content')=='auto' && $this->file->getRealExtension()=='php') ||
			$publishConfig->get('enable_php_in_file_content' )===true;

		if	(  $phpActive ) {

			// PHP-Code ausfuehren
			ob_start();
			require( $generator->getCache()->load()->getFilename() );
			$this->setTemplateVar('text',$encodingFunction(ob_get_contents()) );
			ob_end_clean();
		}
		else
			$this->setTemplateVar('text',$encodingFunction( $generator->getCache()->get() ) );
	}

    public function post() {
    }
}
