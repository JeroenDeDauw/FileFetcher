<?php

namespace FileFetcher;

/**
 * @since 3.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file.
	 *
	 * @since 3.0
	 *
	 * @param string $fileUrl
	 *
	 * @return string
	 * @throws FileFetchingException
	 */
	public function fetchFile( $fileUrl );

}
