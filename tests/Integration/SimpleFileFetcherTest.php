<?php

declare( strict_types = 1 );

namespace FileFetcher\Tests\Integration;

use FileFetcher\FileFetchingException;
use FileFetcher\SimpleFileFetcher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FileFetcher\SimpleFileFetcher
 *
 * @licence BSD-3-Clause
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleFileFetcherTest extends TestCase {

	public function testGetThisFileFromDisk() {
		$fetcher = new SimpleFileFetcher();

		$contents = $fetcher->fetchFile( __FILE__ );

		$this->assertSame( file_get_contents( __FILE__ ), $contents );
	}

	public function testGetThisFileFromGitHub() {
		$fetcher = new SimpleFileFetcher();

		$contents = $fetcher->fetchFile(
			'https://raw.githubusercontent.com/JeroenDeDauw/FileFetcher/master/tests/Integration/SimpleFileFetcherTest.php'
		);

		$this->assertIsString( $contents );

		$this->assertStringContainsString( __FUNCTION__, $contents );
	}

	public function testGivenNotFoundFile_exceptionIsThrown() {
		$fetcher = new SimpleFileFetcher();
		$invalidRemoteFileUrl = 'http://raw.github.com/JeroenDeDauw/FileFetcher/master/foo.php';

		$this->expectException( FileFetchingException::class );
		$this->expectExceptionMessage( 'Could not fetch file: ' . $invalidRemoteFileUrl );
		$fetcher->fetchFile( $invalidRemoteFileUrl );
	}

	public function testGivenInvalidUrl_exceptionIsThrown() {
		$fetcher = new SimpleFileFetcher();
		$invalidRemoteFileUrl = 'foo bar baz';

		$this->expectException( FileFetchingException::class );
		$this->expectExceptionMessage( 'Could not fetch file: ' . $invalidRemoteFileUrl );
		$fetcher->fetchFile( $invalidRemoteFileUrl );
	}

}
