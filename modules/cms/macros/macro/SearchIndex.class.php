<?php
namespace cms\macros\macro;

use cms\generator\PageContext;
use cms\generator\ValueContext;
use cms\generator\ValueGenerator;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use util\json\JSON;
use util\Macro;


/**
 * Creates a search index for all pages in this project.
 * @author Jan Dankert
 */
class SearchIndex extends Macro
{
    /**
     * Beschreibung dieser Klasse
     *
     * @type String
     */
    var $description = '';

    public $maxLength = 300;


    /**
     * Creates a search index for alle pages in the current project.
     */
    function execute()
    {
        $searchIndex = array();

        $project = new Project( $this->getPage()->projectid );

        $f = new Folder( $project->getRootObjectId() );
        $f->load();

        foreach ( array_merge( [$f],$f->getAllSubFolderIds() ) as $fid) {

            $tf = new Folder($fid);
            $tf->load();
            foreach( $tf->getPages() as $pageObjectId )
            {
                $page = new Page( $pageObjectId );
                $page->load();

                // Generating all values
                $values = [];
				/** @var Element $element */
				foreach($page->getWritableElements() as $element ) {
					$pageContext = clone $this->pageContext;
					$pageContext->objectId = $pageObjectId;
                	$valueContext = new ValueContext($pageContext);
                	$valueContext->elementid = $element->elementid;
                	$generator = new ValueGenerator( $valueContext );
                	$values[] = $generator->getCache()->get();
					//$values[] = print_r($valueContext,true);
				}

                $name = $page->getNameForLanguage( $this->pageContext->languageId );

                $searchIndex[] = array(
                    'id'      => $pageObjectId,
                    'title'   => $name->name,
                    'filename'=> $page->filename,
                    'url'     => $this->pathToObject( $pageObjectId ),
                    'content' => $this->truncate(array_reduce(
                        $values,
                        function($act, $value)
                        {
                            return $act.' '.$value;
                        },
                        ''
                    ))
                );
            }
        }

        // Output search index as JSON
        echo JSON::encode( $searchIndex );
    }


    private function truncate( $text) {
        $text = str_replace('&quot;','',$text);
        $text = str_replace('&lt;'  ,'',$text);
        $text = str_replace('&rt;'  ,'',$text);
        $text = strtr($text,';,:.\'"','      ');
        $text = strtr($text,'  ',' ');
        if   ( strlen($text) > $this->maxLength )
            $text = mb_substr($text,0,$this->maxLength,'UTF-8');

        return $text;
    }

}