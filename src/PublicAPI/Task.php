<?php
namespace cbulock\task_tracker\PublicAPI;

class Task {

	private $task;

	public function __construct() {
		$this->task = new \cbulock\task_tracker\Task;
	}

	public function available() {
		return $this->task->available();
	}

	public function get($id) {
		return $this->task->get($id);
	}

	public function add($name, $desc, $priority = 3, $repeat = 7) {
		$this->task->add($name, $desc, $priority, $repeat);
		$settings = new \cbulock\task_tracker\Settings;
		return ['message' => $settings->get('task_name') . ' Added'];
	}

	public function edit($id, $name, $desc, $priority = 3, $repeat = 7) {
		$this->task->edit($id, $name, $desc, $priority, $repeat);
		$settings = new \cbulock\task_tracker\Settings;
		return ['message' => $settings->get('task_name') . ' Saved'];
	}

	public function record($id) {
		$this->task->record($id);
		$task = $this->task->get($id);
		return ['message' => $task['name'] . ' Completed'];
	}
}
