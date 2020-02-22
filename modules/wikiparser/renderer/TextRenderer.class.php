<?php

namespace wikiparser\renderer;
use wikiparser\model\LineBreakElement;
use wikiparser\model\RawElement;

/**
 * Dokument-Objekt.<br>
 * Diese Objekt verk�rpert das Root-Objekt in einem DOM-Baum.<br>
 * <br>
 * Dieses Objekt kann Text parsen und seine Unterobjekte selbst erzeugen.<br>
 *
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */
class TextRenderer
{
	var $linkedObjectIds = array();

	/**
	 * Fu�noten.
	 *
	 * @var Array
	 */
	var $footnotes = array();


	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement($child)
	{
		global $conf;

		$className = strtolower(get_class($child));
		$val = '';

		$length = @$conf['editor']['text']['linelength'];
		if (intval($length) == 0)
			$length = 70;

		switch ($className) {
			case 'footnoteelement':

				$nr = 1;
				foreach ($this->footnotes as $fn)
					if (strtolower(get_class($fn)) == 'linebreakelement')
						$nr++;

				$val = $nr;
				if (@$conf['editor']['footnote']['bracket'])
					$val = '(' . $nr . ')';

				if ($nr == 1) {
					$this->footnotes[] = new RawElement("\n\n---\n");
				}
				$this->footnotes[] = new LineBreakElement();
				$this->footnotes[] = new RawElement($val);
				$this->footnotes[] = new RawElement(' ');
				foreach ($child->children as $c)
					$this->footnotes[] = $c;

				$child->children = array();

				break;

			case 'headlineelement':
				$val = "\n" . wordwrap($child->text, $length);
				$val .= str_repeat('-', min($length, strlen($val)));
				break;

			case 'paragraphelement':
				$val = "\n\n";
				break;

			case 'strongelement':

				foreach ($child->children as $c)
					$val .= $this->renderElement($c);
				$val = strtoupper($val);

				$child->children = array();

				break;

			case 'textelement':
				$length = @$conf['editor']['text']['linelength'];
				if (intval($length) == 0)
					$length = 70;
				$val .= wordwrap($child->text, $length);
				break;

			case 'linebreakelement':
				$val .= "\n";
				break;
			default:
		}

		foreach ($child->children as $c) {
			$val .= $this->renderElement($c);
		}

		return $val;

//				die( 'unknown document type: '.$this->type );

	}


	/**
	 * Rendering des Dokumentes.<br>
	 *
	 * @return String
	 */
	function render()
	{
		$this->renderedText = '';
		$this->footnotes = array();

		foreach ($this->children as $child)
			$this->renderedText .= $this->renderElement($child);

		foreach ($this->footnotes as $child)
			$this->renderedText .= $this->renderElement($child);

		return $this->renderedText;
	}
}

?>