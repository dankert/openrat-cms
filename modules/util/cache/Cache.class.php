<?php

namespace util\cache;


/**
 * Cache.
 */
interface Cache
{
    public function invalidateIfOlderThan($invalidateIfOlderDate);

    /**
     * Invalidates a cache entry.
     */
    public function invalidate();

    /**
     * Get the content. Loads the value if nessecary.
	 * @return string
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