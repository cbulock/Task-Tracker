<?php
namespace cbulock\task_tracker\PublicAPI;

/**
 * History of completed tasks.
 *
 */
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

	public function edit($id, $task, $user, $date, $value) {
		$this->history->edit($id, $task, $user, $date, $value);
		return ['message' => 'History Saved'];
	}

	public function approve($id) {
		$this->history->approve($id);
		return ['message' => 'Approved'];
	}

	public function addOverride($user_id, $points) {
		$this->history->addOverride($user_id, $points);
		return ['message' => 'Override Saved'];
	}
}
