<?php

declare( strict_types = 1 );

namespace FileFetcher;

use Psr\SimpleCache\CacheException;
use Psr\SimpleCache\CacheInterface;

/**
 * Decorator that caches files using psr/simple-cache.
 * https://packagist.org/packages/psr/simple-cache
 *
 * @since 5.0
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PsrCacheFileFetcher implements FileFetcher {

	private $fileFetcher;
	private $cache;

	public function __construct( FileFetcher $fileFetcher, CacheInterface $cache ) {
		$this->fileFetcher = $fileFetcher;
		$this->cache = $cache;
	}

	/**
	 * @see FileFetcher::fetchFile
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string {
		$fileContents = $this->getFileContentsFromCache( $fileUrl );

		if ( $fileContents === null ) {
			return $this->retrieveAndCacheFile( $fileUrl );
		}

		return $fileContents;
	}

	private function getFileContentsFromCache( string $fileUrl ): ?string {
		try {
			return $this->cache->get( $fileUrl );
		}
		catch ( CacheException $ex ) {
			return null;
		}
	}

	private function retrieveAndCacheFile( $fileUrl ): string {
		$fileContents = $this->fileFetcher->fetchFile( $fileUrl );

		try {
			$this->cache->set( $fileUrl, $fileContents );
		}
		catch ( CacheException $ex ) {
		}

		return $fileContents;
	}

}
