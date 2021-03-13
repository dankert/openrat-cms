<?php


namespace cms\generator;


/**
 * The page context, necessary for generating and publishing a page.
 */
class ValueContext extends BaseContext
{
	public $elementid;

	/**
	 * @var PageContext
	 */
	public $pageContext;

	public function __construct($pageContext )
	{
		$this->pageContext = $pageContext;
		$this->scheme      = $pageContext->scheme;
	}

	public function getCacheKey()
	{
		return array_merge( ['value'], $this->pageContext->getCacheKey(), [ $this->elementid ] );
	}

	public function isPublic() {
		return $this->scheme == Producer::SCHEME_PUBLIC;
	}

	public function getObjectId()
	{
		return $this->pageContext->getObjectId();
	}
}