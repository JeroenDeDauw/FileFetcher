<?php

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use FileFetcher\SpyingFileFetcher;

/**
 * @covers FileFetcher\SpyingFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SpyingFileFetcherTest extends \PHPUnit_Framework_TestCase {

	public function testReturnsResultOfDecoratedFetcher() {
		$innerFetcher = new InMemoryFileFetcher( [
			'url' => 'content'
		] );

		$spyingFetcher = new SpyingFileFetcher( $innerFetcher );

		$this->assertSame( 'content', $spyingFetcher->fetchFile( 'url' ) );

		$this->expectException( FileFetchingException::class );
		$spyingFetcher->fetchFile( 'foo' );
	}

	public function testWhenNoCalls_getFetchedUrlsReturnsEmptyArray() {
		$innerFetcher = new InMemoryFileFetcher( [
			'url' => 'content'
		] );

		$spyingFetcher = new SpyingFileFetcher( $innerFetcher );

		$this->assertSame( [], $spyingFetcher->getFetchedUrls() );
	}

	public function testWhenSomeCalls_getFetchedUrlsReturnsTheArguments() {
		$innerFetcher = new InMemoryFileFetcher( [
			'url' => 'content',
			'foo' => 'bar'
		] );

		$spyingFetcher = new SpyingFileFetcher( $innerFetcher );
		$spyingFetcher->fetchFile( 'url' );
		$spyingFetcher->fetchFile( 'foo' );
		$spyingFetcher->fetchFile( 'url' );

		$this->assertSame( [ 'url', 'foo', 'url' ], $spyingFetcher->getFetchedUrls() );
	}

	public function testCallsCausingExceptionsGetRecorded() {
		$innerFetcher = new InMemoryFileFetcher( [] );

		$spyingFetcher = new SpyingFileFetcher( $innerFetcher );

		try {
			$spyingFetcher->fetchFile( 'url' );
		}
		catch ( FileFetchingException $ex ) {
		}

		try {
			$spyingFetcher->fetchFile( 'foo' );
		}
		catch ( FileFetchingException $ex ) {
		}

		$this->assertSame( [ 'url', 'foo' ], $spyingFetcher->getFetchedUrls() );
	}

}
