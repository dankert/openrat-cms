<?php

/**
 * Erzeugen einer E-Mail.
 */
class Mail
{
	var $from    = '';
	var $to      = '';
	var $bcc     = '';
	var $subject = '';
	var $text    = '';
	var $header  = array();
	
	
	/**
	 * Konstruktor.
	 */
	function Mail( $mail,$subject='USER_MAIL_SUBJECT',$text='' )
	{
		global $conf;
		if	( !empty($conf['mail']['from']) )
			$this->from = $conf['mail']['from'];

		$this->header[] = 'X-Mailer: '.OR_TITLE.' '.OR_VERSION;
		$this->subject  = lang('USER_MAIL_SUBJECT');
		$this->to       = '';
		
		$nl = "\n";
		$this->text = wordwrap(lang($text),70,$nl);

		// Signatur anhaengen (sofern konfiguriert)
		if	( !empty($conf['mail']['signature']) )
		{
			$this->text .= $nl.$nl.'-- '.$nl;
			$this->text .= str_replace(';',$nl,$conf['mail']['signature']);
		}
	}


	/**
	 * Setzen einer Variablen in den Mail-Inhalt.
	 */
	function setVar( $varName,$varInhalt)
	{
		$this->text = str_replace( $varName, $varInhalt, $this->text );
	}
		

	/**
	 * Mail absenden.
	 */	
	function send()
	{
		// Mail versenden
		mail($this->to,lang($this->subject),$this->text,$this->header);
	}
}


?>
