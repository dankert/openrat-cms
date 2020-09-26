<?php

namespace util\cache;

use cms\base\DB;
use util\FileUtils;


/**
 * File-based cache.
 */
class FileCache implements Cache
{
	const CACHE_FILENAME_PREFIX = 'openrat-cache';
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
        if   ( !is_array($key))
        	$key = [ $key ];
        $key = array_merge([ DB::get()->id ], $key);

        $filename  = FileUtils::getTempDir() . '/'. self::CACHE_FILENAME_PREFIX;
        $filename .= array_reduce($key,function($carry,$item){
        	return $carry.'-'.$item;
		});
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
     * Get the content. Loads the value if nessecary.
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

        return $this;
    }


	/**
	 * Refreshes the cache.
	 * @return $this
	 */
    public function refresh() {

		file_put_contents($this->filename,call_user_func($this->loader) );

		return $this;
	}


    public function getFilename() {
        return $this->filename;
    }

}