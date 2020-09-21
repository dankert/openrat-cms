<?php

namespace util\cache;


/**
 * Cache.
 */
interface Cache
{
    public function invalidateIfOlderThan($lastModified);

    /**
     * Invalidates a cache entry.
     */
    public function invalidate();

    /**
     * Get the content. Loads the value if nessecary.
     */
    public function get();

    /**
     * Loads the content.
	 * @return $this
     */
    public function load();

    /**
     * Refreshes the cache.
     * @return $this
     */
    public function refresh();

	/**
	 * Getting only the filename of the cache.
	 * @return string
	 */
    public function getFilename();
}