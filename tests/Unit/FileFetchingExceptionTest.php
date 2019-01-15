<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\FileFetchingException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\FileFetchingException
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FileFetchingExceptionTest extends TestCase {

	public function testConstructorWithJustAnId() {
		$exception = new FileFetchingException( 'foo bar baz' );

		$this->assertSame( 'foo bar baz', $exception->getFileUrl() );
		$this->assertSame( 'Could not fetch file: foo bar baz', $exception->getMessage() );
	}
}
