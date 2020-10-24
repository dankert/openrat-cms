<?php

namespace template_engine\components\html\component_link;

use cms\action\RequestParams;
use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use util\json\JSON;

/**
 * Erzeugt einen HTML-Link.
 * 
 * @author dankert
 *
 */
class LinkComponent extends Component
{

	public $var1;

	public $var2;

	public $var3;

	public $var4;

	public $var5;

	public $value1;

	public $value2;

	public $value3;

	public $value4;

	public $value5;

	public $target;

	public $type;

	public $action;

	public $subaction;

	public $title;

	public $class;

	public $url;

	public $config;

	public $id;

	public $accesskey;

	public $name;

	public $anchor;

	public $frame = '_self';

	public $modal = false;

	public $afterSuccess;



	public function createElement()
	{

		$link = new CMSElement('a');
		$link->addStyleClass('link');

		if ( $this->afterSuccess )
			$link->addAttribute('data-after-success',$this->afterSuccess);
		
		if ( $this->class )
			$link->addStyleClass($this->class);

		if ( $this->title )
			$link->addAttribute('title',$this->title);
		
		if ( $this->accesskey )
			$link->addAttribute('accesskey',$this->accesskey);
		
		if ( $this->frame )
			$link->addAttribute('target',$this->frame);
		
		if ( $this->name )
			$link->addAttribute('date-name',$this->name)->addAttribute('name',$this->name);
		
		if ( $this->url )
			$link->addAttribute('data-url',$this->url);
		
		if ( $this->type )
			$link->addAttribute('data-type',$this->type);
		
		if ( $this->action )
			$link->addAttribute('data-action',$this->action);
		else
			$link->addAttribute('data-action','');
		
		if ( $this->subaction )
			$link->addAttribute('data-method',$this->subaction);
		else
			$link->addAttribute('data-method','');
		
		if ( $this->id )
			$link->addAttribute('data-id',$this->id);
		else
			$link->addAttribute('data-id','');

		$json = new JSON();
        $arrayvalues = array();
        foreach( $this->getExtraParamArray() as $varname => $varvalue ) {

			$link->addAttribute('data-extra-'.$varname,$varvalue);
            $arrayvalues[ $varname ] = $varvalue;
		}
		$link->addAttribute('data-extra',str_replace('"',"'",str_replace(array("\t", "\r", "\n"),'',$json->encode($arrayvalues))));

		switch ($this->type)
		{
			case 'post':
				
				// Zusammenbau eines einzeligen JSON-Strings.
				// Aufpassen: Keine doppelten Hochkommas, keine Zeilenumbrüche.
				$data = array();
				
				$data['action'   ] = (!empty($this->action   ))?$this->action   :$this->request->action;
				$data['subaction'] = (!empty($this->subaction))?$this->subaction:$this->request->method;
				$data['id'       ] = (!empty($this->id       ))?$this->id       :'';
				$data[RequestParams::PARAM_TOKEN] = '${_token}';

                foreach( $this->getExtraParamArray() as $varname => $varvalue )
					$data[$varname] = $varvalue;

                $data['none'] = '0';

				$link->addAttribute('data-data',str_replace(array("\t", "\r", "\n"),'',$json->encode($data)));
				break;

			case 'html':
			case 'external':

				$link->addAttribute('href',$this->url);
				break;

			default:
				$link->addAttribute('href','#/'.$this->action.($this->id?'/'.$this->id:'') );

		}

		return $link;
	}

	private function getExtraParamArray()
	{
		$vars = array();
		if (! empty($this->var1))		$vars[$this->var1] = $this->value1;
		if (! empty($this->var2))		$vars[$this->var2] = $this->value2;
		if (! empty($this->var3))		$vars[$this->var3] = $this->value3;
		if (! empty($this->var4))		$vars[$this->var4] = $this->value4;
		if (! empty($this->var5))		$vars[$this->var5] = $this->value5;

		// Bei Dialogen kann der Dialog auch beim Öffnen in einem neuen Fenster direkt geöffnet werden.
		if ( $this->type=='dialog')
			$vars += array('dialogAction'=>$this->action,'dialogMethod'=>$this->subaction);

		return $vars;
	}
}
?>

