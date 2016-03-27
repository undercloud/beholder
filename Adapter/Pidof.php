<?php

	namespace Undercloud\Watcher\Adapter;

	use Undercloud\Watcher\Utils\Shell;
	use Undercloud\Watcher\Utils\Log;

	class Pidof extends Base
	{
		public function prepare()
		{
			/* pass prepare */	
		}

		public function resolve()
		{
			foreach ($this->getStack() as $key => $run) {
				list($code, $output) = Shell::exec('pidof', array($key));

				if (!$output) {
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