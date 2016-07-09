<?php

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\CachingFileFetcher;

/**
 * @covers FileFetcher\CachingFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CachingFileFetcherTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {
		$fileFetcher = $this->createMock( 'FileFetcher\FileFetcher' );
		$cache = $this->createMock( 'SimpleCache\Cache\Cache' );

		new CachingFileFetcher( $fileFetcher, $cache );

		$this->assertTrue( true );
	}

	public function testGetFileWhenNotCached() {
		$fileUrl = 'foo://bar';
		$fileContents = 'NyanData across the sky!';

		$fileFetcher = $this->createMock( 'FileFetcher\FileFetcher' );

		$fileFetcher->expects( $this->once() )
			->method( 'fetchFile' )
			->with( $fileUrl )
			->will( $this->returnValue( $fileContents ) );

		$cache = $this->createMock( 'SimpleCache\Cache\Cache' );

		$cache->expects( $this->once() )
			->method( 'get' )
			->with( $fileUrl )
			->will( $this->returnValue( null ) );

		$cache->expects( $this->once() )
			->method( 'set' )
			->with( $fileUrl );

		$cachingFetcher = new CachingFileFetcher( $fileFetcher, $cache );
		$cachingFetcher->fetchFile( $fileUrl );
	}

	public function testGetFileWhenCached() {
		$fileUrl = 'foo://bar';
		$fileContents = 'NyanData across the sky!';

		$fileFetcher = $this->createMock( 'FileFetcher\FileFetcher' );

		$fileFetcher->expects( $this->never() )
			->method( 'fetchFile' );

		$cache = $this->createMock( 'SimpleCache\Cache\Cache' );

		$cache->expects( $this->once() )
			->method( 'get' )
			->with( $fileUrl )
			->will( $this->returnValue( $fileContents ) );

		$cache->expects( $this->never() )
			->method( 'set' );

		$cachingFetcher = new CachingFileFetcher( $fileFetcher, $cache );
		$cachingFetcher->fetchFile( $fileUrl );
	}

}
