<?php


use cms\model\Element;
use cms\model\Template;
use cms\model\Value;
use util\ArrayUtils;
use util\exception\OpenRatException;
use util\VariableResolver;

class MacroRunner
{
	public $page;

	public function executeMacro($name, $parameter, $page)
	{
		$this->page = $page;

		$className = $name;
		$output = '';

		$fileName = OR_DYNAMICCLASSES_DIR . $name . '.class.php';
		if (!is_file($fileName))
			throw new OpenRatException('ERROR_IN_ELEMENT','file not found:'.$fileName);

		require_once( $fileName );

		if (!class_exists($className))
			throw new OpenRatException('ERROR_IN_ELEMENT', 'class not found:' . $className);


		/** @var \util\Macro $macro */
		$macro = new $className;

		if (!method_exists($macro, 'execute'))
			throw new OpenRatException('ERROR_IN_ELEMENT',' (missing method: execute())');

		$macro->setContextPage($page);

		$resolver = new VariableResolver();

		$parameters = $resolver->resolveVariablesInArrayWith( $parameter, [

			'setting'=> function ($var) {
				return ArrayUtils::getSubValue($this->page->getSettings(), explode('.', $var));
			},

			'element'=>function ($var) {
				$template = new Template($this->page->templateid);
				$elements = $template->getElementNames();
				$elementid = array_search($var, $elements);

				$value = new Value();
				$value->publisher = $this->page->publisher;
				$value->elementid = $elementid;
				$value->element = new Element($elementid);
				$value->element->load();
				$value->pageid = $this->page->pageid;
				$value->languageid = $this->page->languageid;
				$value->load();

				return $value->getRawValue();
			}
		] );

		foreach ($parameters as $param_name => $param_value) {

			if (! property_exists($macro, $param_name)) {

				if (!$this->page->publisher->isPublic())
					$output .= "*WARNING*: Unknown parameter $param_name in macro $className\n";
				continue;
			}

			Logger::trace("Setting parameter for Macro-class $className, " . $param_name . ':' . print_r($param_value,true));

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