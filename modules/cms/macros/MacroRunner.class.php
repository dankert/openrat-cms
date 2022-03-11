<?php


namespace cms\macros;

use cms\generator\PageContext;
use cms\model\Element;
use cms\model\PageContent;
use cms\model\Template;
use cms\model\Value;
use logger\Logger;
use util\ArrayUtils;
use util\exception\GeneratorException;
use util\text\variables\VariableResolver;

class MacroRunner
{
	public $page;

	/**
	 * @param $name
	 * @param $parameter
	 * @param $page
	 * @param $pageContext PageContext
	 * @return string
	 * @throws GeneratorException
	 */
	public function executeMacro($name, $parameter, $page, $pageContext)
	{
		$this->page = $page;

		$className = 'cms\macros\macro\\'.$name;
		$output = '';

		if (!class_exists($className))
			throw new GeneratorException('class not found:' . $className);

		/** @var \util\Macro $macro */
		$macro = new $className;

		if (!method_exists($macro, 'execute'))
			throw new GeneratorException(' (missing method: execute())');

		$macro->setPageContext($pageContext);

		$resolver = new VariableResolver();

		$resolver->namespaceSeparator = ':';
		$resolver->defaultSeparator   = '?';
		$resolver->addResolver('setting',function ($var) {
			return ArrayUtils::getSubValue($this->page->getSettings(), explode('.', $var));
		});
		$resolver->addResolver('element',function ($var) use($pageContext) {
			$template = new Template($this->page->templateid);
			$elements = $template->getElementNames();
			$elementid = array_search($var, $elements);

			$element = new Element($elementid);
			$element->load();

			$pageContent = new PageContent();
			$pageContent->pageId     = $this->page->pageid;
			$pageContent->languageid = $pageContext->languageId;
			$pageContent->elementId  = $elementid;
			$pageContent->load();

			$value = new Value();
			$value->contentid = $pageContent->contentId;
			$value->load();

			return $value->getRawValue($element->typeid);
		});

		$parameters = $resolver->resolveVariablesInArray($parameter);

		foreach ($parameters as $param_name => $param_value) {

			if (!property_exists($macro, $param_name)) {

				Logger::warn( "Unknown parameter $param_name in macro $className" );
				continue;
			}

			if ( DEVELOPMENT )
				Logger::trace("Setting parameter for Macro-class $className, " . $param_name . ':' . print_r($param_value, true));

			// Die Parameter der Makro-Klasse typisiert setzen.
			if (is_int($macro->$param_name))
				$macro->$param_name = intval($param_value);
			elseif (is_array($macro->$param_name))
				$macro->$param_name = (array)$param_value;
			else
				$macro->$param_name = $param_value;

		}

		ob_start();

		$macro->execute();

		$output .= ob_get_contents();

		ob_end_clean();

		return $output;
	}
}