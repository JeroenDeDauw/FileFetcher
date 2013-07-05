<?php

/**
 * This documentation group collects source code files belonging to the FileFetcher library.
 *
 * @defgroup FileFetcher FileFetcher
 */

if ( defined( 'FileFetcher_VERSION' ) ) {
	// Do not initialize more then once.
	return;
}

define( 'FileFetcher_VERSION', '1.0.1' );

if ( !defined( 'SimpleCache_VERSION' ) && is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

if ( !defined( 'SimpleCache_VERSION' ) && is_readable( __DIR__ . '/../SimpleCache/SimpleCache.php' ) ) {
	include_once( __DIR__ . '/../SimpleCache/SimpleCache.php' );
}

if ( !defined( 'SimpleCache_VERSION' ) ) {
	throw new Exception( 'You need to have the SimpleCache library loaded in order to use FileFetcher' );
}

// @codeCoverageIgnoreStart
spl_autoload_register( function ( $className ) {
	$className = ltrim( $className, '\\' );
	$fileName = '';
	$namespace = '';

	if ( $lastNsPos = strripos( $className, '\\') ) {
		$namespace = substr( $className, 0, $lastNsPos );
		$className = substr( $className, $lastNsPos + 1 );
		$fileName  = str_replace( '\\', '/', $namespace ) . '/';
	}

	$fileName .= str_replace( '_', '/', $className ) . '.php';

	$namespaceSegments = explode( '\\', $namespace );

	if ( $namespaceSegments[0] === 'FileFetcher' ) {
		if ( count( $namespaceSegments ) === 1 || $namespaceSegments[1] !== 'Tests' ) {
			require_once __DIR__ . '/src/' . $fileName;
		}
	}
} );
// @codeCoverageIgnoreEnd
