<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\generator\PublishEdit;
use cms\generator\PublishPreview;
use cms\model\Value;
use util\exception\ValidationException;
use util\Text;

class PageelementDiffAction extends PageelementAction implements Method {

    public function view() {
        $value1id = $this->request->getNumber('compareid');
        $value2id = $this->request->getNumber('withid'   );

        // Wenn Value1-Id = Value2-Id
        if	( $value1id == $value2id )
        	throw new ValidationException('withid' );

        // Value 2 must be greater than value 1.
        if	( $value1id > $value2id )
        	list($value1id,$value2id) = array( $value2id,$value1id );

        $value1 = new Value();
        $value2 = new Value();

        $value1->loadWithId( $value1id );
        $value2->loadWithId( $value2id );

		// both values must be part of the same content.
		if   ( $value1->contentid != $value2->contentid )
			throw new ValidationException('compareid');

		// Security-Check:
		// Content must be a part of the page.
		$this->ensureContentIdIsPartOfPage( $value1->contentid );

        $this->setTemplateVar('date_left' ,$value1->lastchangeTimeStamp);
        $this->setTemplateVar('date_right',$value2->lastchangeTimeStamp);

		// Split whole text into lines.
        $text1 = explode("\n",$value1->text);
        $text2 = explode("\n",$value2->text);

        // Make the diff
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
