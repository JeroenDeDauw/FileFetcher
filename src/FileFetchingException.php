<?php

namespace FileFetcher;

/**
 * @since 3.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FileFetchingException extends \RuntimeException {

	private $fileUrl;

	public function __construct( $fileUrl, $message = null, \Exception $previous = null ) {
		$this->fileUrl = $fileUrl;

		parent::__construct(
			$message ?: 'Could not fetch file: ' . $fileUrl,
			0,
			$previous
		);
	}

	/**
	 * @return string
	 */
	public function getFileUrl() {
		return $this->fileUrl;
	}

}
