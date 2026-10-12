<?php

namespace cms\api;


class Template {

	public int $id;

	#[ArrayOf(Element::class)]
	public array $elements;

	#[ArrayOf(TemplateModel::class)]
	public array $templateModels;
}
