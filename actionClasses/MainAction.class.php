<?php


class MainAction extends Action
{
	var $defaultSubAction = 'show';
	
	function show()
	{
		if	( $this->getRequestVar('callSubaction')!='')
		{
			$this->setSessionVar( $this->getRequestVar('callAction').'action',$this->getRequestVar('callSubaction') );
		}

		$this->setTemplateVar('frame_src_main_menu',Html::url( array('action'=>'mainmenu'                        ,'subaction'=>$this->getRequestVar('callAction'   ) ) ));
		$this->setTemplateVar('frame_src_main_main',Html::url( array('action'=>$this->getRequestVar('callAction'),'subaction'=>$this->getSessionVar( $this->getRequestVar('callAction').'action' ) ) ));
		
		$this->forward('frameset_main');
	}

}


?>