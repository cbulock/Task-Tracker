<?php
namespace cbulock\task_tracker\Controller;

class History extends Base {

	public function process() {

		$this->setTemplate('History');

		$history = new \cbulock\task_tracker\History;

		$data = $this->route->get_data(1);

		switch($data) {
			case 'all': 
				$logs = $history->all();
				$title = 'All History';
				$this->addData(
					[
						'logs' => $logs,
						'title' => $title
					]
				);
				break;
			case 'item':
				$task = new \cbulock\task_tracker\Task;
				$user = new \cbulock\task_tracker\User;
				$this->setTemplate('HistoryItem');
				$item = $this->route->get_data(2);
				$itemdata = $history->get($item);
				$taskdata = $task->get($itemdata['task']);
				$userdata = $user->get($itemdata['user']);
				$this->addData(
					[
						'item' => $itemdata,
						'task' => $taskdata,
						'user' => $userdata
					]
				);
				break;
			default:
				$user = $_COOKIE['user'];
				$title = 'Your History';
				if ($data) {
					$user = $data;
					$userdata = new \cbulock\task_tracker\User;
					$name = $userdata->get($user)['name'];
					$title = $name . "'s History";
				}
				$logs = $history->user($user);
				$this->addData(
					[
						'logs' => $logs,
						'title' => $title
					]
				);
		}


	}

}
