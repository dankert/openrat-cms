<?php

namespace template_engine\components;

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

	protected function begin()
	{
        $styleClass = '';
        $tagName = 'img';
        $file = '';
        $selfClosing = true;

		if	( !empty($this->menu) )
		{
		    $tagName = 'i';
			$styleClass = 'image-icon image-icon--menu-'.$this->htmlvalue($this->menu);
            $selfClosing = false;
		}
		elseif	( !empty($this->elementtype) )
		{
            $tagName = 'i';
			$styleClass = 'image-icon image-icon--element-'.$this->htmlvalue($this->elementtype);
            $selfClosing = false;
		}
		elseif	( !empty($this->action) )
		{
            $tagName = 'i';
			$styleClass = 'image-icon image-icon--action-'.$this->htmlvalue($this->action);
            $selfClosing = false;
		}
		elseif	( !empty($this->method) )
		{
            $tagName = 'i';
			$styleClass = 'image-icon image-icon--method-'.$this->htmlvalue($this->method);
            $selfClosing = false;
		}
		elseif	( !empty($this->type) )
		{
			$file = OR_THEMES_DIR.'default/images/icon_'.$this->htmlvalue($this->type).IMG_ICON_EXT;
		}
		elseif	( !empty($this->icon) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->icon).IMG_ICON_EXT;
		}
		elseif	( !empty($this->notice) )
		{
			$file = OR_THEMES_DIR.'default/images/notice_'.$this->htmlvalue($this->notice).IMG_ICON_EXT;
		}
		elseif	( !empty($this->tree) )
		{
			$file = OR_THEMES_DIR.'default/images/tree_'.$this->htmlvalue($this->tree).IMG_EXT;
		}
		elseif	( !empty($this->url) )
		{
			$file = $this->htmlvalue($this->url);
		}
		elseif	( !empty($this->fileext) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->fileext);
		}
		elseif	( !empty($this->file) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->file).IMG_ICON_EXT;
		}

		if	( !empty($this->class) )
        {
            $styleClass .= ' '.$this->class;
        }


        echo '<'.$tagName.'';

		if( $styleClass )
		    echo ' class="'.$styleClass.'"';

		if($this->title)
		    echo ' title="'.$this->htmlvalue($this->title).'"';

		if   ( $file)
		    echo ' src="'.$file.'"';

		if   ( $selfClosing )
		    echo ' />';
		else
		    echo '></'.$tagName.'>';
	}

	protected function end()
	{
	}
}

?>