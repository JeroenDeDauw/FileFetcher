<?php

namespace FileFetcher;

/**
 * @since 3.0, scalar type hints since 3.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file.
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string;

}
