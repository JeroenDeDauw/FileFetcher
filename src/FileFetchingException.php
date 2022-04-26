<?php

declare( strict_types = 1 );

namespace FileFetcher;

/**
 * @since 3.0
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FileFetchingException extends \RuntimeException {

	/**
	 * @var string
	 */
	private $fileUrl;

	public function __construct( string $fileUrl, string $message = null, \Exception $previous = null ) {
		$this->fileUrl = $fileUrl;

		parent::__construct(
			$message ?: 'Could not fetch file: ' . $fileUrl,
			0,
			$previous
		);
	}

	public function getFileUrl(): string {
		return $this->fileUrl;
	}

}
