<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\NullFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\NullFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class NullFileFetcherTest extends TestCase {

	public function testReturnsEmptyString() {
		$this->assertSame( '', ( new NullFileFetcher() )->fetchFile( 'foo.txt' ) );
	}

}
