<?php

namespace template_engine\components;

use cms\base\Startup;
use template_engine\components\html\Component;
use template_engine\element\CMSElement;

class ImageComponent extends Component
{
	public $class;
	public $menu;
	public $action;
	public $method;
	public $config;
	public $file;
	public $url;
	public $icon;
	public $type;
	public $elementtype;
	public $fileext;
	public $tree;
	public $notice;
	public $size;
	public $title;
	public $symbol;

	public function createElement()
	{
        $styleClasses = [];
        $tagName = 'img';
        $file = '';

		if	( $this->symbol )
		{
		    $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--'.$this->symbol];
		}
		elseif	( $this->menu )
		{
		    $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--menu-'.$this->menu];
		}
		elseif	( $this->elementtype )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--action-el_'.$this->elementtype];
		}
		elseif	( $this->action )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--action-'.$this->action];
		}
		elseif	( $this->method )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--method-'.$this->method];
		}
		elseif	( $this->type )
		{
			$file = Startup::THEMES_DIR.'default/images/icon_'.$this->type.Startup::IMG_ICON_EXT;
		}
		elseif	( $this->icon )
		{
			$file = Startup::THEMES_DIR.'default/images/icon/'.$this->icon.Startup::IMG_ICON_EXT;
		}
		elseif	( $this->notice )
		{
			$file = Startup::THEMES_DIR.'default/images/notice_'.$this->notice.Startup::IMG_ICON_EXT;
		}
		elseif	( $this->tree )
		{
			$file = Startup::THEMES_DIR.'default/images/tree_'.$this->tree.Startup::IMG_EXT;
		}
		elseif	( $this->url )
		{
			$file = $this->url;
		}
		elseif	( $this->fileext )
		{
			$file = Startup::THEMES_DIR.'default/images/icon/'.$this->fileext;
		}
		elseif	( $this->file )
		{
			$file = Startup::THEMES_DIR.'default/images/icon/'.$this->file.Startup::IMG_ICON_EXT;
		}

		if	( $this->class )
        {
            $styleClasses = array_merge($styleClasses, Component::splitByComma( $this->class ));
        }


		$image = new CMSElement($tagName );

	    $image->addStyleClass($styleClasses);

		if($this->title)
			$image->addAttribute('title',$this->title);

		if   ( $file)
			$image->addAttribute('src',$file);

		return $image;
	}
}