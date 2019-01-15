<?php

declare( strict_types = 1 );

namespace FileFetcher;

use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Decorator for FileFetcher objects that profiles file fetching calls using Symfony Stopwatch.
 * https://packagist.org/packages/symfony/stopwatch
 *
 * This class depends on Symfony Stopwatch and can thus only be used when you have symfony/stopwatch loaded.
 *
 * @since 4.6
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class StopwatchFileFetcher implements FileFetcher {

	public const STOPWATCH_CATEGORY = 'file_fetcher';

	private $fileFetcher;
	private $stopwatch;
	private $category;

	public function __construct( FileFetcher $fileFetcher, Stopwatch $stopwatch, string $category = self::STOPWATCH_CATEGORY ) {
		$this->fileFetcher = $fileFetcher;
		$this->stopwatch = $stopwatch;
		$this->category = $category;
	}

	public function fetchFile( string $fileUrl ): string {
		$this->stopwatch->start( $fileUrl, $this->category );

		try {
			$fileContent = $this->fileFetcher->fetchFile( $fileUrl );
		}
		catch ( FileFetchingException $ex ) {
			throw $ex;
		}
		finally {
			$this->stopwatch->stop( $fileUrl );
		}

		return $fileContent;
	}

}
