<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Permission;
use language\Messages;
use template_engine\components\html\component_else\ElseComponent;
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
        $this->baseObject->settings  = $this->request->getText( 'settings');

        // Validate YAML-Settings
        try {
            \util\YAML::parse( $this->baseObject->settings);
        }
        catch( \Exception $e )
        {
			$this->addWarningFor( $this->baseObject,"Invalid YAML");
            throw new ValidationException( 'settings' );
        }

        // Gültigkeitszeiträume speichern.
        $this->baseObject->validFromDate = $this->toTimestamp(
			$this->request->getText( 'valid_from_date' ),
			$this->request->getText( 'valid_from_time' )
		);

		$this->baseObject->validToDate = $this->toTimestamp(
			$this->request->getText( 'valid_until_date'),
			$this->request->getText( 'valid_until_time')
		);


        $this->baseObject->save();

		$this->addNoticeFor( $this->baseObject,Messages::SAVED);
    }


	protected function toTimestamp( $date, $time ) {
		if   ( $date && $time )
			return strtotime( $date.' '.$time );
		if   ( $date )
			return strtotime( $date );
		else
			return null;
	}


	/**
	 * @return int Permission-flag.
	 */
	public function getRequiredPermission() {
		return Permission::ACL_PROP;
	}


}
