<?php

/**
 * Erzeugen einer E-Mail.
 */
class Mail
{
	var $from    = '';
	var $to      = '';
	var $bcc     = '';
	var $cc      = '';
	var $subject = '';
	var $text    = '';
	var $header  = array();
	var $nl      = "\n";
	
	
	
	/**
	 * Konstruktor.
	 */
	function Mail( $to='',$text='common',$xy='' )
	{
		global $conf;
		if	( !empty($conf['mail']['from']) )
			$this->from = $conf['mail']['from'];

		$this->header[] = 'X-Mailer: '.OR_TITLE.' '.OR_VERSION;
		$this->subject  = lang( 'mail_subject_'.$text );
		$this->to       = $to;
		
		$this->text = wordwrap(lang('mail_text_'.$text),70,$this->nl);

		// Signatur anhaengen (sofern konfiguriert)
		if	( !empty($conf['mail']['signature']) )
		{
			$this->text .= $this->nl.$this->nl.'-- '.$this->nl;
			$this->text .= str_replace(';',$this->nl,$conf['mail']['signature']);
		}

		// Kopie-Empfänger
		if	( !empty($conf['mail']['cc']) )
			$this->bcc = $conf['mail']['cc'];

		// Blindkopie-Empfänger
		if	( !empty($conf['mail']['bcc']) )
			$this->bcc = $conf['mail']['bcc'];
	}


	/**
	 * Setzen einer Variablen in den Mail-Inhalt.
	 */
	function setVar( $varName,$varInhalt)
	{
		$this->text = str_replace( '{'.$varName.'}', $varInhalt, $this->text );
	}
		

	/**
	 * Mail absenden.
	 */	
	function send()
	{
		// Header um Adressangaben ergänzen.
		if	( !empty($this->from ) )
			$this->header[] = 'From: '.$this->from;
		
		if	( !empty($this->cc ) )
			$this->header[] = 'Cc: '.$this->cc;
		
		if	( !empty($this->bcc ) )
			$this->header[] = 'Bcc: '.$this->bcc;
		
		// Mail versenden
		mail( $this->to,                 // Empfänger
		      lang($this->subject),      // Betreff
		      $this->text,               // Inhalt
		      implode($this->nl,$this->header)  );
	}
}


?>
