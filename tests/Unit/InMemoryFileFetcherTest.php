<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Unit;

use InvalidArgumentException;
use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\InMemoryFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryFileFetcherTest extends TestCase {

	public function testWhenEmptyHash_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( [] );
		$invalidFileUrl = 'http://foo.bar/baz';

		$this->expectException( FileFetchingException::class );
		$this->expectExceptionMessage( 'Could not fetch file: ' . $invalidFileUrl );
		$fetcher->fetchFile( $invalidFileUrl );
	}

	public function testWhenUrlNotKnown_requestsCauseException() {
		$fetcher = new InMemoryFileFetcher( [
			'http://something.else/entirely' => 'kittens'
		] );
		$invalidFileUrl = 'http://foo.bar/baz';

		$this->expectException( FileFetchingException::class );
		$this->expectExceptionMessage( 'Could not fetch file: ' . $invalidFileUrl );
		$fetcher->fetchFile( $invalidFileUrl );
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

	public function testWhenFilesAreNotStringType() {
		$this->expectException( InvalidArgumentException::class );
		$this->expectExceptionMessage( 'Both file url and file contents need to be of type string' );

		new InMemoryFileFetcher(
			[
				'http://foo.bar' => 1000,
			],
			'default kittens'
		);
	}

}
