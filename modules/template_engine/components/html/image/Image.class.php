<?php

namespace template_engine\components;

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

	public function createElement()
	{
        $styleClasses = [];
        $tagName = 'img';
        $file = '';
        $selfClosing = true;

		if	( $this->menu )
		{
		    $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--menu-'.$this->menu];
            $selfClosing = false;
		}
		elseif	( $this->elementtype )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--action-el_'.$this->elementtype];
            $selfClosing = false;
		}
		elseif	( $this->action )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--action-'.$this->action];
            $selfClosing = false;
		}
		elseif	( $this->method )
		{
            $tagName = 'i';
			$styleClasses = ['image-icon','image-icon--method-'.$this->method];
            $selfClosing = false;
		}
		elseif	( $this->type )
		{
			$file = OR_THEMES_DIR.'default/images/icon_'.$this->type.IMG_ICON_EXT;
		}
		elseif	( $this->icon )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->icon.IMG_ICON_EXT;
		}
		elseif	( $this->notice )
		{
			$file = OR_THEMES_DIR.'default/images/notice_'.$this->notice.IMG_ICON_EXT;
		}
		elseif	( $this->tree )
		{
			$file = OR_THEMES_DIR.'default/images/tree_'.$this->tree.IMG_EXT;
		}
		elseif	( $this->url )
		{
			$file = $this->url;
		}
		elseif	( $this->fileext )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->fileext;
		}
		elseif	( $this->file )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->file.IMG_ICON_EXT;
		}

		if	( $this->class )
        {
            $styleClasses .= ' '.$this->class;
        }


		$image = new CMSElement($tagName );

		foreach( $styleClasses as $styleClass )
		    $image->addStyleClass($styleClass);

		if($this->title)
			$image->addAttribute('title',$this->title);

		if   ( $file)
			$image->addAttribute('src',$file);

		$image->selfClosing( $selfClosing );

		return $image;
	}
}