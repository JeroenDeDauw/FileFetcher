<?php

declare( strict_types=1 );

namespace FileFetcher;

/**
 * Callback adapter. Calls to fetchFile are routed to the callback.
 *
 * @since 4.4
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CallbackFileFetcher implements FileFetcher {

	private $callback;

	/**
	 * The callback should have the same signature and contract as @see FileFetcher::fetchFile()
	 * Note that this contract include not throwing exceptions other than FileFetchingException.
	 *
	 * @param callable $callback
	 */
	public function __construct( callable $callback ) {
		$this->callback = $callback;
	}

	public function fetchFile( string $fileUrl ): string {
		return ($this->callback)( $fileUrl );
	}

}
