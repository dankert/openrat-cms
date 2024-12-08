<?php

namespace template_engine\components\html\component_form;

use cms\action\RequestParams;
use language\Messages;
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
	public $forwardTo = null;

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
			$this->action = $this->context->action;

		if   ( ! $this->subaction )
			$this->subaction = $this->context->method;

		if   ( ! $this->id )
			$this->id = $this->context->id;

		$form = new CMSElement('form');

		if ($this->type == 'upload')
			$this->submitFunction = '';

		$form->addAttribute('name', $this->name);
		$form->addAttribute('target', '_self');
		$form->addAttribute('data-target', $this->target);
		$form->addAttribute('action', './');
		if   ( $this->forwardTo )
			$form->addAttribute('data-forward-to', $this->forwardTo);
		$form->addAttribute('data-method', $this->subaction);
		$form->addAttribute('data-action', $this->action);
		$form->addAttribute('data-id', $this->id);
		$form->addAttribute('method', $this->method);
		$form->addAttribute('enctype', $this->enctype);
		$form->addStyleClass('form')->addStyleClass($this->action);
		$form->addAttribute('data-async', $this->async);
		$form->addAttribute('data-autosave', $this->autosave);

		if ($this->afterSuccess)
			$form->addAttribute('data-after-success', $this->afterSuccess);

		$form->addChild(
			(new HtmlElement('div'))->addStyleClass('form-headline')
		);

		// Creating the action bar
		$actionBar = (new HtmlElement('div'))->addStyleClass('form-actionbar');

		if   ( !$this->readonly && !$this->autosave ) {
			// Show action buttons

			if ($this->cancel) {
				// Adding a cancel-button.
				$actionBar->addChild(
					(new CMSElement('div'))
						->addStyleClass('btn')
						->addStyleClass('btn--control')
						->addStyleClass('btn--secondary')
						->addStyleClass('act-form-cancel')
						->addChild(
							(new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--form-cancel'])
						)->addChild(
							(new HtmlElement('span'))->addStyleClass('form-btn-label')->content(Value::createExpression(ValueExpression::TYPE_MESSAGE, Messages::CANCEL))
						)
				);
			}

			if ($this->apply) {
				// Adding an apply-button
				$actionBar->addChild(
					(new CMSElement('div'))
						->addStyleClass('btn')
						->addStyleClass('btn--control')
						->addStyleClass('btn--primary')
						->addStyleClass('act-form-apply')
						->addChild(
							(new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--form-apply'])
						)->addChild(
							(new HtmlElement('span'))->addStyleClass('form-btn-label')->content(Value::createExpression(ValueExpression::TYPE_MESSAGE, Messages::APPLY))
						)
				);
			}

			// Adding the save-button
			$actionBar->addChild(
				(new CMSElement('div'))
					->addStyleClass('btn')
					->addStyleClass('btn--control')
					->addStyleClass('btn--primary')
					->addStyleClass('act-form-save')
					->addChild(
						(new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--form-ok'])
					)->addChild(
						(new HtmlElement('span'))->addStyleClass('form-btn-label')->content($this->label)
					)
			);
		}

		$formContent = (new HtmlElement('div'))->addStyleClass('form-content')->asChildOf($form);

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