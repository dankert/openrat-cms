<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\action\TextAction;
use cms\generator\PublishEdit;
use cms\generator\PublishPreview;
use cms\model\Value;
use util\exception\ValidationException;
use util\Text;

class TextDiffAction extends TextAction implements Method {

    public function view() {
        $value1id = $this->request->getNumber('compareid');
        $value2id = $this->request->getNumber('withid'   );

        // Wenn Value1-Id = Value2-Id
        if	( $value1id == $value2id )
        	throw new ValidationException('withid' );

        // Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
        if	( $value1id > $value2id )
        list($value1id,$value2id) = array( $value2id,$value1id );


        $value1 = new Value();
        $value2 = new Value();
		$value1->loadWithId( $value1id );
		$value2->loadWithId( $value2id );

        $this->setTemplateVar('date_left' ,$value1->lastchangeTimeStamp);
        $this->setTemplateVar('date_right',$value2->lastchangeTimeStamp);

        $text1 = explode("\n",$value1->file);
        $text2 = explode("\n",$value2->file);

        // Unterschiede feststellen.
        $diffResult = Text::diff($text1,$text2);

        $outputResult = array_map( function( $left,$right) {
        	return [
        		'left' => $left,
				'right'=> $right
			];
		},$diffResult[0],$diffResult[1] );

        $this->setTemplateVar('diff',$outputResult );
    }


    public function post() {
    }
}
