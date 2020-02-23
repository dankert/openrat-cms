<?php
/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 10.08.18
 * Time: 23:33
 */
// UNUSED?
class FilePublisher
{
    public function publish()
    {
        if	( ! is_object($this->publish) )
            $this->publish = new \Publish();

        $this->write();
        $this->publish->copy( $this->tmpfile(),$this->full_filename(),$this->lastchangeDate );

        $this->publish->publishedObjects[] = $this->getProperties();
    }

}