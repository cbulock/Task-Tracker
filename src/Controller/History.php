<?php
namespace cbulock\task_tracker\Controller;

class History extends Base {

	public function process() {

		$this->setTemplate('History');

		$history = new \cbulock\task_tracker\History;

		$data = $this->route->get_data(1);

		if ($data == 'all') {
			$logs = $history->all();
		}
		else {
			$user = $_COOKIE['user'];
			if ($data) $user = $data;
			$logs = $history->user($user);
		}

		$this->addData(
			[
				'logs' => $logs
			]
		);
	}

}
