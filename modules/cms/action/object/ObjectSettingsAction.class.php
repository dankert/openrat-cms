<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use language\Messages;
use util\exception\ValidationException;


class ObjectSettingsAction extends ObjectAction implements Method {
    public function view() {
        $this->setTemplateVar('settings',$this->baseObject->settings);

        $this->setTemplateVar( 'valid_from_date' ,$this->baseObject->validFromDate==null?'':date('Y-m-d',$this->baseObject->validFromDate) );
        $this->setTemplateVar( 'valid_from_time' ,$this->baseObject->validFromDate==null?'':date('H:i'  ,$this->baseObject->validFromDate) );
        $this->setTemplateVar( 'valid_until_date',$this->baseObject->validToDate  ==null?'':date('Y-m-d',$this->baseObject->validToDate  ) );
        $this->setTemplateVar( 'valid_until_time',$this->baseObject->validToDate  ==null?'':date('H:i'  ,$this->baseObject->validToDate  ) );
    }


    public function post() {
        $this->baseObject->settings  = $this->getRequestVar( 'settings');

        // Validate YAML-Settings
        try {
            \util\YAML::parse( $this->baseObject->settings);
        }
        catch( \Exception $e )
        {
            throw new ValidationException( 'settings' );
        }

        // Gültigkeitszeiträume speichern.
        if  ($this->hasRequestVar( 'valid_from_date' ))
            $this->baseObject->validFromDate = strtotime( $this->getRequestVar( 'valid_from_date' ).' '.$this->getRequestVar( 'valid_from_time' ) );
        else
            $this->baseObject->validFromDate = null;

        if  ($this->hasRequestVar( 'valid_until_date'))
            $this->baseObject->validToDate   = strtotime( $this->getRequestVar( 'valid_until_date').' '.$this->getRequestVar( 'valid_until_time') );
        else
            $this->baseObject->validToDate = null;


        $this->baseObject->save();

		$this->addNoticeFor( $this->baseObject,Messages::SAVED);
    }
}
