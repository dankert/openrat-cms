<?php

namespace util\cache;

use util\FileUtils;


/**
 * Simple Cache for caching of generated content.
 *
 * @package util
 */
class FileCache
{
    /**
     * @var Callable
     */
    private $loader;

    /**
     * @var string
     */
    private $filename;

    /**
     * Creates a new Cache entry.
     *
     * @param $key array Cache-Key
     * @param $loader Callable
     */
    public function __construct( $key, $loader, $lastModified = 0 )
    {
        $filename = FileUtils::getTempDir() . '/'. 'openrat-cache';

        if   ( is_array($key))
            foreach ($key as $a => $w)
                $filename .= '.' . $a .'-'. $w;
        else
            $filename .= strval($key);

        $filename .= '.tmp';

        $this->filename = $filename;
        $this->loader   = $loader;

        if   ( config()->subset('publishing')->is('cache_enabled',false) )
            $this->invalidateIfOlderThan( $lastModified );
        else
            $this->invalidateIfOlderThan( START_TIME ); // Invalidate all before this request.
    }


    public function invalidateIfOlderThan($lastModified) {

        if   ( is_file($this->filename) && filemtime($this->filename) < $lastModified )
            $this->invalidate();
    }


    /**
     * Invalidates a cache entry.
     */
    public function invalidate() {

        if   ( is_file($this->filename))
            // Should use '@' here to deny race conditions, where another request is calling this method.
            @unlink( $this->filename);
    }


    /**
     * Get the content.
     */
    public function get() {

        if   ( ! is_file($this->filename)) {
            file_put_contents($this->filename,call_user_func($this->loader) );
        }

        return file_get_contents($this->filename);
    }


    /**
     * Get the content.
     */
    public function load() {

        if   ( ! is_file($this->filename)) {
            file_put_contents($this->filename,call_user_func($this->loader) );
        }
    }


    public function getFilename() {
        return $this->filename;
    }

}