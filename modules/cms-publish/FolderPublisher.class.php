<?php
/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 10.08.18
 * Time: 23:35
 */

class FolderPublisher
{
    function publish( $withPages,$withFiles,$subdirs = false )
    {
        set_time_limit(300);
        if	( ! is_object($this->publish) )
            $this->publish = new \Publish();

        foreach( $this->getObjectIds() as $oid )
        {
            $o = new BaseObject( $oid );
            $o->objectLoadRaw();

            if	( $o->isPage && $withPages )
            {
                $p = new Page( $oid );
                $p->load();
                $p->publish = &$this->publish;
                $p->publish();
            }

            if	( $o->isFile && $withFiles )
            {
                $f = new File( $oid );
                $f->load();
                $f->publish = &$this->publish;
                $f->publish();
            }

            if	( $o->isImage && $withFiles )
            {
                $f = new Image( $oid );
                $f->load();
                $f->publish = &$this->publish;
                $f->publish();
            }

            if	( $o->isText && $withFiles )
            {
                $f = new Text( $oid );
                $f->load();
                $f->publish = &$this->publish;
                $f->publish();
            }

            if	( $o->isFolder && $subdirs )
            {
                $f = new Folder( $oid );
                $f->load();
                $f->publish = &$this->publish;
                $f->publish( $withPages,$withFiles,true );
            }
        }
    }


}