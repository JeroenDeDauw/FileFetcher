<?php

declare( strict_types=1 );

namespace FileFetcher\Tests\Integration;

use FileFetcher\LazyStubFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\LazyStubFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyStubFileFetcherTest extends TestCase {

	public function testCallbackGetsFileUrlAndReturnValueIsReturned() {
		$this->assertSame(
			file_get_contents( __FILE__ ),
			LazyStubFileFetcher::newFromFileUrl( __FILE__ )->fetchFile( 'Whatever' )
		);
	}

}
