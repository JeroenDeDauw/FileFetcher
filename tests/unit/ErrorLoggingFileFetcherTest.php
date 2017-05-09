<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Phpunit;

use FileFetcher\ErrorLoggingFileFetcher;
use FileFetcher\FileFetcher;
use FileFetcher\FileFetchingException;
use FileFetcher\InMemoryFileFetcher;
use Psr\Log\NullLogger;
use PHPUnit\Framework\TestCase;
use WMDE\PsrLogTestDoubles\LoggerSpy;

/**
 * @license GNU GPL v2+
 * @author Gabriel Birke < gabriel.birke@wikimedia.de >
 */
class ErrorLoggingFileFetcherTest extends TestCase {

	public function testGivenSucceedingFileFetcher_itsContentIsReturned() {
		$logger = new LoggerSpy();
		$errorLoggingFileFetcher = new ErrorLoggingFileFetcher(
			new InMemoryFileFetcher( [ 'song.txt' => 'I\'m a little teapot' ] ),
			$logger
		);
		$this->assertSame( 'I\'m a little teapot', $errorLoggingFileFetcher->fetchFile( 'song.txt' ) );
		$logger->assertNoLoggingCallsWhereMade();
	}

	public function testGivenFailingFileFetcher_anExceptionIsThrown() {

		$wrappedFetcher = $this->createMock( FileFetcher::class );
		$wrappedFetcher->method( 'fetchFile' )->willThrowException( new FileFetchingException( 'song.txt' ) );
		$errorLoggingFileFetcher = new ErrorLoggingFileFetcher(
			new InMemoryFileFetcher( [] ),
			new NullLogger()
		);
		$this->expectException( FileFetchingException::class );
		$errorLoggingFileFetcher->fetchFile( 'song.txt' );

	}

	public function testGivenFailingFileFetcher_theExceptionIsLogged() {
		$exception = new FileFetchingException( 'song.txt' );
		$wrappedFetcher = $this->createMock( FileFetcher::class );
		$wrappedFetcher->method( 'fetchFile' )->willThrowException( $exception );

		$logger = new LoggerSpy();
		$errorLoggingFileFetcher = new ErrorLoggingFileFetcher(
			new InMemoryFileFetcher( [] ),
			$logger
		);

		// @codingStandardsIgnoreStart
		try {
			$errorLoggingFileFetcher->fetchFile( 'song.txt' );
			$this->fail( 'Should have thrown a FileFetchingException' );
		} catch ( FileFetchingException $e ) {
		}
		// @codingStandardsIgnoreEnd

		$calls = $logger->getLogCalls();
		$this->assertCount( 1, $calls );
		$this->assertArrayHasKey( 'exception', $calls->getFirstCall()->getContext() );

	}

}
