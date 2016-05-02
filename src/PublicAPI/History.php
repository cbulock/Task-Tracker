<?php
namespace cbulock\task_tracker\PublicAPI;

class History {

	private $history;
	
	public function __construct() {
		$this->history = new \cbulock\task_tracker\History;
	}

	public function all() {
		return $this->history->all();
	}

	public function user($id) {
		return $this->history->user($id);
	}
}