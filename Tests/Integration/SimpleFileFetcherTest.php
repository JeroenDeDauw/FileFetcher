<?php

namespace FileFetcher\Tests\Integration;

use FileFetcher\SimpleFileFetcher;

/**
 * @covers FileFetcher\SimpleFileFetcher
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SimpleFileFetcherTest extends \PHPUnit_Framework_TestCase {

	public function testGetThisFileFromDisk() {
		$fetcher = new SimpleFileFetcher();

		$contents = $fetcher->fetchFile( __FILE__ );

		$this->assertEquals( file_get_contents( __FILE__ ), $contents );
	}

	public function testGetThisFileFromGitHub() {
		$fetcher = new SimpleFileFetcher();

		$contents = $fetcher->fetchFile( 'http://raw.github.com/JeroenDeDauw/FileFetcher/master/Tests/Integration/SimpleFileFetcherTest.php' );

		$this->assertInternalType( 'string', $contents );

		$this->assertInternalType( 'integer', strpos( $contents, __FUNCTION__ ) );
	}

}
