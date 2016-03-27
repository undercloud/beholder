<?php
	namespace Undercloud\Watcher\Adapter;

	use Undercloud\Watcher\Utils\Shell;
	use Undercloud\Watcher\Utils\Log;

	class Screen extends Base
	{
		private $parsed = array();

		public function prepare()
		{
			list($code, $output) = Shell::exec('screen', array('-ls'));

			if (0 === strpos($output, 'No Sockets found in')) {
				/* pass */
			} else {
				$tmp = array_filter(explode(PHP_EOL, trim($output)));
				array_shift($tmp);
				$tmp = array_map('trim', $tmp);
			
				$tmp = array_map(
					function ($item) {
						$dot   = strpos($item, '.');
						$space = strpos($item, '	');
						
						return substr($item, $dot + 1, $space - $dot - 1);
					},
					$tmp
				);
			
				$this->parsed = array_filter($tmp);
			}
		}

		public function resolve()
		{
			foreach ($this->getStack() as $key => $run) {
				if (false == in_array($key, $this->parsed)) {
					Log::show($key . ' not running', Log::FAIL);
					Log::show('try to start ' . $key, Log::WARN);

					list($code, $output) = Shell::exec($run);

					if ((int)$code != 0) {
						Log::show(
							sprintf(
								'fail for \'%s\' with code %s and message %s',
								$run,
								$code,
								$output
							),
							Log::FAIL
						);
					} else {
						Log::show('now ' . $key . ' is ok');
					}
				} else {
					Log::show($key . ' is ok');
				}
			}
		}
	}
?>