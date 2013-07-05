<?php

namespace FileFetcher;

/**
 * @file
 * @since 0.1
 * @ingroup FileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file.
	 *
	 * @since 0.1
	 *
	 * @param string $fileUrl
	 *
	 * @return string
	 */
	public function fetchFile( $fileUrl );

}
