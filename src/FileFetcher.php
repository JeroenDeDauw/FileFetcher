<?php

declare( strict_types = 1 );

namespace FileFetcher;

/**
 * @since 3.0, scalar type hints since 4.0
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file.
	 * @throws FileFetchingException
	 */
	public function fetchFile( string $fileUrl ): string;

}
