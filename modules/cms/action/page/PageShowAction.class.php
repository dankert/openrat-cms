<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\base\Configuration;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\model\Language;
use cms\model\Template;
use configuration\Config;
use logger\Logger;
use util\exception\DatabaseException;
use util\exception\GeneratorException;
use util\Text;

class PageShowAction extends PageAction implements Method {
    public function view() {
	    // We must overwrite the CSP here.
        // The output is only shown in an iframe, so there is no security impact to the CMS.
        // But if the template is using inline JS or CSS, we would break this with a CSP-header.
		$pageSettingsConfig =  new Config( $this->page->getTotalSettings() );
        $this->setContentSecurityPolicy($pageSettingsConfig->get('content-security-policy',[]) );

		$this->page->load();


		Logger::debug("Preview page: ".$this->page->__toString() );

		$pageContext = $this->createPageContext( Producer::SCHEME_PREVIEW );

		// HTTP-Header mit Sprachinformation setzen.
		$language = new Language( $pageContext->languageId);
		$language->load();
		$this->addHeader('Content-Language',$language->isoCode);

		$generator = new PageGenerator( $pageContext );

		$this->setContentType( $generator->getMimeType() );


		$template = new Template( $this->page->templateid );
		$templateModel = $template->loadTemplateModelFor( $pageContext->modelId );
		$templateModel->load();

		try {
			// Executing PHP in Pages.
			// DEPRECATED: Use the script language!
			$enablePHP = Configuration::subset('publish')->get('enable_php_in_page_content');
			if	( ( $enablePHP=='auto' && $templateModel->extension == 'php') ||
				$enablePHP===true )
			{
				ob_start();
				require( $generator->getCache()->load()->getFilename() );
				$this->setTemplateVar('value',ob_get_contents() );
				ob_end_clean();
			}
			else
				$this->setTemplateVar('value',$generator->getCache()->get());
		} catch (GeneratorException $e) {
			$this->setContentType( 'text/html' );
			$this->setTemplateVar('value',Text::getUserFriendlyHTMLErrorMessage($e ) );
		}
    }

    public function post() {
    }
}
