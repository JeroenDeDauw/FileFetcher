<?php

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\InMemoryFileFetcher;

/**
 * @covers FileFetcher\InMemoryFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryFileFetcherTest extends \PHPUnit_Framework_TestCase {

	public function testWhenEmptyHash_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( array() );

		$this->setExpectedException( 'FileFetcher\FileFetchingException' );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlNotKnown_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( array(
			'http://something.else/entirely' => 'kittens'
		) );

		$this->setExpectedException( 'FileFetcher\FileFetchingException' );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlKnown_requestsReturnsValue() {
		$fetcher = new InMemoryFileFetcher( array(
			'http://something.else/entirely' => 'kittens',
			'http://foo.bar/baz' => 'cats'
		) );

		$this->assertSame( 'cats', $fetcher->fetchFile( 'http://foo.bar/baz' ) );
	}

}
