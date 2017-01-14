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

	public function by_task($task) {
		return $this->history->by_task($task);
	}

	public function edit($id, $task, $user, $date) {
		$this->history->edit($id, $task, $user, $date);
		return ['message' => 'History Saved'];
	}
}