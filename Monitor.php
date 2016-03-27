<?php
	
	namespace Undercloud\Watcher;

	class Monitor
	{
		private $monitor = array();

		public function __construct(array $monitor)
		{
			$this->monitor = $monitor;
		}

		public function run()
		{
			foreach ($this->monitor as $key => $stack) {
				$class = 'Undercloud\\Watcher\\Adapter\\' . ucfirst($key);

				$adapter = new $class;
				$adapter->setStack($stack);
				$adapter->prepare();
				$adapter->resolve();
			}
		}
	}
?>