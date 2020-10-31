<?php

namespace util\cache;

use cms\base\Configuration as C;
use cms\base\DB;
use cms\base\Startup;
use util\FileUtils;


/**
 * File-based cache.
 */
class FileCache implements Cache
{
	const CACHE_FILENAME_PREFIX = 'openrat-cache';

	/**
	 * A loader which gets the value
     * @var Callable
     */
    private $loader;

    /**
	 * Filename of the cache.
	 *
     * @var string
     */
    private $filename;

    /**
     * Creates a new Cache entry.
     *
     * @param $key array|string Cache-Key
     * @param $loader Callable
     */
    public function __construct( $key, $loader, $lastModified = 0 )
    {
        if   ( !is_array($key))
        	$key = [ (string) $key ];
        $key = array_merge([ DB::get()->id ], $key);

        $filename  = FileUtils::getTempDir() . '/'. self::CACHE_FILENAME_PREFIX;
        $filename .= array_reduce($key,function($carry,$item){
        	return $carry.'-'.$item;
		});
        $filename .= '.tmp';

        $this->filename = $filename;
        $this->loader   = $loader;

        if   ( C::subset('publishing')->is('cache_enabled',false) )
            $this->invalidateIfOlderThan( $lastModified );
        else
            $this->invalidateIfOlderThan( Startup::getStartTime() ); // Invalidate all before this request.
    }


	/**
	 * Invalidates the cache entry, if it is older than a specific date.
	 * @param $invalidateIfOlderDate
	 */
	public function invalidateIfOlderThan($invalidateIfOlderDate) {

        if   ( is_file($this->filename) && filemtime($this->filename) < $invalidateIfOlderDate )
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
     * Makes sure that the value is loaded.
	 *
	 * @return FileCache
     */
    public function load() {

        if   ( ! is_file($this->filename)) {
            file_put_contents($this->filename,call_user_func($this->loader) );
        }

        return $this;
    }


	/**
	 * Refreshes the cache.
	 *
	 * @return $this
	 */
    public function refresh() {

		file_put_contents($this->filename,call_user_func($this->loader) );

		return $this;
	}


	/**
	 * Gets the filename of the cache value.
	 * Warning: The file may not exist. If you want to make sure that the file exists, you have to call #load() first.
	 *
	 * @return string filename of cache content
	 */
    public function getFilename() {
        return $this->filename;
    }

}