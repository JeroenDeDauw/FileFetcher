<?php

declare( strict_types=1 );

namespace FileFetcher;

use InvalidArgumentException;

/**
 * @since 3.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryFileFetcher implements FileFetcher {

	private $files;
	private $defaultContent;

	/**
	 * @param string[] $files
	 * @param string|null $defaultContent Content that is returned when there is no matching entry in $files
	 * @throws InvalidArgumentException
	 */
	public function __construct( array $files, string $defaultContent = null ) {
		foreach ( $files as $url => $fileContents ) {
			if ( !is_string( $url ) || !is_string( $fileContents ) ) {
				throw new InvalidArgumentException( 'Both file url and file contents need to be of type string' );
			}
		}

		$this->files = $files;
		$this->defaultContent = $defaultContent;
	}

	/**
	 * @see FileFetcher::fetchFile
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string {
		if ( array_key_exists( $fileUrl, $this->files ) ) {
			return $this->files[$fileUrl];
		}

		if ( $this->defaultContent === null ) {
			throw new FileFetchingException( $fileUrl );
		}

		return $this->defaultContent;
	}

}
