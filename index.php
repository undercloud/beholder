<?php
	require __DIR__ . '/Monitor.php';
	require __DIR__ . '/Utils/Shell.php';
	require __DIR__ . '/Utils/Log.php';
	require __DIR__ . '/Adapter/Base.php';
	require __DIR__ . '/Adapter/Pidof.php';
	require __DIR__ . '/Adapter/Screen.php';

	$settings = require __DIR__ . '/Settings.php';
	$queue    = require __DIR__ . '/Queue.php';;
	
	Undercloud\Watcher\Utils\Log::setLogPath($settings['logpath']);

	$monitor = new Undercloud\Watcher\Monitor($queue);

	$monitor->run(); 
?>