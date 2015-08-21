<?php

namespace FileFetcher;

/**
 * Adapter around file_get_contents.
 *
 * @since 3.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleFileFetcher implements FileFetcher {

	/**
	 * @see FileFetcher::fetchFile
	 *
	 * @param string $fileUrl
	 *
	 * @return string
	 * @throws FileFetchingException
	 */
	public function fetchFile( $fileUrl ) {
		$fileContent = @file_get_contents( $fileUrl );

		if ( is_string( $fileContent ) ) {
			return $fileContent;
		}

		throw new FileFetchingException( $fileUrl );
	}

}
