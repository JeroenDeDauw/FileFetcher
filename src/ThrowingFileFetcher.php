<?php

declare( strict_types = 1 );

namespace FileFetcher;

/**
 * @since 4.1
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ThrowingFileFetcher extends InMemoryFileFetcher {

	public function __construct() {
		parent::__construct( [] );
	}

}
