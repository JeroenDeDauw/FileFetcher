<?php

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\FileFetchingException;

/**
 * @covers FileFetcher\FileFetchingException
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FileFetchingExceptionTest extends \PHPUnit_Framework_TestCase {

	public function testConstructorWithJustAnId() {
		$exception = new FileFetchingException( 'foo bar baz' );

		$this->assertSame( 'foo bar baz', $exception->getFileUrl() );
		$this->assertSame( 'Could not fetch file: foo bar baz', $exception->getMessage() );
	}
}
