<?php

namespace FileFetcher;

/**
 * @since 1.0
 * @ingroup FileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file.
	 *
	 * @since 1.0
	 *
	 * @param string $fileUrl
	 *
	 * @return string
	 */
	public function fetchFile( $fileUrl );

}
