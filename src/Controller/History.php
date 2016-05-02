<?php
namespace cbulock\task_tracker\Controller;

class History extends Base {

	public function process() {

		$this->setTemplate('History');

		$history = new \cbulock\task_tracker\History;

		$data = $this->route->get_data(1);

		if ($data == 'all') {
			$logs = $history->all();
			$title = 'All History';
		}
		else {
			$user = $_COOKIE['user'];
			$title = 'Your History';
			if ($data) {
				$user = $data;
				$userdata = new \cbulock\task_tracker\User;
				$name = $userdata->get($user)['name'];
				$title = $name . "'s History";
			}
			$logs = $history->user($user);
		}

		$this->addData(
			[
				'logs' => $logs,
				'title' => $title
			]
		);
	}

}
