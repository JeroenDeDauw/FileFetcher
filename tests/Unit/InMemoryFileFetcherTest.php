<?php

declare( strict_types=1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\InMemoryFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryFileFetcherTest extends TestCase {

	public function testWhenEmptyHash_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( [] );

		$this->expectException( FileFetchingException::class );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlNotKnown_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( [
			'http://something.else/entirely' => 'kittens'
		] );

		$this->expectException( FileFetchingException::class );
		$fetcher->fetchFile( 'http://foo.bar/baz' );
	}

	public function testWhenUrlKnown_requestsReturnsValue() {
		$fetcher = new InMemoryFileFetcher( [
			'http://something.else/entirely' => 'kittens',
			'http://foo.bar/baz' => 'cats'
		] );

		$this->assertSame( 'cats', $fetcher->fetchFile( 'http://foo.bar/baz' ) );
	}

	public function testWhenThereIsADefault_itIsUsedForUnknownUrls() {
		$fetcher = new InMemoryFileFetcher( [], 'default kittens' );

		$this->assertSame( 'default kittens', $fetcher->fetchFile( 'http://foo.bar' ) );
	}

	public function testWhenThereIsADefault_itIsNotUsedForKnownUrls() {
		$fetcher = new InMemoryFileFetcher(
			[
				'http://foo.bar' => 'cats'
			],
			'default kittens'
		);

		$this->assertSame( 'cats', $fetcher->fetchFile( 'http://foo.bar' ) );
	}

}
