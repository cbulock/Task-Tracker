<?php
namespace cbulock\task_tracker\Controller;

class EditHistory extends Base {

	public function process() {

		$this->setTemplate('EditHistory');

		$history = new \cbulock\task_tracker\History;
		$task = new \cbulock\task_tracker\Task;
		$user = new \cbulock\task_tracker\User;

		$id = $this->route->get_data(1);

		$this->addData(
			[
				'history' => $history->get($id),
				'tasks' => $task->all(),
				'users' => $user->all()
			]
		);
	}

}