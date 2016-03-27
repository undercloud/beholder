<?php
	
	namespace Undercloud\Watcher\Adapter;

	abstract class Base
	{
		private $stack = array();

		public function setStack(array $stack)
		{
			$this->stack = $stack;
		}

		public function getStack()
		{
			return $this->stack;
		}

		abstract public function prepare();
		abstract public function resolve();
	}
?>