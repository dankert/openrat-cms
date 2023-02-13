<?php
namespace cms\generator\filter;

use cms\generator\PageContext;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Page;
use util\YAML;

/**
 * Filter for creating a sitemap.
 *
 * @author Jan Dankert
 */
class SitemapFilter extends AbstractFilter
{

	public function filter($value)
	{
		$config = YAML::parse( $value );
		$output = '';
		$all = $this->getAll();

		$thispage = new BaseObject( $this->context->getObjectId() );
		$thispage->load(); // Seite laden
		$project = $thispage->getProject();
		$lids = $project->getLanguageISOCodes();

		if   ( @$config['format'] == 'text' ) {
			foreach ( $all as $page )
				$output .= $this->context->getLinkScheme()->linkToObject( new BaseObject((new BaseObject( $this->context->getObjectId() ))->load()->getProject()->getRootObjectId()),(new BaseObject($page))->load() );
		} else {
			// Fallback: XML
			$output .= '<?xml version="1.0" encoding="UTF-8"?>'."\n";
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">'."\n";
			foreach ( $all as $page ) {

				$targetPage = (new BaseObject($page))->load();
				$output .= '<url>'."\n";
				$output .= '<loc>';

				$output .= $this->context->getLinkScheme()->linkToObject( new BaseObject((new BaseObject( $this->context->getObjectId() ))->load()->getProject()->getRootObjectId()),$targetPage );
				$output .= '</loc>'."\n";
				foreach( $lids as $lid => $isoCode )
				{
					$pageContext = new PageContext( $this->context->getObjectId(),$this->context->scheme );
					$pageContext->languageId = $lid;
					$output .= '<xhtml:link';
					$output .= ' rel="alternative"';
					$output .= ' hreflang="'.$isoCode.'"';
					$output .= ' href="'.$pageContext->getLinkScheme()->linkToObject( new BaseObject((new BaseObject( $this->context->getObjectId() ))->load()->getProject()->getRootObjectId()),$targetPage ).'"';
					$output .= '/>'."\n";
				}
				$output .= '</url>'."\n";
			}
			$output .= '</urlset>';

		}
		return $output;
	}


	protected function getAll()
	{
		// Erstellen eines Untermenues

		// Ermitteln der aktuellen Seite
		$thispage = new BaseObject( $this->context->getObjectId() );
		$thispage->load(); // Seite laden

		// uebergeordneter Ordner dieser Seite
		$rootFolder = new Folder( $thispage->getProject()->getRootObjectId() );
		$allPages = $rootFolder->getObjectIds();
		return $allPages;
	}

	protected function showFolder( $oid )
	{
		// uebergeordneter Ordner dieser Seite
		$f = new Folder($oid);

		// Schleife ueber alle Objekte im aktuellen Ordner
		foreach ($f->getObjectIds() as $id) {
			$o = new BaseObject($id);
			$o->load();

			// Ordner
			if ($o->isFolder) {
				$this->output('<li><strong>' . $o->getNameForLanguage($this->pageContext->languageId)->name . '</strong><br/>');
				$this->output('<ul>');
				$this->showFolder($id); // Rekursiver Aufruf dieser Methode
				$this->output('</ul></li>');
			}

			// Seiten und Verkn?fpungen
			if ($o->isPage || $o->isLink) {
				// Wenn aktuelle Seite, dann markieren, sonst Link
				if ($this->getObjectId() == $id) {
					// aktuelle Seite
					$this->output('<li><strong>' . $o->getNameForLanguage($this->pageContext->languageId)->name . '</strong></li>');
				} else {
					// Link erzeugen
					$this->output('<li><a href="' . $this->pathToObject($id) . '">' . $o->getNameForLanguage($this->pageContext->languageId)->name . '</a></li>');
				}
			}
		}
	}
}