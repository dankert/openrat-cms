<?php

/**
 * Erzeugen und Versender einer E-Mail gemaess RFC 822.<br>
 * 
 * @author Jan Dankert
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
	var $nl      = '';
	
	
	
	/**
	 * Konstruktor.
	 */
	function Mail( $to='',$text='common',$xy='' )
	{
		global $conf;
		
		// Zeilenumbruch CR/LF gem. RFC 822.
		$this->nl = chr(13).chr(10);
		
		if	( !empty($conf['mail']['from']) )
			$this->from = $this->header_encode($conf['mail']['from']);

		// Priorität definieren (sofern konfiguriert)
		if	( !empty($conf['mail']['priority']) )
			$this->header[] = 'X-Priority: '.$conf['mail']['priority'];
			
		$this->header[] = 'X-Mailer: '.$this->header_encode(OR_TITLE.' '.OR_VERSION);
		$this->header[] = 'Content-Type: text/plain; charset='.lang( 'CHARSET' );
		$this->subject  = $this->header_encode(lang( 'mail_subject_'.$text ));
		$this->to       = $this->header_encode($to);
		
		$this->text = $this->nl.wordwrap(str_replace(';',$this->nl,lang('mail_text_'.$text)),70,$this->nl).$this->nl;

		// Signatur anhaengen (sofern konfiguriert)
		if	( !empty($conf['mail']['signature']) )
		{
			$this->text .= $this->nl.'-- '.$this->nl;
			$this->text .= str_replace(';',$this->nl,$conf['mail']['signature']);
			$this->text .= $this->nl;
		}
		
		// Kopie-Empfänger
		if	( !empty($conf['mail']['cc']) )
			$this->cc = $this->header_encode($conf['mail']['cc']);

		// Blindkopie-Empfänger
		if	( !empty($conf['mail']['bcc']) )
			$this->bcc = $this->header_encode($conf['mail']['bcc']);
	}



	/**
	 * Kodiert einen Text in das Format "Quoted-printable".<br>
	 * See RFC 2045.
	 */
	function quoted_printable_encode( $text )
	{
		$text = str_replace(' ','=20',$text);
		
		for( $i=128; $i<=255; $i++ )
		{
			$text = str_replace( chr($i),'='.dechex($i),$text );
		}
		
		return $text;
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
	
	
	/**
	 * Umwandlung von 8-bit-Zeichen in MIME-Header gemaess RFC 2047.<br>
	 * Header dürfen nur 7-bit-Zeichen enthalten. 8-bit-Zeichen müssen kodiert werden.
	 */
	function header_encode( $text )
	{
		global $conf;
		
		if	( empty($conf['mail']['header_encoding']) )
			return $text;

		$woerter = explode(' ',$text);
		$neu = array();

		
		foreach( $woerter as $wort )
		{
			$type     = strtolower(substr($conf['mail']['header_encoding'],0,1));
			$neu_wort = '';
			
			if	( $type == 'b' )
				$neu_wort = base64_encode($wort);
			elseif	( $type == 'q' )
				$neu_wort = $this->quoted_printable_encode($wort);
			else
				Logger::error( 'Mail-Configuratin broken: UNKNOWN Header-Encoding type: '.$type);

			if	( strlen($wort)==strlen($neu_wort) )
				$neu[] = $wort;
			else
				$neu[] = '=?'.lang('CHARSET').'?'.$type.'?'.$neu_wort.'?=';
		}
		
		return implode(' ',$neu);
	}
}


?>
