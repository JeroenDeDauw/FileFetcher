<?php

declare( strict_types = 1 );

namespace FileFetcher;

use Psr\Log\LoggerInterface;

/**
 * @license GNU GPL v2+
 * @author Gabriel Birke < gabriel.birke@wikimedia.de >
 */
class ErrorLoggingFileFetcher implements FileFetcher {

	private $wrappedFileFetcher;
	private $logger;

	public function __construct( FileFetcher $fileFetcher, LoggerInterface $logger ) {
		$this->wrappedFileFetcher = $fileFetcher;
		$this->logger = $logger;
	}

	/**
	 * @see FileFetcher::fetchFile
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string {
		try {
			return $this->wrappedFileFetcher->fetchFile( $fileUrl );
		} catch ( FileFetchingException $e ) {
			$this->logger->error( $e->getMessage(), [
				'exception' => $e
			] );
			throw $e;
		}
	}

}
