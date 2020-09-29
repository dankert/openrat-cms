<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class FormComponent extends Component
{

	public $method = 'POST';

	public $name = '';

	public $action = null;

	public $subaction = null;

	public $id = '${_id}';

	public $languageid = null;
	public $modelid = null;

	public $label = '${message:button_ok}';

	public $apply = false;
	public $cancel = true;
	public $readonly = false;

	/**
	 * 'view' = Loads Action in the same view
	 * 'top' = Replaces whole workbench.
	 * @var string
	 */
	public $target = 'view';

	public $enctype = 'application/x-www-form-urlencoded';

	public $async = false;

	public $autosave = false;

	public $type = '';

	public $afterSuccess;

	private $token = '${_token}';


	public function createElement()
	{
		if   ( ! $this->action )
			$this->action = $this->request->action;

		if   ( ! $this->subaction )
			$this->subaction = $this->request->method;

		if   ( ! $this->id )
			$this->id = $this->request->id;

		$form = new CMSElement('form');

		if ($this->type == 'upload')
			$this->submitFunction = '';

		$form->addAttribute('name', $this->name);
		$form->addAttribute('target', '_self');
		$form->addAttribute('data-target', $this->target);
		$form->addAttribute('action', './');
		$form->addAttribute('data-method', $this->subaction);
		$form->addAttribute('data-action', $this->action);
		$form->addAttribute('data-id', $this->id);
		$form->addAttribute('method', $this->method);
		$form->addAttribute('enctype', $this->enctype);
		$form->addStyleClass('or-form')->addStyleClass($this->action);
		$form->addAttribute('data-async', $this->async);
		$form->addAttribute('data-autosave', $this->autosave);

		if ($this->afterSuccess)
			$form->addAttribute('data-after-success', $this->afterSuccess);

		$form->addChild(
			(new HtmlElement('div'))->addStyleClass('or-form-headline')
		);

		$actionBar = (new HtmlElement('div'))->addStyleClass('or-form-actionbar');

		// Cancel-Button nicht anzeigen, wenn cancel==false.
		if ($this->cancel) {
			$actionBar->addChild(
				(new CMSElement('input'))
					->addAttribute('type', 'button')
					->addStyleClass('or-form-btn')
					->addStyleClass('or-form-btn--secondary')
					->addStyleClass('or-form-btn--cancel')
					->addAttribute('value',
						Value::createExpression(ValueExpression::TYPE_MESSAGE, 'CANCEL')
					)
			);
		}

		if ($this->apply && !$this->readonly) {
			$actionBar->addChild(
				(new CMSElement('input'))
					->addAttribute('type', 'button')
					->addStyleClass('or-form-btn')
					->addStyleClass('or-form-btn--primary')
					->addStyleClass('or-form-btn--apply')
					->addAttribute('value',
						Value::createExpression(ValueExpression::TYPE_MESSAGE, 'APPLY')
					)
			);
		}

		if (!$this->readonly) {
			$actionBar->addChild(
				(new CMSElement('input'))
					->addAttribute('type', 'submit')
					->addStyleClass('or-form-btn')
					->addStyleClass('or-form-btn--primary')
					->addStyleClass('or-form-btn--save')
					->addAttribute('value', $this->label)
			);
		}

		$formContent = (new HtmlElement('div'))->addStyleClass('or-form-content')->asChildOf($form);

		if ($this->languageid)
			$formContent->addChild(
				(new CMSElement('input'))
					->addAttribute('type', 'hidden')
					->addAttribute('name', RequestParams::PARAM_LANGUAGE_ID)
					->addAttribute('value', $this->languageid)
			);

		if ($this->modelid)
			$formContent->addChild(
				(new CMSElement('input'))
					->addAttribute('type', 'hidden')
					->addAttribute('name', RequestParams::PARAM_MODEL_ID)
					->addAttribute('value', $this->modelid)
			);

		$formContent->addChild(
			(new CMSElement('input'))
				->addAttribute('type', 'hidden')
				->addAttribute('name', RequestParams::PARAM_TOKEN)
				->addAttribute('value', $this->token)
		);

		$formContent->addChild(
			(new CMSElement('input'))
				->addAttribute('type', 'hidden')
				->addAttribute('name', RequestParams::PARAM_ACTION)
				->addAttribute('value', $this->action)
		);
		$formContent->addChild(
			(new CMSElement('input'))
				->addAttribute('type', 'hidden')
				->addAttribute('name', RequestParams::PARAM_SUBACTION)
				->addAttribute('value', $this->subaction)
		);
		$formContent->addChild(
			(new CMSElement('input'))
				->addAttribute('type', 'hidden')
				->addAttribute('name', RequestParams::PARAM_ID)
				->addAttribute('value', $this->id)
		);



		$this->adoptiveElement = $formContent;

		$form->addChild( $actionBar );

		return $form;
	}
}