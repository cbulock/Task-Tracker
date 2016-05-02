<?php
namespace cbulock\task_tracker\PublicAPI;

class Chore {

	private $chore;
	
	public function __construct() {
		$this->chore = new \cbulock\task_tracker\Chore;
	}

	public function available() {
		return $this->chore->available();
	}

	public function get($id) {
		return $this->chore->get($id);
	}

	public function add($name, $desc, $priority = 3, $repeat = 7) {
		$this->chore->add($name, $desc, $priority, $repeat);
		return ['message' => 'Chore Added'];
	}

	public function record($id) {
		$this->chore->record($id);
		$chore = $this->chore->get($id);
		return ['message' => $chore['name'] . ' Completed'];
	}
}