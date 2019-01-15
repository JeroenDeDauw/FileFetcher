<?php

declare( strict_types = 1 );

namespace FileFetcher;

/**
 * @since 4.4
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyStubFileFetcher {

	private function __construct() {
	}

	public static function newFromFileUrl( string $fileUrl ): FileFetcher {
		$fetcher = new SimpleFileFetcher();

		return new CallbackFileFetcher( function() use ( $fetcher, $fileUrl ) {
			return $fetcher->fetchFile( $fileUrl );
		} );
	}

}
