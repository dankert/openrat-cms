<?php

namespace util;

use FileUtils;


/**
 * Simple Cache for caching of generated content.
 *
 * @package util
 */
class LoaderCache
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
    public function __construct( $key, $loader )
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
    }


    /**
     * Invalidates a cache entry.
     */
    public function invalidate() {

        if   ( is_file($this->filename))
            unlink( $this->filename);
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