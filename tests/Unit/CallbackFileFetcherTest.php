<?php

declare( strict_types=1 );

namespace FileFetcher\Tests\Unit;

use FileFetcher\CallbackFileFetcher;
use FileFetcher\FileFetchingException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\CallbackFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class CallbackFileFetcherTest extends TestCase {

	public function testCallbackGetsFileUrlAndReturnValueIsReturned() {
		$fetcher = new CallbackFileFetcher( function( string $fileUrl ) {
			return $fileUrl . $fileUrl . $fileUrl;
		} );

		$this->assertSame( 'SuchSuchSuch', $fetcher->fetchFile( 'Such' ) );
	}

	public function testCallbackExceptionBubblesUp() {
		$fetcher = new CallbackFileFetcher( function( string $fileUrl ) {
			throw new FileFetchingException( $fileUrl );
		} );

		$this->expectException( FileFetchingException::class );
		$fetcher->fetchFile( 'Such' );
	}

}
