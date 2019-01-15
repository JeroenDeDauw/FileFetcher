<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\StubFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\StubFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class StubFileFetcherTest extends TestCase {

	public function testReturnsStubValue() {
		$this->assertSame( '', ( new StubFileFetcher( '' ) )->fetchFile( 'foo.txt' ) );
		$this->assertSame( 'foo', ( new StubFileFetcher( 'foo' ) )->fetchFile( 'foo.txt' ) );
		$this->assertSame( 'foo bar', ( new StubFileFetcher( 'foo bar' ) )->fetchFile( 'foo.txt' ) );
	}

}
