<?php
	namespace Undercloud\Watcher\Utils;

	class Shell
	{
		public static function exec($cmd, array $args = array())
		{
			$status = 0;
			$output = array();
		
			$proc = escapeshellcmd($cmd) . ' ' . implode(' ', array_map(function ($arg) { 
				return escapeshellarg($arg); 
			}, $args));

			exec($proc, $output, $status);
			
			$output = trim(implode(PHP_EOL, $output));

			return array($status, $output);
		}
	}
?>