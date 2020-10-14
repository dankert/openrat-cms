<?php

namespace template_engine\components;

use template_engine\components\html\Component;

/**
 * Pseudo-Component.
 * The include component is a pseudo component. The template compiler will resolve this component first and is including another xml source file.
 */
class IncludeComponent extends Component
{

	public $file;

}

