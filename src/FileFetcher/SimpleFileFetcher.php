<?php

namespace FileFetcher;

/**
 * Adapter around file_get_contents.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleFileFetcher implements FileFetcher {

	public function fetchFile( $fileUrl ) {
		return file_get_contents( $fileUrl );
	}

}
