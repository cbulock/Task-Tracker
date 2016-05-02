<?php
namespace cbulock\task_tracker\Controller;

class PublicAPI extends Base {

	public function process() {

		$this->setTemplate('PublicAPI');
		$this->setContentType('Content-type: application/json; charset=UTF-8');

		$public = new \cbulock\task_tracker\API\PublicAPI;
		$public->setClass($this->route->get_data(1) . '/' . $this->route->get_data(2));
		$public->setMethod($this->route->get_data(3));
		$public->setRequest(array_merge($_REQUEST, $_FILES));

		$this->addData(
			[
				'data' => $public->output()
			]
		);

	}

}