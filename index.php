<?php
	
	require __DIR__ . '/vendor/autoload.php';
	require_once("includes/class.resolver.php");
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	\Sentry\init(['dsn' => 'https://70d96a77d8a34e98940fa2dfa7393b6b@o1325363.ingest.sentry.io/6694670' ]);	
	
	try {
		$resolver = new resolver;
		$resolver->decode();
	} catch (\Throwable $exception) {
		\Sentry\captureException($exception);
	}


	