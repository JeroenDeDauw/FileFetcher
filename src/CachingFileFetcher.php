<?php

declare( strict_types = 1 );

namespace FileFetcher;

use SimpleCache\Cache\Cache;

/**
 * Decorator that caches files using jeroen/simple-cache.
 * https://packagist.org/packages/jeroen/simple-cache
 *
 * Requires jeroen/simple-cache which is not loaded by default as of version 5.0
 *
 * See also: PsrCacheFileFetcher, which does the same thing, but with the more popular psr/simple-cache
 *
 * @since 3.0
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CachingFileFetcher implements FileFetcher {

	private $fileFetcher;
	private $cache;

	public function __construct( FileFetcher $fileFetcher, Cache $cache ) {
		$this->fileFetcher = $fileFetcher;
		$this->cache = $cache;
	}

	/**
	 * @see FileFetcher::fetchFile
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string {
		$fileContents = $this->cache->get( $fileUrl );

		if ( $fileContents === null ) {
			return $this->retrieveAndCacheFile( $fileUrl );
		}

		return $fileContents;
	}

	private function retrieveAndCacheFile( $fileUrl ): string {
		$fileContents = $this->fileFetcher->fetchFile( $fileUrl );

		$this->cache->set( $fileUrl, $fileContents );

		return $fileContents;
	}

}
