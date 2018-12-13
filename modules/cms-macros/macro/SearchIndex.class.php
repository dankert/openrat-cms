<?php

use cms\model\Folder;
use cms\model\Name;
use cms\model\Page;
use cms\model\Project;
use cms\publish\PublishEdit;


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

        $project = new Project( $this->page->projectid );

        $f = new Folder( $project->getRootObjectId() );
        $f->load();

        foreach ($f->getAllSubFolderIds() as $fid) {

            $tf = new Folder($fid);
            $tf->load();
            foreach( $tf->getPages() as $pageid )
            {
                $page = new Page( $pageid );

                // Den einfachen Publisher benutzen, damit nur beschreibbare Inhalte auch in den Index wandern.
                $page->publisher = new PublishEdit();
                $page->load();
                $page->generate();

                $name = $page->getNameForLanguage( $this->page->languageid );

                $searchIndex[] = array(
                    'id'      => $pageid,
                    'title'   => $name->name,
                    'filename'=> $page->filename,
                    'url'     => $this->page->path_to_object( $pageid ),
                    'content' => $this->truncate(array_reduce(
                        $page->values,
                        function($act, $value)
                        {
                            return $act.' '.$value->value;
                        },
                        ''
                    ))
                );
            }
        }

        // Output search index as JSON
        $json = new JSON();
        $this->output( $json->encode( $searchIndex ) );
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