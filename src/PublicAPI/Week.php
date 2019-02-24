<?php
namespace cbulock\task_tracker\PublicAPI;

class Week {

	private $week;

	public function __construct() {
		$this->week = new \cbulock\task_tracker\Week;
	}

	public function current() {
		return $this->week->current();
	}

}