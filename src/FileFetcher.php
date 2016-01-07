<?php

namespace FileFetcher;

/**
 * @since 4.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface FileFetcher {

	/**
	 * Returns the contents of the specified file as string, or null if the file is not found.
	 * An exception can be thrown when file access is prevented due to things such as
	 * network outage and insufficient privileges.
	 *
	 * @param string $fileUrl
	 *
	 * @return string|null
	 * @throws FileFetchingException
	 */
	public function fetchFile( $fileUrl );

}
