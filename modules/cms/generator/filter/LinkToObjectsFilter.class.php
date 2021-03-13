<?php


namespace cms\generator\filter;


use cms\model\BaseObject;
use util\text\variables\VariableResolver;

class LinkToObjectsFilter extends AbstractFilter
{
	public function filter($value)
	{
		$resolver = new VariableResolver();

		$resolver->addResolver('link',function($key) {

			$targetId = intval( $key );

			if   ( $targetId ) {

				$from   = new BaseObject( $this->context->getObjectId() );
				$from->load();
				$target = new BaseObject( $targetId );
				$target->load();

				$linkScheme = $this->context->getLinkScheme();
				return $linkScheme->linkToObject( $from, $target );
			} else {
				return '';
			}
		});

		return $resolver->resolveVariables( $value );
		}

}