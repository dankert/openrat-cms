<?php


namespace dsl;


class DslTemplate
{
	public $tagsFound = 0;
	public $script = null;

	public function parseTemplate( $source ) {

		$this->script    = '';
		$this->tagsFound = 0;

		while( true ) {

			$tagOpen = strpos( $source,'<%' );

			if	( $tagOpen !== false ) {
				$this->tagsFound++;
				$this->addWriteCommand(substr($source,0,$tagOpen),true);
				$source = substr($source,$tagOpen+2);
				$tagClose = strpos( $source,'%>' );
				if   ( $tagClose === false )
					throw new DslParserException('Unclosed script tag');
				$code = substr($source,0,$tagClose);
				if   ( $code[0] == '=' )
					$this->addWriteCommand( substr($code,1) );
				else
					$this->script .= $code."\n";

				$source = substr($source,$tagClose+2);
			}
			else{
				$this->addWriteCommand($source,true);
				break;
			}
		}
	}

	protected function addWriteCommand( $code, $quote = false ) {

		if   ( $quote )
			foreach ( explode("\n",$code) as $line)
				$this->script .= 'write(\''.str_replace('\'','\\\'',$line).'\');'."\n";
		else
			$this->script .= 'write('.$code.');'."\n";

	}
}