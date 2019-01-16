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
	private $keyBuilder;

	/**
	 * @param FileFetcher $fileFetcher
	 * @param CacheInterface $cache
	 * @param callable|null $keyBuilderFunction Gets the fileUrl (string) and needs to return a valid cache key (string)
	 */
	public function __construct( FileFetcher $fileFetcher, CacheInterface $cache, callable $keyBuilderFunction = null ) {
		$this->fileFetcher = $fileFetcher;
		$this->cache = $cache;
		$this->keyBuilder = $keyBuilderFunction ?? $this->getDefaultKeyBuilder();
	}

	private function getDefaultKeyBuilder(): callable {
		return function( string $fileUrl ): string {
			return preg_replace(
					'/[^A-Za-z0-9\-]/',
					'_',
					$fileUrl
				)
				. '-' . substr( sha1( $fileUrl ), 0, 5 );
		};
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
			return $this->cache->get( $this->createCacheKey( $fileUrl ) );
		}
		catch ( CacheException $ex ) {
			return null;
		}
	}

	private function createCacheKey( string $fileUrl ): string {
		return ( $this->keyBuilder )( $fileUrl );
	}

	private function retrieveAndCacheFile( $fileUrl ): string {
		$fileContents = $this->fileFetcher->fetchFile( $fileUrl );

		try {
			$this->cache->set( $this->createCacheKey( $fileUrl ), $fileContents );
		}
		catch ( CacheException $ex ) {
		}

		return $fileContents;
	}

}
