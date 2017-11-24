<?php

class ImageComponent extends Component
{

	public $config;
	public $file;
	public $url;
	public $icon;
	public $align='left';
	public $type;
	public $elementtype;
	public $fileext;
	public $tree;
	public $notice;
	public $size;
	public $title;

	protected function begin()
	{
		if	( !empty($this->elementtype) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/element/'.$this->htmlvalue($this->elementtype).'.svg';
			$styleClass = 'image-icon image-icon--element';
		}
		elseif	( !empty($this->type) )
		{
			$file = OR_THEMES_DIR.'default/images/icon_'.$this->htmlvalue($this->type).IMG_ICON_EXT;
			$styleClass = '';
		}
		elseif	( !empty($this->icon) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->icon).IMG_ICON_EXT;
			$styleClass = '';
		}
		elseif	( !empty($this->notice) )
		{
			$file = OR_THEMES_DIR.'default/images/notice_'.$this->htmlvalue($this->notice).IMG_ICON_EXT;
			$styleClass = '';
		}
		elseif	( !empty($this->tree) )
		{
			$file = OR_THEMES_DIR.'default/images/tree_'.$this->htmlvalue($this->tree).IMG_EXT;
			$styleClass = '';
		}
		elseif	( !empty($this->url) )
		{
			$file = $this->htmlvalue($this->url);
			$styleClass = '';
		}
		elseif	( !empty($this->fileext) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->fileext);
			$styleClass = '';
		}
		elseif	( !empty($this->file) )
		{
			$file = OR_THEMES_DIR.'default/images/icon/'.$this->htmlvalue($this->file).IMG_ICON_EXT;
			$styleClass = '';
		}
		
		echo '<img class="'.$styleClass.'" title="'.$this->htmlvalue($this->title).'" src="'.$file.'" />';
	}

	protected function end()
	{
	}
}

?>