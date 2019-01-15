<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use FileFetcher\PsrCacheFileFetcher;
use FileFetcher\ThrowingFileFetcher;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheException;
use Psr\SimpleCache\CacheInterface;

/**
 * @covers \FileFetcher\PsrCacheFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class PsrCacheFileFetcherTest extends TestCase {

	private const FILE_URL = 'foo://bar';
	private const FILE_CONTENT = 'NyanData across the sky!';

	public function testWhenFileIsNotCached_itGetsRetrieved() {
		$cachingFetcher = new PsrCacheFileFetcher(
			new InMemoryFileFetcher( [
				self::FILE_URL => self::FILE_CONTENT
			] ),
			$this->newNullCache()
		);

		$this->assertSame(
			self::FILE_CONTENT,
			$cachingFetcher->fetchFile( self::FILE_URL )
		);
	}

	private function newNullCache(): CacheInterface {
		$cache = $this->createMock( CacheInterface::class );

		$cache->expects( $this->any() )
			->method( 'get' )
			->with( self::FILE_URL )
			->will( $this->returnValue( null ) );

		return $cache;
	}

	public function testWhenFileIsCached_cachedContentsGetsReturned() {
		$cachingFetcher = new PsrCacheFileFetcher(
			new ThrowingFileFetcher(),
			$this->newCacheWithFile()
		);

		$this->assertSame(
			self::FILE_CONTENT,
			$cachingFetcher->fetchFile( self::FILE_URL )
		);
	}

	private function newCacheWithFile(): CacheInterface {
		$cache = $this->createMock( CacheInterface::class );

		$cache->expects( $this->once() )
			->method( 'get' )
			->with( self::FILE_URL )
			->will( $this->returnValue( self::FILE_CONTENT ) );

		return $cache;
	}

	public function testWhenFileIsNotCached_fileContentsGetsCached() {
		$cache = $this->newNullCache();

		$cache->expects( $this->once() )
			->method( 'set' )
			->with(
				$this->equalTo( self::FILE_URL ),
				$this->equalTo( self::FILE_CONTENT )
			);

		$cachingFetcher = new PsrCacheFileFetcher(
			new InMemoryFileFetcher( [
				self::FILE_URL => self::FILE_CONTENT
			] ),
			$cache
		);

		$cachingFetcher->fetchFile( self::FILE_URL );
	}

	public function testWhenFetcherThrowsException_itIsNotCaught() {
		$fetcher = new PsrCacheFileFetcher( new ThrowingFileFetcher(), $this->newNullCache() );

		$this->expectException( FileFetchingException::class );
		$fetcher->fetchFile( self::FILE_URL );
	}

	public function testWhenCacheReadThrowsException_fileContentIsFetched() {
		$cachingFetcher = new PsrCacheFileFetcher(
			new InMemoryFileFetcher( [
				self::FILE_URL => self::FILE_CONTENT
			] ),
			$this->newCacheThatThrowsOnGet()
		);

		$this->assertSame(
			self::FILE_CONTENT,
			$cachingFetcher->fetchFile( self::FILE_URL )
		);
	}

	private function newCacheThatThrowsOnGet(): CacheInterface {
		$cache = $this->createMock( CacheInterface::class );

		$cache->expects( $this->any() )
			->method( 'get' )
			->willThrowException( $this->newCacheException() );

		return $cache;
	}

	private function newCacheException(): \Exception {
		return new class() extends \Exception implements CacheException {
		};
	}

	public function testWhenCacheWriteThrowsException_fileContentIsReturned() {
		$cachingFetcher = new PsrCacheFileFetcher(
			new InMemoryFileFetcher( [
				self::FILE_URL => self::FILE_CONTENT
			] ),
			$this->newCacheThatThrowsOnSet()
		);

		$this->assertSame(
			self::FILE_CONTENT,
			$cachingFetcher->fetchFile( self::FILE_URL )
		);
	}

	private function newCacheThatThrowsOnSet(): CacheInterface {
		$cache = $this->createMock( CacheInterface::class );

		$cache->expects( $this->any() )
			->method( 'set' )
			->willThrowException( $this->newCacheException() );

		return $cache;
	}

}
