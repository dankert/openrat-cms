<?php

namespace wikiparser\renderer;
use util\Text;

/**
 * Renderer fuer das LaTex-Format.
 *
 * Diese Klasse erzeugt aus dem internen DOM-Baum ein LaTex-Dokument.
 *
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */
class LatexRenderer
{
	var $linkedObjectIds = array();

	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement($child)
	{
		global $conf;

		$val = '';
		$before = '';
		$after = '';

		switch (strtolower(get_class($child))) {
			case 'tableofcontentelement':
				$before = '\tableofcontents' . "\n";
				break;

			case 'rawelement':
				$tag = '';
				$val = $child->src;

				break;

			case 'textelement':
				$val = $child->text;
				//$val = Text::encodeHtml( $val );
				$val = Text::replaceHtmlChars($val);
				break;

			case 'footnoteelement':
				$before = '\footnote{';
				$after = '}';
				break;

			case 'codeelement':

				break;

			case 'quoteelement':
				break;


			case 'paragraphelement':
				$before = "\n";
				break;

			case 'speechelement':

				break;

			case 'linebreakelement':
				$after = '\\';
				break;

			case 'linkelement':
				// Ggf. Hyperref-Paket verwenden.
				break;

			case 'imageelement':
				break;

			case 'strongelement':
				$before = '\textbf{';
				$after = '}';
				break;

			case 'emphaticelement':
				$before = '\textit{';
				$after = '}';
				break;

			case 'insertedelement':
				$before = '';
				$after = '';
				break;

			case 'removedelement':
				$before = '';
				$after = '';
				break;

			case 'headlineelement':

				switch ($child->level) {
					case 1:
						$before = '\section';
						break;
					case 2:
						$before = '\subsection';
						break;
					case 3:
					default:
						$before = '\subsubsection';
						break;
				}
				$before .= '{';
				$after = '}';
				break;

			case 'tableelement':
				$before = '\begin{tabular}' . "\n";
				$after = '\end{tabular}' . "\n";
				break;

			case 'tablelineelement':
				$before = '';
				$after = '\\';
				break;

			case 'definitionlistelement':
				break;

			case 'definitionitemelement':
				break;

			case 'macroelement':
				break;

			case 'tablecellelement':
				$before = '';
				$after = ' & ';
				break;

			case 'listelement':
				$before = '\begin{itemize}' . "\n";
				$after = '\end{itemize}' . "\n";
				break;

			case 'teletypeelement':
				$before = '\texttt{';
				$after = '}';
				break;

			case 'numberedlistelement':
				$before = '\begin{itemize}' . "\n";
				$after = '\end{itemize}' . "\n";
				break;

			case 'listentryelement':
				$before = '\item ';
				break;

			default:

				$tag = 'unknown-element';
				$attr['class'] = strtolower(get_class($child));
				break;
		}

		$val .= $before;
		foreach ($child->children as $c) {
			$val .= $this->renderElement($c);
		}
		$val .= $after;

		return $val;
	}


	/**
	 * Rendering des Dokumentes.<br>
	 *
	 * @return String
	 */
	function render()
	{
		$this->renderedText = '';
		$this->renderedText .= '\documentclass{article}' . "\n";
		$this->renderedText .= '\begin{document}' . "\n";

		foreach ($this->children as $child)
			$this->renderedText .= $this->renderElement($child);

		$this->renderedText .= '\end{document}' . "\n";

		return $this->renderedText;
	}
}

?>