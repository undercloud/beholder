<?php
	
	namespace Undercloud\Watcher\Utils;

	class Log
	{
		const FAIL = 0;
		const OK   = 1;
		const WARN = 2;

		private static $logpath;

		private static function highlight($msg, $status)
		{
			$hl = array('0;31','0;32','0;33');

			return "\033[" . $hl[$status] . "m" . $msg . "\033[0m";
		}

		public static function show($msg, $status = 1)
		{
			echo self::highlight(date('d/m/Y H:i:sP') . ' ' . $msg, $status) . PHP_EOL;

			if ($status == self::FAIL or $status == self::WARN) {
				self::save($msg);
			}
		}

		public static function setLogPath($path)
		{
			self::$logpath = $path;
		}

		public static function save($msg)
		{
			$msg = date('d/m/Y H:i:sP') . ' ' . $msg . PHP_EOL;
			
			if (false == @is_writeable(self::$logpath)) {
				echo self::highlight('cannot access to ' . self::$logpath, self::FAIL) . PHP_EOL;
			} else {	
				file_put_contents(self::$logpath, $msg, FILE_APPEND);
			}
		}
	}
?>